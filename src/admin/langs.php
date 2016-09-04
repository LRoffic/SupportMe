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

$langages = getlangs();
$tpl->assign("langages", $langages);

if(!empty($_GET['use'])){
	verif_token();

	if(file_exists("lang/".$_GET['use'].".json")){
		$config->lang = $_GET['use'];
		$config->save();

		header("Location: ". routes("admin_langs"));
	}
}

if(!empty($_GET['remove'])){
	verif_token();

	if(file_exists("lang/".$_GET['remove'].".json")){
		if($_GET['remove'] != "fr_FR"){
			unlink("lang/". $_GET['remove'].".json");
		}

		header("Location: ". routes("admin_langs"));
	}
}

$tpl->display("admin/langs.tpl");