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

if(!$session->isLogged()){
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

if($_SESSION['id'] != $ticket->autor && !$permission->view_all_ticket && $_SESSION['id'] != $ticket['attribute'] && !empty($ticket['attribute'])){
	include_once "404.php";
	exit();
}

if(isset($_POST["newstatus"])){
	$actual_status = getStatus($ticket->status_id);
	if(!$actual_status['close'] || $permission->reopen_ticket){
		$ticket->date_last_action = time();
		$ticket->status_id = intval($_POST['newstatus']);
		$ticket->save();
	}
}

if($permission->assign_to_me){
	if(isset($_GET['assign_to_me'])){
		if(empty(User::getByID($ticket->attribute)['username']) || $perm->change_assign){
			$ticket->date_last_action = time();
			$ticket->attribute = $_SESSION['id'];
			$ticket->save();
		}
	}
}

if($permission->assign_to_other){
	$get_users = ORM::for_table('users')->find_array();
	$tpl->assign("users_to_assign", $get_users);
	if(!empty($_POST['assignto'])){
		$verif_user = ORM::for_table('users')->find_one($_POST['assignto']);
		if(!empty($verif_user) && !empty($verif_user->username)){
			$ticket->date_last_action = time();
			$ticket->attribute = $_POST['assignto'];
			$ticket->save();
		}
	}
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

$getComments = ORM::for_table("comments")->where("ticket_id", $ticket->id)->order_by_desc("id")->find_many();
$tpl->assign("getComments", $getComments);

$tpl->display("ticket.tpl");