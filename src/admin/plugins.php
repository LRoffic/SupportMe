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

hook_action("admin_plugins");

if(!empty($_GET['remove'])){
	verif_token();

	if(file_exists("plugins/".$_GET['remove'].".php")){
		if(array_key_exists($_GET['remove'], $plugins)){

			$plugins[$_GET['remove']]['remove']();

			unlink("plugins/".$_GET['remove'].".php");
			header("Location: ".routes('admin_plugins'));
		}
	}
}

if(!empty($_GET['update'])){
	verif_token();

	if(file_exists("plugins/".$_GET['update'].".php")){
		if(array_key_exists($_GET['update'], $plugins)){
			$plugin_update = $plugins[$_GET['update']];
			if(checkFileExist($plugin_update['updateURL'])){
				$update_info = file_get_contents($plugin_update['updateURL']);
				$update_link = json_decode($update_info, true);
				if($newVersion = file_get_contents($update_link['newVersion'])){
					file_put_contents("plugins/".$_GET['update'].".php", $newVersion);
					$plugins[$_GET['update']]['update']();
					header("Location: ".routes('admin_plugins'));
				}
			}
		}
	}
}

if(!empty($plugins))
	$tpl->assign("plugins", $plugins);

$tpl->display("admin/plugins.tpl");