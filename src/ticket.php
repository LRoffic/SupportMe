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

if(empty($_SESSION['id']) || empty($_SESSION['token'])){
	hook_action("connexion");
	$tpl->display("connexion.tpl");
	exit();
}

hook_action("ticket");

$ticket = ORM::for_table("ticket")->find_one($match['params']['id']);
if(empty($ticket)){
	include_once "404.php";
	exit();
}

hook_filter("ticket", $ticket);

$tpl->assign("ticket", $ticket);

if(!empty($_COOKIE['CREATE_TICKET']) && $_COOKIE['CREATE_TICKET'] == $ticket->id){
	$tpl->assign("createTicket", true);
	setcookie("CREATE_TICKET", "", time() - 60*5, FOLDER);
} else {
	$tpl->assign("createTicket", false);
}

include_once "forms/comment.php";
$tpl->assign("comment", $comment);

$tpl->display("ticket.tpl");