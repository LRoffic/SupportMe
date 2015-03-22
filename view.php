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
	require_once 'menu.php';

	if($perm['viewticket'] == '0')
		{
			header('Location: ./index.php');
			exit();
		}

	if($siteconfig['registration'] == "force" || isset($_SESSION['pseudo']))
		{
			if(!empty($_SESSION['pseudo']) && !empty($_SESSION['id']))
				{
					$list = $bdd->prepare("SELECT * FROM ticket WHERE auteur = :id AND etat != '2' ORDER BY datepost");
					$list->execute(array('id'=>$_SESSION['id']));

					if($list->rowCount() > 0)
						{
							if($list->rowCount() == 1)
								{
									$lt = $list->fetch();

									if($siteconfig['htaccess'] == 'e')
										header('Location: ./ticket-'.$lt['id'].'.php');
									else
										header('Location: ./ticket.php?id='.$lt['id']);

									exit();
								}
							elseif($list->rowCount() > 1)
								{
									$tpl->assign('page', 'Liste des tickets');

									$t=0;
									while($lt = $list->fetch())
										{
											$listTick[$t] = array(
												'id'=>$lt['id'],
												'sujet'=>htmlspecialchars($lt['sujet']),
												'date'=>date('d/m/Y', $lt['datepost']),
												'etat'=>$lt['etat'],
												'assigned'=>$lt['assigned'],
												'assignto'=>$lt['assignto']
											);
											$t++;
										}
									$tpl->assign('listTick', $listTick);

									$tpl->display($template.'ticketlist.html');
								}
						}
					else
						{
							$tpl->assign('page', 'Erreur');
							$tpl->assign('erreur', 'noticket');
							$tpl->display($template.'erreur.html');
						}
				}
			else
				{
					header('Location: ./index.php');
					exit();
				}
		}
	elseif($siteconfig['registration'] == 'none' && !isset($_SESSION['pseudo']))
		{
			if(isset($_SESSION['email']) && isset($_SESSION['token']))
				{
					$list = $bdd->prepare("SELECT * FROM ticket WHERE auteur = :mail AND etat != '2' ORDER BY datepost");
					$list->execute(array('mail'=>$_SESSION['email']));

					if($list->rowCount() > 0)
						{
							if($list->rowCount() == 1)
								{
									$lt = $list->fetch();

									if($siteconfig['htaccess'] == 'e')
										header('Location: ./ticket-'.$lt['id'].'.php');
									else
										header('Location: ./ticket.php?id='.$lt['id']);

									exit();
								}
							elseif($list->rowCount() > 1)
								{
									$tpl->assign('page', 'Liste des tickets');

									$t=0;
									while($lt = $list->fetch())
										{
											$listTick[$t] = array(
												'id'=>$lt['id'],
												'sujet'=>htmlspecialchars($lt['sujet']),
												'date'=>date('d/m/Y', $lt['datepost']),
												'etat'=>$lt['etat'],
												'assigned'=>$lt['assigned'],
												'assignto'=>$lt['assignto']
											);
											$t++;
										}
									$tpl->assign('listTick', $listTick);

									$tpl->display($template.'ticketlist.html');
								}
						}
					else
						{
							$tpl->assign('page', 'Erreur');
							$tpl->assign('erreur', 'noticket');
							$tpl->display($template.'erreur.html');
						}
				}
			else
				{
					$tpl->display($template.'authentification.html');
				}
		}