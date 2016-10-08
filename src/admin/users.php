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

hook_action("admin_users");

if(!empty($_POST['rang']) && !empty($_GET['update'])){
	$update_user = ORM::for_table("users")->find_one($_GET['update']);
	if(empty($update_user)){
		header("Location: ".routes("admin_users"));
		exit();
	}

	$verif_rang = ORM::for_table('permissions')->find_one($_POST['rang']);
	if(empty($verif_rang)){
		header("Location: ".routes("admin_users"));
		exit();
	}

	$update_user->rank = $_POST['rang'];
	$update_user->save();
	header("Location: ".routes("admin_users"));
	exit();
}

if(!empty($_GET['delete'])){
	verif_token();

	$user = ORM::for_table("users")->find_one($_GET["delete"]);
	if(empty($user)){
		header("Location: ".routes("admin_users"));
		exit();
	}

	$get_ticket = ORM::for_table("ticket")->where("autor", $user->id)->find_many();
	foreach ($get_ticket as $ticket) {
		ORM::for_table("comments")->where("ticket_id", $ticket['id'])->delete_many();
	}

	ORM::for_table("ticket")->where("autor", $user->id)->delete_many();
	$user->delete();
	
	header("Location: ".routes("admin_users"));
	exit();
}

$rangs = ORM::for_table("permissions")->find_many();
$tpl->assign("rangs", $rangs);

$users = ORM::for_table("users")->find_many();
$tpl->assign("users", $users);

$tpl->display("admin/users.tpl");