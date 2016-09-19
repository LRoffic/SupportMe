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

$market_url = "http://supportme.dzv.me/plugins/market.json";

if(checkFileExist($market_url)){
	$get_plugins = file_get_contents($market_url)
	$market_plugins = json_decode($get_plugins, true);

	$tpl->assign("market_plugins", $market_plugins);

	if(!empty($_GET['install'])){
		verif_token();

		if(array_key_exists($_GET['install'], $market_plugins)){
			$install_plugin_url = $market_plugins[$_GET['install']]['downloadURL'];

			if(checkFileExist($install_plugin_url)){
				$content = file_get_contents($install_plugin_url);
				if(verif_installed_plugin($install_plugin_url)){
					$filename = get_plugin_filename($install_plugin_url);
					file_put_contents("plugins/".$filename.".php", $content);
					$new_plugin = include "plugins/".$filename.".php";
					$new_plugin['install']();
				}

				header("Location: ".routes('admin_plugins'));
			}
		}
	}
}

$tpl->display("admin/plugin_market.tpl");