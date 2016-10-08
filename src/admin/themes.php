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

hook_action("admin_themes");

$dirname = 'themes/';
$dir = opendir($dirname);

while($file = readdir($dir)){
	if($file != '.' && $file != '..'){
		if(file_exists($dirname.$file.'/version.json')){
			$content=file_get_contents($dirname.$file.'/version.json');
			$content = json_decode($content, true);

			if(!empty($content['update_file'])){
				if(checkFileExist($content['update_file'])){
					$update_theme = file_get_contents($content['update_file']);
					$update_theme = json_decode($update, true);
					array_push($content, $update_theme);
				}
			}

			$content['folder'] = $file;

			$listfiles[] = $content;

		}
	}
}

if(!empty($_GET['use'])){
	verif_token();

	if(file_exists($dirname.$_GET['use']."/version.json")){
		$config->theme = $_GET['use'];
		$config->save();

		header("Location: ".routes('admin_themes'));
	}
}

closedir($dir);

$tpl->assign("listfiles", $listfiles);

$tpl->display("admin/themes.tpl");