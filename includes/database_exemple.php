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

define("default_language", "YOUR_LANGUAGE_BY_DEFAULT");

ORM::configure('mysql:host=YOUR_HOST;dbname=YOUR_DATABASE_NAME');
ORM::configure('username', 'YOUR_DATABASE_USERNAME');
ORM::configure('password', 'YOUR_DATABASE_PASSWORD');

if(DEBUG_MODE){
	ORM::configure('error_mode', PDO::ERRMODE_WARNING);
	ORM::configure('logging', true);
}