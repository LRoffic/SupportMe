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

	if(!empty($_GET['option']))
		{
			if($_GET['option'] == "assign")
				{
					if(!empty($_GET['tid']) && !empty($_GET['to']))
						{
							if($perm['canAssign'] == "1")
								{
									if(isset($_GET['token']) && verifToken($_GET['token']))
										{
											$verifIfAssigned = $bdd->prepare("SELECt * FROM ticket WHERE id = ?");
											$verifIfAssigned->execute(array($_GET['tid']));
											$verifAssigned = $verifIfAssigned->fetch();
										
											if($verifIfAssigned->rowCount() == "1")
												{
													if($verifAssigned['assigned'] == "0")
														{
															$assign=$bdd->prepare("UPDATE ticket SET assigned = '1', assignto = :to WHERE id = :id");
															$assign->execute(array('to'=>$_GET['to'], 'id'=>$_GET['tid']));

															$tpl->assign('alert','assignok');
														}
												}
											else
												$tpl->assign('alert','notfound');
										}
									else
										$tpl->assign('alert', 'token');
								}
							else
								$tpl->assign('alert', 'notperm');
						}
					else
						$tpl->assign('alert', 'erreur');
				}
			elseif($_GET['option'] == "unassign")
				{
					if(!empty($_GET['tid']))
						{
							if($perm['canUnAssign'] == "1")
								{
									$verifIfAssigned = $bdd->prepare("SELECt * FROM ticket WHERE id = ?");
									$verifIfAssigned->execute(array($_GET['tid']));
									$verifAssigned = $verifIfAssigned->fetch();
								
									if($verifIfAssigned->rowCount() == "1")
										{
											if($verifAssigned['assigned'] == "1")
												{
													$assign=$bdd->prepare("UPDATE ticket SET assigned = '0', assignto = :to WHERE id = :id");
													$assign->execute(array('to'=>'', 'id'=>$_GET['tid']));
													$tpl->assign('alert','unassignok');
												}
										}
									else
										$tpl->assign('alert','notfound');
								}
							else
								$tpl->assign('alert', 'notperm');
						}
					else
						$tpl->assign('alert', 'erreur');
				}
			elseif($_GET['option'] == "notperm")
				$tpl->assign('alert','notperm');
			elseif($_GET['option'] == 'configok')
				{
					if($perm['config']=="1")
						$tpl->assign('alert', 'configok');
				}
			elseif($_GET['option'] == "config")
				{
					if($perm['config']=="1")
						{
							if(isset($_GET['token']) && verifToken($_GET['token']))
								{
									if(!empty($_POST['sitename']) && !empty($_POST['registration']) && !empty($_POST['faq']))
										{
											if($_POST['registration'] == "none" || $_POST['registration'] == "force")
												{
													if($_POST['faq'] == "e" || $_POST['faq'] == "d")
														{
															$upd=$bdd->prepare("UPDATE config SET sitename = :stname, registration = :reg, faq = :faq")->execute(array(
																'stname'=>htmlspecialchars($_POST['sitename']),
																'reg'=>$_POST['registration'],
																'faq'=>$_POST['faq']
															));

															header('Location: ./index.php?option=configok');
														}
													else
														$tpl->asign('alert', 'faqBroken');
												}
											else
												$tpl->asign('alert', 'registrationBroken');
										}
									else
										$tpl->assign('alert', 'emptyValues');
								}
							else
								$tpl->assign('alert', 'token');
						}
					else
						$tpl->assign('alert','notperm');
				}
		}

	$u=0;
	$getlastuser = $bdd->query("SELECT users.*, permissions.nom FROM users LEFT JOIN permissions ON users.permission = permissions.id ORDER BY users.id DESC LIMIT 3");
	while($users = $getlastuser->fetch())
		{
			$listuser[$u] = array(
				'id'=>$users['id'],
				'pseudo'=>htmlspecialchars($users['pseudo']),
				'email'=>htmlspecialchars($users['email']),
				'rang'=>$users['nom']
			);
			$u++;
		}
	$tpl->assign('listuser', $listuser);

	$tpl->display("index.html");

	ob_end_flush();//pour éviter les erreurs avant l'installation