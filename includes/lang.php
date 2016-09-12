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
				$get_config = json_decode($get_content, true);
				$name = $get_config['config']['langue_name'];
				$filename = explode(".", $file);
				$version = $get_config['config']['version'];
				$host = $get_config['config']['host'];
				$fich[] = array("filename"=>$filename[0], "name"=>$name, "version"=>$version, "host"=>$host);
			}
		}
		
		closedir($dir);
		
		return $fich;
	}

	function newlang($lang = array()){
		$newlang = file_get_contents("http://supportme.dzv.me/lang/".VERSION."/".$lang.".json");
		file_put_contents("lang/".$lang.".json", $newlang);
		return $newlang;
	}

	function complete_lang($lang, $deft){
		foreach ($deft as $key=>$val) {
			if(is_array($deft[$key])) {
				
				$lang[$key] = complete_lang($lang[$key], $deft[$key]);
			}
			else if(!array_key_exists($key, $lang)) {
				$lang[$key] = $deft[$key];
			}
	 
		}
		return $lang;
	}

	function lang($lang){
		global $tpl;

		if(file_exists("lang/".$lang.".json"))
			$lang = file_get_contents("lang/".$lang.".json");
		elseif(file_exists("http://supportme.dzv.me/lang/".VERSION."/".$lang.".json")){
			$newlang = newlang($lang);
		} else{
			if(file_exists("lang/".default_language.".json"))
				$lang = file_get_contents("lang/".default_language.".json");
			else{
				if(file_exists("http://supportme.dzv.me/lang/".VERSION."/".default_language.".json"))
					$lang = newlang(default_language);
				else
					$lang = newlang("fr_FR");
			}
		}

		$lang = json_decode($lang, true);

		$lang = @complete_lang($lang, json_decode(file_get_contents("lang/".default_language.".json"), true));

		$lang = replace_lang($lang);

		$lang = hook_filter("lang", $lang);

		$tpl->assign("lang", $lang);

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
	
	/* Language Form */
	$langs = new FormBuilder();

	$langs->add($lang['footer']['language'], "select")->name("lang")->inputClass("form-control")->style('.form-inline')
	->choice($lang["config"]["langue_name"], '', true);

	$language_files = getlangs();

	foreach ($language_files as $lf) {
		if($lf['name'] != $lang['config']['langue_name']){
			$langs->choice($lf["name"], $lf['filename']);
		}
	}
	$langs->submit($lang['footer']['ok'])->submitStyle(".btn btn-default");

	$tpl->assign("langs", $langs);
	/* end of language form */

	