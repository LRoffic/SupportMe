<?php
/*
Copyright (C) 2016  Lee-Roy Dubourg
	
This program is free software: you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the Free
Software Foundation, either version 3 of the License, or (at your option)
any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along
with this program.  If not, see <http://www.gnu.org/licenses/>. 
*/
include "menu.php";

$plugin = $plugins[$match['params']['name']];

if(!isset($plugin)){
	include _CTRL_."404.php";
	exit();
}

if(empty($plugin['settings'])){
	include _CTRL_."404.php";
	exit();
}

$tpl->assign("plugin", $plugin);

$setting_form = new FormBuilder();

foreach ($plugin['settings'] as $key => $value) {
	$setting = ORM::for_table("plugin_settings")->where(array("plugin"=>$match['params']['name'], "option"=>$key))->select("value")->find_one();
	if($value["type"] == "yesornot"){
		$setting_form->add($value['description'], "select")->name($key)->inputClass("form-control");
		if(!empty($setting)){
			if($setting->value){
				$setting_form->choice($lang['admin']['yes'], "true", true);
				$setting_form->choice($lang['admin']['no'], "false");
			} else {
				$setting_form->choice($lang['admin']['yes'], "true");
				$setting_form->choice($lang['admin']['no'], "false", true);
			}
		} else {
			if($value['value']){
				$setting_form->choice($lang['admin']['yes'], "true", true);
				$setting_form->choice($lang['admin']['no'], "false");
			} else {
				$setting_form->choice($lang['admin']['yes'], "true");
				$setting_form->choice($lang['admin']['no'], "false", true);
			}
		}
	} else {
		if(!empty($setting))
			$val = $setting->value;
		else
			$val = $value['value'];

		$setting_form->add($value['title'], $value['type'])->name($key)->placeholder($value['description'])->value($val)->inputClass("form-control");
	}

	if(!$value['required']){
		$setting_form->optional();
	}
}

$setting_form->submit($lang['admin']['plugin_update_setting'])->submitStyle('.btn btn-info btn-block btn-lg');

if($setting_form->sent()){
	if($setting_form->isValid()){
		foreach ($_POST as $post => $value) {
			if(!empty($value)){
				$setting_exist = ORM::for_table('plugin_settings')->where(array("plugin"=>$match['params']['name'], "option"=>$post))->find_one();
				if(empty($setting_exist)){
					$create = ORM::for_table("plugin_settings")->create();
					$create->plugin = $match['params']['name'];
					$create->option = $post;
					$create->value = $value;
					$create->save();
				} else {
					$setting_exist->value = $value;
					$setting_exist->save();
				}
			}
		}
		$tpl->assign("retour", true);
	}
}

$tpl->assign("setting_form", $setting_form);

$tpl->display("admin/plugin_settings.tpl");