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
	include_once 'function.php';

	$install = notinstall();
	if($install == true)
		{
			header("Location: ./install/");
			exit();
		}

	include_once 'database.php';
	include_once './libs/passwordlib.php';
	include_once 'FastMailBuilder.php'; // FastMailBuilder class pour envoyer des mail créer par cfillion (http://cfillion.tk)

	require_once './libs/Smarty.class.php';
	$tpl = new Smarty();

	require_once './libs/HTMLPurifier.standalone.php';
	$confightml = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($confightml);

	$stconfig = $bdd->query("SELECT * FROM config WHERE id = 1");
	$siteconfig = $stconfig->fetch();

	if(!empty($siteconfig['template']))
		$template = $siteconfig['template'];
	else
		$template = 'default/';

	if(file_exists('./templates/'.$template.'version.json')){
		$json = file_get_contents('./templates/'.$template.'version.json');
		$inftemp = json_decode($json);
	}

	$tpl->assign('siteconfig', $siteconfig);
	$tpl->assign('sitename', $siteconfig['sitename']);

	if($siteconfig['registration'] == 'force')
		{
			if(isset($_SESSION['id']) && isset($_SESSION['token']))
				{
					$nbt = $bdd->prepare("SELECT * FROM ticket WHERE auteur = ? AND etat != '2'");
					$nbt->execute(array($_SESSION['id']));

					$tpl->assign('isconnect', 'true');
					$tpl->assign('nbticket', $nbt->rowCount());
					$tpl->assign('token', $_SESSION['token']);
					$tpl->assign('pseudo', htmlspecialchars($_SESSION['pseudo']));
					$tpl->assign('idsession', $_SESSION['id']);
				}
			else
				{
					$tpl->assign('isconnect', 'false');
				}
		}
	else
		{
			if(isset($_SESSION['email']) && isset($_SESSION['token']))
				{
					$nbt = $bdd->prepare("SELECT * FROM ticket WHERE auteur = ? AND etat != '2'");
					$nbt->execute(array($_SESSION['email']));

					$tpl->assign('isconnect', 'true');
					$tpl->assign('nbticket', $nbt->rowCount());
					$tpl->assign('token', $_SESSION['token']);
				}
		}

	if($siteconfig['cookie'] == "1")
		{
			if(isset($_COOKIE['auth']) && !isset($_SESSION['token']) && !isset($_SESSION['pseudo']) && !isset($_SESSION['id']))//vérifie si l'utilisateur est connécté grâce au cookie
				{ 
					$auth = $_COOKIE['auth'];
					$auth = explode('-----', $auth);
					
					$us = $bdd->prepare('SELECT * FROM users WHERE id = :id');
					$us->execute(array('id'=>$auth[0]));
					$verif = $us->fetch();
					
					if(isset($verif['pseudo']))
						{
							if(sha1($verif['pseudo'].$verif['password'].$_SERVER["REMOTE_ADDR"]) == $auth[1])
								{
									$random = random_str(15);
									$_SESSION['pseudo'] = $verif['pseudo'];
									$_SESSION['id'] = $verif['id'];
									$_SESSION['token'] = $random;
									setcookie('auth', $verif['id'].'-----'.password_hash($verif['pseudo'].$verif['password'].$_SERVER["REMOTE_ADDR"], PASSWORD_BCRYPT), time() + 365*24*3600, null, null, false, true);
								}
							else
								{
									setcookie('auth', '', time() - 3600, null, null, false, true);
								}
						}
					else
						{
							setcookie('auth', '', time() - 3600, null, null, false, true);
						}
				}
		}
	if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['token']))
		{
			$verifpseudo = $bdd->prepare('SELECT * FROM users WHERE id = :id');
			$verifpseudo->execute(array('id'=>$_SESSION['id']));
			$vp=$verifpseudo->fetch();

			$permission = $bdd->prepare('SELECT * FROM permissions WHERE id = :id');
			$permission->execute(array('id'=>$vp['permission']));
			$perm = $permission->fetch();

			if($vp['pseudo'] != $_SESSION['pseudo'])
				{
					session_destroy();

					if(isset($_COOKIE['auth']))
						setcookie('auth', '', time()-3600, null, null, false, false);

					echo '<script>alert(\'Vous avez été déconnécté, le pseudo de votre session ne correspond pas à son id, veuillez vous reconnécté avec votre adresse mail !\');window.location.reload();</script>';
				}
			else
				{
					$upd = $bdd->prepare('UPDATE users SET lastview = :last, ip = :ip WHERE id = :id');
					$upd->execute(array('last'=>time(), 'ip'=>$_SERVER['REMOTE_ADDR'], 'id'=>$_SESSION['id']));
				}
		}
	else
		{
			$permission = $bdd->query("SELECT * FROM permissions WHERE id = '0'");
			$perm = $permission->fetch();
		}
	$tpl->assign('perm', $perm);

	if($siteconfig['faq'] == 'e')
		{
			$nbfa = $bdd->query("SELECT COUNT(*) AS nbfa FROM ticket WHERE isfaq = '1'");
			$nbfaq = $nbfa->fetch();

			$tpl->assign('nbfaq', $nbfaq['nbfa']);
		}