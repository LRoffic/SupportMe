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

function routes($road){
	global $router;

	return $router->generate($road);
}

function plugin($plugin){
	global $router;

	return $router->generate("admin_plugin_settings", array("name"=>$plugin));
}

function Recaptcha(){
	global $config;

	if(empty($config['recaptcha_public_key']) || empty($config['recaptcha_private_key']))
		return false;

	return true;
}

function verif_category($category){
	global $bdd;

	$category = ORM::for_table('category')->where("id", $category)->count();
	return $category;
}

function temps_ecoule($date,$type="timestamp") {
	if($type == "timestamp") {
		$date2 = $date; // depuis cette date
	} elseif($type == "date") {
		$date2 = strtotime($date); // depuis cette date
	}

	$Ecart = time()-$date2;
	$Annees = date('Y',$Ecart)-1970;
	$Mois = date('m',$Ecart)-1;
	$Jours = date('d',$Ecart)-1;
	$Heures = date('H',$Ecart)-1;
	$Minutes = date('i',$Ecart);
	$Secondes = date('s',$Ecart);

	if($Annees > 0) {
		return "Il y a ".$Annees." an".($Annees>1?"s":"")." et ".$Jours." jour".($Jours>1?"s":""); // on indique les jours avec les année pour être un peu plus précis
	}
	if($Mois > 0) {
		return "Il y a ".$Mois." mois et ".$Jours." jour".($Jours>1?"s":""); // on indique les jours aussi
	}
	if($Jours > 0) {
		return "Il y a ".$Jours." jour".($Jours>1?"s":"");
	}
	if($Heures > 0) {
		return "Il y a ".$Heures." heure".($Heures>1?"s":"");
	}
	if($Minutes > 0) {
		return "Il y a ".$Minutes." minute".($Minutes>1?"s":"");
	}
	if($Secondes > 0) {
		return "Il y a ".$Secondes." seconde".($Secondes>1?"s":"");
	}
}

function getTicketURL($id){
	global $router;
	return $router->generate("ticket", array("id"=>$id));
}

function getStatusArray(){
	global $lang;

	$status_array = [
		array("name"=>$lang['status']['waiting'], "close"=> false),
		array("name"=>$lang['status']['reply'], "close"=> false),
		array("name"=>$lang['status']['closed'], "close"=> true)
	];

	$status_array = hook_filter("status_array", $status_array);

	return $status_array;
}

function getStatus($id){
	$status_array = getStatusArray();

	if(array_key_exists($id, $status_array))
		return $status_array[$id];

	return $status_array[0];
}

function getCategory($id){
	global $lang;

	$cat = ORM::for_table("category")->find_one($id);

	if(empty($cat))
		return $lang['category']['notfound'];

	return htmlspecialchars($cat->name);
}

function text_replace($string){

	$sting = htmlspecialchars($string);

	$string = hook_filter("text", $string);

	return Twemoji::Text($string);
}

function testCaptcha(){
	global $config;
	global $tpl;
	global $lang;

	$privatekey = $config->recaptcha_private_key;//clé privé recaptcha

	$recaptcha = new \ReCaptcha\ReCaptcha($privatekey);

	$remoteIp = $_SERVER['REMOTE_ADDR'];

	$gRecaptchaResponse = $_POST['g-recaptcha-response'];

	$resp = $recaptcha->verify($gRecaptchaResponse, $remoteIp);
	if (!$resp->isSuccess()) {
		$tpl->assign("error", $lang['error']["Recaptcha"]);
		return $resp->getErrorCodes();
	}

	return true;
}

function verif_token(){
	if(empty($_GET['token']) || $_GET['token'] != $_SESSION['token']){
		header("Location: ". routes("404"));
		exit();
	}
}

function get_plugin_filename($file){
	$info_filename = pathinfo($file);

	if(!empty($info_filename['extension']))
		return basename($file, ".".$info_filename['extension']);
	else
		return basename($file);
}

function verif_installed_plugin($file){
	global $plugins;

	$filename = get_plugin_filename($file);

	if(empty($plugins) || !array_key_exists($filename, $plugins))
		return true;

	return false; 
}

function isUpToDate_plugin($url, $version){
	if(!checkFileExist($url))
		return false;

	$verif = file_get_contents($url);
	$verif = json_decode($verif, true);

	if($verif['version'] > $version)
		return true;

	return false;
}

function checkFileExist($file){
	$file_headers = @get_headers($file);
	if(!empty($file_headers[0]) && $file_headers[0] != 'HTTP/1.1 404 Not Found')
		return true;

	return false;
}

function getRangName($id){
	$rang = ORM::for_table("permissions")->find_one($id);

	if(!empty($rang))
		return $rang->name;
	else
		return "default";
}