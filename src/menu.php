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

hook_action("menu");

include_once "forms/login.php";

$tpl->assign("login", $login);
$tpl->assign("register", $register);

if($session->isLogged()){
	$tpl->assign("logged", true);

	$info = $session->getUser();

	if(!$info)
		$session->destroy();

	$info["avatar"] = "https://www.gravatar.com/avatar/".md5(strtolower(trim($info['email'])));

	hook_filter("user_info", $info);

	$tpl->assign("user_info", $info);

	$perm = User::getPermissions($info->rank);

	$tpl->assign("perm", $perm);
}