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

hook_action("admin_faq");

function answer($id, $slug){
	global $router;

	return $router->generate("answer", array("id"=>$id, "name"=>$slug));
}

if(!empty($_GET['update'])){
	if(!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['content'])){
		$verif_cat = ORM::for_table('faq_category')->find_one($_POST['category']);
		if(!empty($verif_cat)){
			$verif_article = ORM::for_table("faq_articles")->find_one($_GET['update']);
			if(!empty($verif_article)){
				$verif_article->title       = $_POST['title'];
				$verif_article->category_id = $_POST['category'];
				$verif_article->autor       = $_SESSION['id'];
				$verif_article->content     = $_POST['content'];
				$verif_article->datepost    = time();
				$verif_article->save();

				header("Location: ".routes("admin_faq"));
				exit();
			}
		}
	}
}

//create FAQ
if(empty($_GET['update'])){
	if(!empty($_POST['title']) && !empty($_POST['category']) && !empty($_POST['content'])){
		$verif_cat = ORM::for_table('faq_category')->find_one($_POST['category']);
		if(!empty($verif_cat)){
			$newfaq = ORM::for_table("faq_articles")->create();
			$newfaq->title       = $_POST['title'];
			$newfaq->category_id = $_POST['category'];
			$newfaq->autor       = $_SESSION['id'];
			$newfaq->content     = $_POST['content'];
			$newfaq->datepost    = time();
			$newfaq->save();

			header("Location: ".routes("admin_faq"));
			exit();
		}
	}
}

if(!empty($_GET['delete'])){
	verif_token();

	$faq = ORM::for_table("faq_articles")->find_one($_GET['delete']);
	if(!empty($faq)){
		$faq->delete();

		header("Location: ".routes("admin_faq"));
		exit();
	}
}

$articles = ORM::for_table("faq_articles")
->join("faq_category", "faq_category.id = faq_articles.category_id")
->order_by_asc("faq_category.name")
->select("faq_articles.id", "id")
->select("faq_articles.title")
->select("faq_articles.content")
->select("faq_category.name")
->select("faq_category.id", "category_id")
->find_array();

$tpl->assign("articles", $articles);

$category = ORM::for_table("faq_category")->find_many();

$tpl->assign("category", $category);

$tpl->display("admin/faq.tpl");