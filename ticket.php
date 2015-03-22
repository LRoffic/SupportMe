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
	include_once 'menu.php';

	if($perm['viewticket'] == '0')
		{
			header('Location: ./index.php');
			exit();
		}

	if($siteconfig['registration'] == 'force' || isset($_SESSION['id']))
		{
			if(empty($_SESSION['id']) || empty($_SESSION['pseudo']) || empty($_SESSION['token']))
				{
					header('Location: ./index.php');
					exit();
				}
		}
	elseif($siteconfig['registration'] == 'none' && !isset($_SESSION['id']))
		{
			if(empty($_SESSION['email']) || empty($_SESSION['token']))
				{
					header('Location: ./index.php');
					exit();
				}
		}

	if(empty($_GET['id']))
		{
			$tpl->assign('erreur', 'emptyid');
			$tpl->assign('page', 'Erreur');
			$tpl->display($template.'erreur.html');
		}
	else
		{
			if(is_numeric($_GET['id']))
				{
					$verif = $bdd->prepare("SELECT * FROM ticket WHERE id = :id");
					$verif->execute(array('id'=>$_GET['id']));
					$info = $verif->fetch();

					if($verif->rowCount() == '1')
						{
							if($siteconfig['registration'] == 'force' || isset($_SESSION['id']))
								{
									if($info['auteur'] == $_SESSION['id'])
										{
											$ok = 'ok';
										}
									else
										{
											$tpl->assign('erreur', 'notautor');
											$tpl->assign('page', 'Erreur');
											$tpl->display($template.'erreur.html');
										}
								}
							elseif($siteconfig['registration'] == 'none' && !isset($_SESSION['id']))
								{
									if($info['email'] == $_SESSION['email'])
										{
											$ok = 'ok';
										}
									else
										{
											$tpl->assign('erreur', 'notautor');
											$tpl->assign('page', 'Erreur');
											$tpl->display($template.'erreur.html');
										}
								}

							if(isset($ok) && $ok == 'ok')
								{
									if($perm['lastresolved'] == '0' && $info['etat'] == '2')
										{
											header('Location: ./index.php');
											exit();
										}
									$tpl->assign('page', htmlspecialchars($info['sujet']));
									$tpl->assign('info', $info);
									$tpl->assign('sujet', htmlspecialchars($info['sujet']));
									$tpl->assign('date', date('d/m/Y', $info['datepost']));
									$tpl->assign('contenu', $purifier->purify($info['contenu']));
									$tpl->display($template.'ticket.html');
								}
						}
					else
						{
							$tpl->assign('erreur', 'ticketnotfound');
							$tpl->assign('page', 'Erreur');
							$tpl->display($template.'erreur.html');
						}
				}
			else
				{
					$tpl->assign('erreur', 'idnotnumeric');
					$tpl->assign('page', 'Erreur');
					$tpl->display($template.'erreur.html');
				}
		}