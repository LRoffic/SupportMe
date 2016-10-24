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

	$router = new AltoRouter();

	$router->setBasePath(dirname($_SERVER["PHP_SELF"]));

	$router->map("GET|POST", "/", "index.php", "home");
	$router->map("GET|POST", "/new", "new.php", "new");
	$router->map("GET|POST", "/ticket/[i:id]", "ticket.php", "ticket");
	$router->map("GET|POST", "/list", "list.php", "list");
	$router->map("GET|POST", "/connexion", "connexion.php", "connexion");
	$router->map("GET", "/logout", "logout.php", "logout");
	$router->map("GET", "/404", "404.php", "404");

	if($session->isLogged()){
		$info = $session->getUser();
		$permission = User::getPermissions($info->rank);

		if($permission->access_admin){
			$router->map("GET", "/admin/", "admin/home.php", "admin");
			$router->map("GET", "/admin/update", "admin/update.php", "update");
			$router->map("GET", "/admin/closed", "admin/home.php", "admin_close_ticket");

			if($permission->lang_gestion)
				$router->map("GET", "/admin/langs", "admin/langs.php", "admin_langs");

			if($permission->plugin_gestion){
				$router->map("GET", "/admin/plugins", "admin/plugins.php", "admin_plugins");
				$router->map("GET|POST", "/admin/plugins/settings/[*:name]", "admin/plugin_settings.php", "admin_plugin_settings");
				$router->map("GET", "/admin/plugins/market", "admin/plugin_market.php", "admin_plugin_market");
			}

			if($permission->theme_gestion)
				$router->map("GET", "/admin/themes", "admin/themes.php", "admin_themes");

			if($permission->config_gestion)
				$router->map("GET|POST", "/admin/config", "admin/config.php", "admin_config");

			if($permission->users_gestion)
				$router->map("GET|POST", "/admin/users", "admin/users.php", "admin_users");

			if($permission->perm_gestion){
				$router->map("GET|POST", "/admin/permissions", "admin/permissions.php", "admin_permissions");
			}
		}
	}

	$match = $router->match();

	include _CTRL_ .($match['target'] ?: '404.php');