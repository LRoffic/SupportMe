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

hook_action("answer");

function autor($id){
	$autor = ORM::for_table('users')->select('username')->find_one($id);

	if(!empty($autor))
		return htmlspecialchars($autor->username);
	else
		return $lang['answer']['anonymous'];
}

$answer = ORM::for_table("faq_articles")->find_one($match['params']['id']);

if(empty($answer)){
	include "404.php";
	exit();
}

if(\utilphp\util::slugify($answer->title) != $match['params']['name']){
	header("Location: ".$router->generate("answer", array("id"=>$match['params']['id'], "name"=>\utilphp\util::slugify($answer->title))));
	exit();
}

$tpl->assign("answer", $answer);

$tpl->display("answer.tpl");