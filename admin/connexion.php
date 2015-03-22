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
	session_start();
	include_once './database.php';
	include_once 'function.php';

	require_once '../libs/Smarty.class.php';
	$tpl = new Smarty();

	require_once '../libs/passwordlib.php';


	if(notinstall() == true)
		{
			header("Location: ../install/index.php");
			exit();
		}

	$con = $bdd->query("SELECT * FROM config WHERE id = '1'");
	$config = $con->fetch();

	if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['token']))
		{
			$verifuser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
			$verifuser->execute(array($_SESSION['id']));
			$uinfo = $verifuser->fetch();

			if($verifuser->rowCount() == 1)
				{
					$perm = getPerm($uinfo['permission']);

					if($perm['accessAdmin'] == '1')
						{
							header('Location: ./index.php');
							exit();
						}
				}
		}

	if(!empty($_POST['pseudo']) && !empty($_POST['password']))
		$connexion = connexion($_POST['pseudo'], $_POST['password']);

	if(isset($_GET['erreur']))
		{
			if($_GET['erreur'] == 'noaccess')
				$tpl->assign('erreur', 'noaccess');
			elseif($_GET['erreur'] == "badpass")
				$tpl->assign('erreur', 'badpass');
			elseif($_GET['erreur'] == "notexist")
				$tpl->assign('erreur', 'notexist');
		}

	$tpl->assign('config', $config);

	$tpl->display('connexion.html');