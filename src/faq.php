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

hook_action("faq");

function answer($id, $slug){
	global $router;

	return $router->generate("answer", array("id"=>$id, "name"=>$slug));
}

$getArticles = ORM::for_table("faq_articles")
->join("faq_category", "faq_category.id = faq_articles.category_id")
->order_by_asc("faq_category.name")
->select("faq_articles.id", "id")
->select("faq_articles.title")
->select("faq_category.name")
->select("faq_category.id", "category_id")
->find_array();

$tpl->assign("articles", $getArticles);

$tpl->display("faq.tpl");