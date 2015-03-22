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

	if($perm['viewticket'] != '1')
		{
			header("Location: index.php?option=notperm");
			exit();
		}

	if(!empty($_GET['tid']))
		{
			$info=$bdd->prepare("SELECT * FROM ticket WHERE id = ?");
			$info->execute(array($_GET['tid']));
			$inf=$info->fetch();
			if($info->rowCount() >= 1)
				{

					if($inf['etat'] == "2" && $perm['lastresolved'] == "1" || $inf['etat'] != "2")
						{
							if(!empty($_POST['commentaire']))
								{
									if($perm['comment'] == '1')
										{
											if($inf['etat'] != '2' && $inf['faq'] != '1')
												{
													$ins=$bdd->prepare("INSERT INTO comment (tid, auteur, datetime, message) VALUES (:tid, :aut, :dat, :mess)");
													$ins->execute(array('tid'=>$inf['id'], 'aut'=>$_SESSION['pseudo'], 'dat'=>time(), 'mess'=>$_POST['commentaire']));
													
													if(isset($_POST['mail']))
														{
															if(is_numeric($auteur['auteur']))
																$mail = getMail($auteur['auteur']);
															else
																$mail = $auteur['auteur'];

															$sujet = 'Réponse à votre ticket "'.$purifier->purify($inf['sujet']).'"';
															$text = "Bonjour, nous vous contactons pour vous signaler qu'une réponse à votre ticket sur le support de ".$siteconfig['sitename']." viens d'être posté.\n\n Cordialement l'équipe de ".$siteconfig['sitename'];
															$html = "Bonjour, nous vous contactons pour vous signaler qu'une réponse à votre ticket sur le support de ".$siteconfig['sitename']." viens d'être posté.<br /><br /> Cordialement l'équipe de <b>".$siteconfig['sitename']."</b>";

															sendMail($mail, $sujet, $text, $html);

															$tpl->assign("comresult", "okComWithMail");
														}
													else
														$tpl->assign("comresult", "okCom");
												}
											else
												$tpl->assign("comresult", "ticketclosed");
										}
									else
										$tpl->asign('comresult', 'notperm');
								}

							$tpl->assign("info", $inf);
							$tpl->assign("categorie", getCategorieName($inf['categorie']));
							$tpl->assign("auteur", getAuteurName($inf['auteur']));
							$tpl->assign("date", date('d/m/Y', $inf['datepost']));
							$tpl->assign("message", $purifier->purify($inf['contenu']));
						}
					else
						{
							header("Location: ./index.php?option=notperm");
							exit();
						}
				}
			else
				$tpl->assign("retour", "notexist");
		}
	else
		$tpl->assign("retour", "emptyid");

	$tpl->display("ticket.html");