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

	include_once "vendor/autoload.php";
	include_once "define.php";
	include_once "database.php";
	include_once "lib/lib.php";
	include_once "pluggable.php";

	if(DEBUG_MODE){
		ini_set('display_errors', 1);
		ini_set('error_reporting', E_ALL);
	}

	foreach( glob("plugins/*.php")  as $plugin){
		$name = str_replace(".php", "", str_replace("plugins/", "", $plugin));
		$plugins[$name] = include $plugin;
	}

	hook_action('initialize');

	\utilphp\util::utf8_headers();
	
	$session = new Session();

	$config = ORM::for_table("config")->find_one("1");

	$theme = htmlspecialchars($config->theme);

	$tpl = new Smarty();
	$tpl->setTemplateDir("themes/".$theme);

	$mail = new FastMailBuilder();

	$tpl->assign("config", $config);

	include_once "function.php";

	include_once "lang.php";

	include_once "routes.php";