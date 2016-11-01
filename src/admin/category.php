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

hook_action("admin_category");

$add = new FormBuilder();

$add->add($lang['admin']["category_name"], "text")->name("name")->inputClass("form-control");

$add->add($lang['admin']['category_published'], "select")->name("published")->inputClass("form-control")->optional();
$add->choice($lang['admin']['yes'], "1");
$add->choice($lang['admin']['no'], "0");

$add->submit($lang['admin']['category_valid'])->submitStyle('.btn btn-primary btn-block btn-lg');

$tpl->assign("add", $add);

if($add->sent()){
	if($add->isValid()){
		$create = ORM::for_table("category")->create();
		$create->name = $_POST["name"];
		$create->published = $_POST['published'];
		$create->save();
	}
}

if(!empty($_GET['update'])){
	if(!empty($_POST['name'])){
		$update = ORM::for_table("category")->find_one($_GET['update']);
		$update->name = $_POST['name'];
		$update->published = $_POST['published'];
		$update->save();

		header("Location: ".routes("admin_category"));
	}
}

$category = ORM::for_table("category")->find_many();
$tpl->assign("category", $category);

if(!empty($_GET['delete'])){
	verif_token();

	if($_GET['delete'] != "1"){
		$del = ORM::for_table("category")->find_one($_GET['delete'])->delete();

		header("Location: ".routes("admin_category"));
		exit();
	}
}

$tpl->display("admin/category.tpl");