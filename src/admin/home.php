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

hook_action("admin_home");

$info = $session->getUser();

if(!$permission->view_all_ticket)
	$ticket = ORM::for_table("ticket")->where_any_is(array(array("attribute"=>"0"), array("attribute"=>$info->id)))->order_by_desc("id")->find_many();
else
	$ticket = ORM::for_table("ticket")->order_by_desc("id")->find_many();

$tpl->assign("tickets", $ticket);

$tpl->display("admin/home.tpl");