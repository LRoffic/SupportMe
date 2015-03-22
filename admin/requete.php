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
	
	$action = $_GET['action'];
	switch($action)
		{
			case "listticket":
				if($perm['viewticket'] == '1')
					{
						$getticket = $bdd->query("SELECT * FROM ticket WHERE etat != '2'");
						if($getticket->rowCount() > 0)
							{
								echo '<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Sujet</th>
										<th>Auteur</th>
										<th>Catégorie</th>
										<th>Date</th>
										<th>&Eacute;tat</th>
										<th>Assigné</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>';
								while($infoticket = $getticket->fetch())
									{
										if($infoticket['assigned'] == "0" && $perm['ViewNotAssigned'] == "1" || $infoticket['assigned'] == "1" && $infoticket['assignto'] == $_SESSION['pseudo'] && $perm['viewNotAssignToMe'] == '0' || $perm['viewNotAssignToMe'] == '1')
											{
												if($infoticket['etat'] == '0')
													$label = '<label class="label label-danger">En cours...</label>';
												elseif($infoticket['etat'] == '1')
													$label = '<label class="label label-warning">En attente...</label>';
												elseif($infoticket['etat'] == '2')
													$label = '<label class="label label-success">Résolus</label>';

												echo'<tr>
													<td>'.$infoticket['id'].'</td>
													<td>'.htmlspecialchars($infoticket['sujet']).'</td>
													<td>'.getAuteurName($infoticket['auteur']).'</td>
													<td>'.getCategorieName($infoticket['categorie']).'</td>
													<td>'.date('d/m/Y', $infoticket['datepost']).'</td>
													<td>'.$label.'</td>
													<td>';
													if($infoticket['assigned'] == '0')
														echo 'Le ticket n\'est pas assigné !';
													else
														echo htmlspecialchars($infoticket['assignto']);

													if($infoticket['isfaq'] == "1")
														echo '<br /><label class="label label-success">Le ticket est une faq</label>';

													echo'</td>
													<td>
														<div class="btn-group">
															<a href="./ticket.php?tid='.$infoticket['id'].'" class="btn btn-info">Voir</a>';
															if($perm['canAssign'] == '1' && $infoticket['assigned'] == '0'){echo '<a href="./index.php?option=assign&tid='.$infoticket['id'].'&to='.htmlspecialchars($_SESSION['pseudo']).'&token='.$_SESSION['token'].'" class="btn btn-warning"> Me l\'assigner</a>';}
															elseif($perm['canUnAssign'] == '1' && $infoticket['assigned'] == '1'){echo '<a href="./index.php?option=unassign&tid='.$infoticket['id'].'&token='.$_SESSION['token'].'" class="btn btn-warning" >Désassigner</a>';}
															if($perm['resolve'] == '1') {echo"<a href=\"#\" onclick=\"clore({$infoticket["id"]},'{$_SESSION["token"]}')\" class=\"btn btn-success\">Clore</a>";}
															if($perm['deleteticket']){echo"<a href=\"#\" onclick=\"deleteTicket({$infoticket["id"]},'{$_SESSION["token"]}')\" class=\"btn btn-danger\">Supprimer</a>";}
														echo'</div>
													</td>
												</tr>';
										}
										
									}
								echo '</tbody>
								</table>';
							}
						else
							echo '<div style="text-align: center"><b>Aucun ticket n\'est ouvert pour l\'instant</b></div>';
					}
			break;

			case "deleteTicket":
				if($perm['deleteticket'] == "1")
						{
							$verifExisted=$bdd->prepare("SELECT * FROM ticket WHERE id = ?");
							$verifExisted->execute(array($_GET['tid']));
							$auteur=$verifExisted->fetch();

							if($verifExisted->rowCount() == "1")
								{
									if(isset($_GET['token']) && verifToken($_GET['token']))
										{
											$del=$bdd->prepare("DELETE FROM ticket WHERE id = ?");
											$del->execute(array($_GET['tid']));

											$delcom=$bdd->prepare("DELETE FROM response WHERE tid = ?");
											$delcom->execute(array($_GET['tid']));

											if(is_numeric($auteur['auteur']))
												$mail = getMail($auteur['auteur']);
											else
												$mail = $auteur['auteur'];

											$sujet = "Ticket supprimé";
											$text = "Bonjour, nous vous contactons pour vous signaler que votre ticket sur le support de ".$siteconfig['sitename']." a été supprimé, vous ne pourrez plus y répondre, ni le réouvrir.\n\n Cordialement l'équipe de ".$siteconfig['sitename'];
											$html = "Bonjour, nous vous contactons pour vous signaler que votre ticket sur le support de ".$siteconfig['sitename']." a été supprimé, vous ne pourrez plus y répondre, ni le réouvrir.<br /><br /> Cordialement l'équipe de ".$siteconfig['sitename'];

											sendMail($mail, $sujet, $text, $html);

											echo '<div class="alert alert-success alrt">Le ticket a été supprimé ! Un Email a été envoyé à l\'utilisateur</div>';
										}
									else
										echo '<div class="alert alert-danger alrt">Token invalide ou innexistant !</div>';
								}
							else
								echo '<div class="alert alert-danger alrt">Le ticket que vous souhaitez supprimer n\'existe pas !</div>';
						}
					else
						echo '<div class="alert alert-danger alrt">Vous n\'avez pas la permission de supprimer un ticket !</div>';
			break;

			case "clore":
				if($perm['resolve'] == "1")
						{
							$verifExisted=$bdd->prepare("SELECT * FROM ticket WHERE id = ?");
							$verifExisted->execute(array($_GET['tid']));
							$auteur=$verifExisted->fetch();

							if($verifExisted->rowCount() == "1")
								{
									if(isset($_GET['token']) && verifToken($_GET['token']))
										{
											$del=$bdd->prepare("UPDATE ticket SET etat = '2' WHERE id = ?");
											$del->execute(array($_GET['tid']));

											if(is_numeric($auteur['auteur']))
												$mail = getMail($auteur['auteur']);
											else
												$mail = $auteur['auteur'];

											$sujet = "Ticket supprimé";
											$text = "Bonjour, nous vous contactons pour vous signaler que votre ticket sur le support de ".$siteconfig['sitename']." a été marqué comme résolu, vous pouvez le réouvrir afin d'ajouter des détails à votre demande.\n\n Cordialement l'équipe de ".$siteconfig['sitename'];
											$html = "Bonjour, nous vous contactons pour vous signaler que votre ticket sur le support de ".$siteconfig['sitename']." a été marqué comme résolu, vous pouvez le réouvrir afin d'ajouter des détails à votre demande.<br /><br /> Cordialement l'équipe de ".$siteconfig['sitename'];

											sendMail($mail, $sujet, $text, $html);

											echo '<div class="alert alert-success alrt">Le ticket a été rsolus ! Un Email a été envoyé à l\'utilisateur</div>';
										}
									else
										echo '<div class="alert alert-danger alrt">Token invalide ou innexistant !</div>';
								}
							else
								echo '<div class="alert alert-danger alrt">Le ticket que vous souhaitez résoudre n\'existe pas ! !</div>';
						}
					else
						echo '<div class="alert alert-danger alrt">Vous n\'avez pas la permission de résoudre un ticket !</div>';
			break;

			case "commenter":
				if(!empty($_GET['id']))
					{
						$info=$bdd->prepare("SELECT * FROM ticket WHERE id = ?");
						$info->execute(array($_GET['id']));
						$inf=$info->fetch();
						if($info->rowCount() >= 1)
							{
								if(!empty($_POST['commentaire']))
									{
										if($perm['comment'] == '1')
											{
												if($inf['etat'] != '2' && $inf['isfaq'] != '1')
													{
														$ins=$bdd->prepare("INSERT INTO response (tid, autor, datepost, contenu) VALUES (:tid, :aut, :dat, :mess)");
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

																echo '<div class="alert alert-success">Votre réponse a été postez ! Un mail a été envoyé à l\'utilisateur pour le prévenir.</div>';
															}
														else
															echo '<div class="alert alert-success">Votre réponse a été postez !</div>';
													}
												else
													echo '<div class="alert alert-danger">Le ticket est fermé, vous devez le réouvrir pour y répondre !</div>';
											}
										else
											echo '<div class="alert alert-danger">Vous n\'avez pas la permission de répondre au ticket !</div>';
									}
							}
						else
							echo '<div class="alert alert-danger">Le ticket n\'existe pas !</div>';
					}
				else
					echo '<div class="alert alert-danger">L\'id du ticket est manquant !</div>';
			break;

			case "commentaire":
				if(isset($_GET['id']))
					{
						$getticket=$bdd->prepare("SELECT * FROM ticket WHERE id = ?");
						$getticket->execute(array($_GET['id']));
						$tinf=$getticket->fetch();

						if($getticket->rowCount() == 1)
							{
								if($perm['viewticket']=='1')
									{
										if($tinf['assigned'] == '1' && $tinf['assignto'] == $_SESSION['pseudo'] && $perm['viewNotAssignToMe'] == '0' || $perm['viewNotAssignToMe'] == '1')
											{
												$coms = $bdd->prepare("SELECT * FROM response WHERE tid = ? ORDER BY id DESC");
												$coms->execute(array($tinf['id']));

												if($coms->rowCount() >= 1)
													{
														while($co = $coms->fetch())
															{
																echo '<div class="well" id="c'.$co['id'].'">
																	<em><u>Par '.htmlspecialchars($co['autor']).' le '.date('d/m/Y', $co['datepost']).'</u></em><br />
																	<div class="well">'.$purifier->purify($co['contenu']).'</div>';
																echo'</div>';
															}
													}
												else
													echo '<div class="alert alert-danger">Il n\'y a aucun commentaire sur ce ticket !</div>';
											}
										else
											echo '<div class="alert alert-danger">Le ticket ne vous est pas assigné, et vous n\'avez pas la permission de voir les ticket qui ne vous sont pas assigné !</div>';
									}
								else
									echo '<div class="alert alert-danger">Vous n\'avez pas la permission de voir le ticket</div>';
							}
						else
							echo '<div class="alert alert-danger">Le ticket n\'existe pas !</div>';
					}
				else
					echo '<div class="alert alert-danger">L\'id du ticket est manquant !</div>';
			break;

			case "etat":
				if(isset($_GET['id']))
					{
						$getticket=$bdd->prepare("SELECT * FROM ticket WHERE id = ?");
						$getticket->execute(array($_GET['id']));
						$tinf=$getticket->fetch();

						if($getticket->rowCount() == 1)
							{
								if($perm['viewticket']=='1')
									{
										if($tinf['assigned'] == '1' && $tinf['assignto'] == $_SESSION['pseudo'] && $perm['viewNotAssignToMe'] == '0' || $perm['viewNotAssignToMe'] == '1')
											{
												echo "&Eacute;tat : ";
												if($tinf['etat'] == "0")
													echo '<label class="label label-danger">En cours...</label>';
												elseif($tinf['etat'] == "1")
													echo '<span class="label label-warning">En attente de votre réponse</span>';
												elseif($tinf['etat'] == '2')
													echo '<span class="label label-success">Résolue</span>';

												echo "<br /> Assigné : ";

												if($tinf['assigned'] == "1")
													echo htmlspecialchars($tinf['assignto']);
												else
													echo "Le ticket n'est pas assigné !";
											}
										else
											echo '<div class="alert alert-danger">Le ticket ne vous est pas assigné, et vous n\'avez pas la permission de voir les ticket qui ne vous sont pas assigné !</div>';
									}
								else
									echo '<div class="alert alert-danger">Vous n\'avez pas la permission de voir le ticket</div>';
							}
						else
							echo '<div class="alert alert-danger">Le ticket n\'existe pas !</div>';
					}
				else
					echo '<div class="alert alert-danger">L\'id du ticket est manquant !</div>';
			break;
		}
?>