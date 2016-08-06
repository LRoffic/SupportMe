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

class User extends Model implements ArrayAccess{
	static function getByID($uid){
		$entry = ORM::for_table("users")->find_one($uid);

		return $entry ? new User($entry) : null;
	}

	static function getPermissions($permission_id){
		$perm = ORM::for_table("permissions")->find_one($permission_id);

		if(!$perm){
			$perm = ORM::for_table("permissions")->find_one("1");
		}

		return $perm;
	}
}