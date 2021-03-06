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

define("DEBUG_MODE", false);

define("VERSION", "3.0.0");

define("_ROOT_", substr($_SERVER['DOCUMENT_ROOT'], 0, -1));
define('_PATH_', dirname(__DIR__));
define('FOLDER', dirname($_SERVER["PHP_SELF"]));
define('_CTRL_', _PATH_. '/src/');

define("default_language", "fr_FR");