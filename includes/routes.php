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

	$router->setBasePath(substr($_SERVER['REQUEST_URI'], 0, -1));

	$router->map("GET", "/", "index.php", "home");

	$match = $router->match();

	include $match['target'] ? _CTRL_.$match['target'] : _CTRL_.'404.php';