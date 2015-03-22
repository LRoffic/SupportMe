<?php
/*
Copyright (C) 2013 Dubourg Lee-Roy

This file is part of Support Me.

Support Me is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Support Me is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU Lesser General Public License
along with Support Me. If not, see <http://www.gnu.org/licenses/>.
 */
 ?>
<?php
	ob_start();//pour éviter les erreurs avant l'installation
	session_start();
	include_once './function.php';

	if(notinstall() == true)
		{
			header("Location: ../install/index.php");
			exit();
		}
	
	include_once './database.php';
	include './verifauth.php';

	include_once '../FastMailBuilder.php';

	require_once '../libs/Smarty.class.php';
	$tpl = new Smarty();

	require_once '../libs/passwordlib.php';

	require_once '../libs/HTMLPurifier.standalone.php';
	$confightml = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($confightml);
	
	update_sql();

	$conf = $bdd->query("SELECT * FROM config WHERE id = '1'");
	$config = $conf->fetch();
	$tpl->assign('config', $config);
	$tpl->assign('perm', $perm);
	$tpl->assign('pseudo', htmlspecialchars($_SESSION['pseudo']));
	$tpl->assign('token', $_SESSION['token']);

	$getcontents = file_get_contents("http://supportme.dzv.me/version.php");
	$contents = json_decode($getcontents, true);

	if(!empty($contents['message']))
		$tpl->assign('alerte', $contents['message']);
		
	if($config['version'] < $contents['version'])
		$tpl->assign('version', $contents['version']);

	if(!empty($contents['link']));
		$tpl->assign("link", $contents['link']);
	
	if(!empty($contents['sql']))
		$bdd->query(file_get_contents($contents['sql']));
	
	if(file_exists("bdd.sql"))
		{
			$bdd->query(file_get_contents("bdd.sql"));
			unlink("bdd.sql");
		}