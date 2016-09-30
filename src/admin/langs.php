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

hook_action("admin_langs");

$languages = getlangs();
$tpl->assign("languages", $languages);

$needUpdate = array();

foreach ($languages as $language) {
	$file_headers = @get_headers($language['host']);
	if(!empty($file_headers[0]) && $file_headers[0] != 'HTTP/1.1 404 Not Found') {
		$newVersion = file_get_contents($language['host']);
		$newVersion = json_decode($newVersion, true);
		if($newVersion['config']['version'] > $language['version']){
			$needUpdate[] = $language['filename'];
		}
	}
}

$tpl->assign('needUpdate', $needUpdate);

if(!empty($_GET['use'])){
	verif_token();

	if(file_exists("lang/".$_GET['use'].".json")){
		$config->lang = $_GET['use'];
		$config->save();

		header("Location: ". routes("admin_langs"));
	}
}

if(!empty($_GET['remove'])){
	verif_token();

	if(file_exists("lang/".$_GET['remove'].".json")){
		if($_GET['remove'] != default_language){
			unlink("lang/". $_GET['remove'].".json");
		}


		$config->lang = default_language;
		$config->save();

		header("Location: ". routes("admin_langs"));
	}
}

if(!empty($_GET['update'])){
	verif_token();

	if(file_exists("lang/".$_GET['update'].".json")){
		$get_host = file_get_contents("lang/".$_GET['update'].".json");
		$get_host = json_decode($get_host, true);
		$host = $get_host['config']['host'];

		$file_headers = @get_headers($host);

		if(!empty($file_headers[0]) && $file_headers[0] != 'HTTP/1.1 404 Not Found') {
			$get_update = file_get_contents($host);
			$update = file_put_contents("lang/".$_GET['update'].".json", $get_update);
		}

		header("Location: ". routes("admin_langs"));
	}
}

$tpl->display("admin/langs.tpl");