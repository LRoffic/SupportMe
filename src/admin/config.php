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
include_once "menu.php";

hook_action("admin_config");

$form = new FormBuilder();

$form->add($lang['admin']['config_sitename'], "text")->name("site_name")->value($config->site_name)->inputClass("form-control");

$form->add($lang["admin"]['config_sitemail'], "email")->name("site_email")->value($config->site_email)->inputClass("form-control")->validator("mailcheck()", $lang['error']['error_email']);

$form->add($lang['admin']["config_register"], "radio")->name("register")->optional();

if($config->register){
	$form->radio($lang['admin']['yes'], 1, 1, "register");
	$form->radio($lang['admin']['no'], 0, 0, "register");
} else {
	$form->radio($lang['admin']['yes'], 0, 1 ,"register");
	$form->radio($lang['admin']['no'], 1, 0, "register");
}

$form->add($lang['admin']["config_connexion"], "radio")->name("connexion_mandatory")->optional();

if($config->connexion_mandatory){
	$form->radio($lang['admin']['yes'], 1, 1, "connexion_mandatory");
	$form->radio($lang['admin']['no'], 0, 0, "connexion_mandatory");
} else {
	$form->radio($lang['admin']['yes'], 0, 1 ,"connexion_mandatory");
	$form->radio($lang['admin']['no'], 1, 0, "connexion_mandatory");
}

$form->add($lang['admin']['recaptcha_public_key'] ,"text")->name("recaptcha_public_key")->value($config->recaptcha_public_key)->inputClass("form-control");

$form->add($lang['admin']['recaptcha_private_key'] ,"text")->name("recaptcha_private_key")->value($config->recaptcha_private_key)->inputClass("form-control");

$form->submit($lang['admin']['config_valid'])->submitStyle('.btn btn-primary btn-block btn-lg');

if($form->sent()){
	if($form->isValid()){
		$config->site_name = $_POST['site_name'];
		$config->site_email = $_POST['site_email'];
		$config->register = $_POST['register'];
		$config->connexion_mandatory = $_POST["connexion_mandatory"];
		$config->recaptcha_public_key = $_POST['recaptcha_public_key'];
		$config->recaptcha_private_key = $_POST["recaptcha_private_key"];
		$config->save();
	}
}

$tpl->assign("form", $form);

$tpl->display("admin/config.tpl");