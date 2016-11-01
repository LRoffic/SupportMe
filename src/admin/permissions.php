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

hook_action("admin_permissions");

function yesorno($value){
	if($value == "1" || $value == "0"){;
		return true;
	}
	else{
		return false;
	}
}

$new = new FormBuilder();

$new->add($lang['admin']['permission_name'], "text")
->inputClass("form-control")
->name("name")
->validator('specialchars()', $lang['error']['invalide_field']);

$new->add($lang['admin']['admin_access'], "select")
->inputClass("form-control")
->name("admin_access")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['view_all_ticket'], "select")
->inputClass("form-control")
->name("view_all_ticket")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['reopen_ticket'], "select")
->inputClass("form-control")
->name("reopen_ticket")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['comment_closed_ticket'], "select")
->inputClass("form-control")
->name("comment_closed_ticket")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['assign_to_me'], "select")
->inputClass("form-control")
->name("assign_to_me")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['assign_to_other'], "select")
->inputClass("form-control")
->name("assign_to_other")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['change_assign'], "select")
->inputClass("form-control")
->name("change_assign")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['category_gestion'], "select")
->inputClass("form-control")
->name("category_gestion")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['faq_gestion'], "select")
->inputClass("form-control")
->name("faq_gestion")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['lang_gestion'], "select")
->inputClass("form-control")
->name("lang_gestion")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['theme_gestion'], "select")
->inputClass("form-control")
->name("theme_gestion")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['users_gestion'], "select")
->inputClass("form-control")
->name("users_gestion")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['perm_gestion'], "select")
->inputClass("form-control")
->name("perm_gestion")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->add($lang['admin']['config_gestion'], "select")
->inputClass("form-control")
->name("config_gestion")
->validator('yesorno(self)', $lang['error']['invalide_field'])
->optional();
$new->choice($lang["admin"]["yes"], "1");
$new->choice($lang["admin"]["no"], "0");

$new->submit($lang['admin']['rank_valid'])->submitStyle('.btn btn-primary btn-block btn-lg');

$tpl->assign("new", $new);

if($new->sent()){
	if($new->isValid()){
		$create = ORM::for_table("permissions")->create();
			
		$create->name                  = $_POST['name'];
		$create->access_admin          = $_POST['admin_access'];
		$create->view_all_ticket       = $_POST['view_all_ticket'];
		$create->reopen_ticket         = $_POST['reopen_ticket'];
		$create->comment_closed_ticket = $_POST['comment_closed_ticket'];
		$create->assign_to_me          = $_POST['assign_to_me'];
		$create->assign_to_other       = $_POST['assign_to_other'];
		$create->change_assign         = $_POST['change_assign'];
		$create->category_gestion      = $_POST['category_gestion'];
		$create->faq_gestion           = $_POST['faq_gestion'];
		$create->lang_gestion          = $_POST['lang_gestion'];
		$create->theme_gestion         = $_POST['theme_gestion'];
		$create->users_gestion         = $_POST['users_gestion'];
		$create->perm_gestion          = $_POST['perm_gestion'];
		$create->config_gestion        = $_POST['config_gestion'];

		$create->save();

		$new->clearFields();

		header("Location: ".routes("admin_permissions"));
		exit();
	}
}

if(!empty($_GET['update'])){
	if(yesorno($_POST['admin_access']) && yesorno($_POST['view_all_ticket']) && yesorno($_POST['reopen_ticket']) && yesorno($_POST['comment_closed_ticket']) && yesorno($_POST['assign_to_me']) && yesorno($_POST['assign_to_other']) && yesorno($_POST['change_assign']) && yesorno($_POST['lang_gestion']) && yesorno($_POST['theme_gestion']) && yesorno($_POST['users_gestion']) && yesorno($_POST['perm_gestion']) && yesorno($_POST['config_gestion']) && !empty($_POST['name'])){

		$updateperm = ORM::for_table("permissions")->find_one($_GET['update']);
		if(!empty($updateperm)){
			
			$updateperm->name                  = $_POST['name'];
			$updateperm->access_admin          = $_POST['admin_access'];
			$updateperm->view_all_ticket       = $_POST['view_all_ticket'];
			$updateperm->reopen_ticket         = $_POST['reopen_ticket'];
			$updateperm->comment_closed_ticket = $_POST['comment_closed_ticket'];
			$updateperm->assign_to_me          = $_POST['assign_to_me'];
			$updateperm->assign_to_other       = $_POST['assign_to_other'];
			$updateperm->change_assign         = $_POST['change_assign'];
			$updateperm->category_gestion      = $_POST['category_gestion'];
			$updateperm->faq_gestion           = $_POST['faq_gestion'];
			$updateperm->lang_gestion          = $_POST['lang_gestion'];
			$updateperm->theme_gestion         = $_POST['theme_gestion'];
			$updateperm->users_gestion         = $_POST['users_gestion'];
			$updateperm->perm_gestion          = $_POST['perm_gestion'];
			$updateperm->config_gestion        = $_POST['config_gestion'];

			$updateperm->save();

			header("Location: ".routes("admin_permissions"));
			exit();
		} else {
			var_dump("updateperm");
			header("Location: ".routes("admin_permissions")."?error=update");
			exit();
		}
	} else {
		header("Location: ".routes("admin_permissions")."?error=update");
		exit();
	}
}

if(!empty($_GET['delete'])){
	verif_token();
	if($_GET['delete'] != '1'){
		$delete = ORM::for_table("permissions")->find_one($_GET['delete']);
		$delete->delete();

		$update_users = ORM::for_table("users")->where("rank", $_GET['delete'])->find_many();
		foreach ($update_users as $value) {
			$update_user = ORM::for_table("users")->find_one($value['id']);
			$update_user->rank = "1";
			$update_user->save();
		}
	}
}

if(!empty($_GET['error'])){
		$tpl->assign("error",$_GET['error']);
}

$rangs = ORM::for_table("permissions")->find_array();

$tpl->assign("rangs", $rangs);

$tpl->display("admin/permissions.tpl");