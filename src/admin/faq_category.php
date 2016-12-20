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

hook_action("admin_faq_category");

if(!empty($_POST['name'])){
	if(empty($_GET['update'])){
		$add = ORM::for_table("faq_category")->create();
		$add->name = $_POST['name'];
		$add->save();

		header("Location: ".routes("admin_faq_category"));
		exit();
	} else {
		$category = ORM::for_table("faq_category")->find_one($_GET['update']);
		if(!empty($category)){
			$category->name = $_POST['name'];
			$category->save();

			header("Location: ".routes("admin_faq_category"));
			exit();
		}
	}
}

if(!empty($_GET['delete'])){
	verif_token();

	$category = ORM::for_table("faq_category")->find_one($_GET['delete']);
	if(!empty($category)){
		$category->delete();

		$articles = ORM::for_table("faq_articles")->where("category_id", $_GET['delete'])->delete_many();

		header("Location: ".routes("admin_faq_category"));
		exit();
	}
}

$category = ORM::for_table("faq_category")->find_many();

$tpl->assign("category", $category);

$tpl->display("admin/faq_category.tpl");