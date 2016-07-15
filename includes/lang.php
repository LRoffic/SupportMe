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

	/* function */
	function replace_lang($lang){
		global $bdd;
		global $config;

		$array_replace_lang = array(
			"%sitename%" => htmlspecialchars($config->site_name)
		);

		$array_replace_lang = hook_filter("array_replace_lang", $array_replace_lang);

		array_walk_recursive($lang, function(&$item, $key) use ($array_replace_lang,$lang){
			$item = str_replace(array_keys($array_replace_lang), array_values($array_replace_lang), $item);
		});

		return $lang;
	}

	function getlangs(){
		$dirname = 'lang/';
		$dir = opendir($dirname);
		$fich = array();
		
		while($file = readdir($dir)) {
			if($file != '.' && $file != '..' && !is_dir($dirname.$file))
			{
				$get_content = file_get_contents($dirname.$file);
				$get_name = json_decode($get_content, true);
				$name = $get_name['config']['langue_name'];
				$filename = explode(".", $file);
				$fich[] = array("filename"=>$filename[0], "name"=>$name);
			}
		}
		
		closedir($dir);
		
		return $fich;
	}

	function lang($lang){
		global $tpl;

		if(file_exists("lang/".$lang.".json"))
			$lang = file_get_contents("lang/".$lang.".json");
		elseif(file_exists("http://supportme.dzv.me/lang/3.0/".$lang.".json"))
			$lang = file_get_contents("http://supportme.dzv.me/lang/3.0/".$lang.".json");
		else
			$lang = file_get_contents("http://supportme.dzv.me/lang/3.0/fr_FR.json");

		$lang = json_decode($lang, true); 
		$lang = replace_lang($lang);

		$lang = hook_filter("lang", $lang);

		$tpl->assign("lang", $lang);

		$tpl->assign("langs", getlangs());

		return $lang;
	}
	/* end of function */

	if(!empty($_POST['lang'])){
		if(!empty($_COOKIE['lang'])){
			setcookie('lang', '', time()-3600, null, null, false, false);
		}
		setcookie('lang', $_POST['lang'], time()+365*24*3600, null, null, false, false);

		$lang = lang($_POST['lang']);
	} elseif(!empty($_COOKIE['lang'])){
		$lang = lang($_COOKIE['lang']);
	} else {
		$lang = lang($config->lang);
	}