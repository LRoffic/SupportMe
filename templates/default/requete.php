<?php
	session_start();

	include_once '../../database.php';
	include_once '../../libs/passwordlib.php';
	include_once '../../function.php';
	include_once '../../FastMailBuilder.php'; // FastMailBuilder class pour envoyer des mail créer par cfillion (http://cfillion.tk)

	require_once '../../libs/Smarty.class.php';
	$tpl = new Smarty();

	require_once '../../libs/HTMLPurifier.standalone.php';
	$confightml = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($confightml);

	$stconfig = $bdd->query("SELECT * FROM config WHERE id = 1");
	$siteconfig = $stconfig->fetch();

	if(!empty($_COOKIE['lang'])){
		if(file_exists('../../lang/'.$_COOKIE['lang'].'.json')){
			$folderlang = '../../lang/';
			$sitelang = $_COOKIE['lang'];
		} elseif(file_exists('../../lang/'.$siteconfig['lang'].'.json')){
			$folderlang = '../../lang/';
			$sitelang = $sitelang['lang'];
		} else {
			$folderlang = 'http://supportme.dzv.me/lang/';
			if(file_exists($folderlang.$siteconfig['lang'].'.json')){
				$sitelang = $siteconfig['lang'];
			} else {
				$sitelang = 'fr_FR';
			}
		}
	} else {
		if(file_exists('../../lang/'.$siteconfig['lang'].'.json')){
			$folderlang = '../../lang/';
			$sitelang = $siteconfig['lang'];
		} else {
			$folderlang = 'http://supportme.dzv.me/lang/';
			if(file_exists($folderlang.$siteconfig['lang'].'.json')){
				$sitelang = $siteconfig['lang'];
			} else {
				$sitelang = 'fr_FR';
			}
		}
	}

	$getlang = file_get_contents($folderlang.$sitelang.".json");
	$lan = json_decode($getlang ,true);
	$lang = replace_lang($lan);

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

					echo '<script>alert(\''.$lang['sessionError'].'\');window.location.reload();</script>';
				}
			else
				{
					$upd = $bdd->prepare('UPDATE users SET lastview = :last, ip = :ip WHERE id = :id');
					$upd->execute(array('last'=>time(), 'ip'=>$_SERVER['REMOTE_ADDR'], 'id'=>$_SESSION['id']));
				}
		}
	else
		{
			$permission = $bdd->query("SELECT * FROM permissions WHERE id = '1'");
			$perm = $permission->fetch();
		}

	$action = (isset($_GET['action']))?htmlspecialchars($_GET['action']):'';

	switch($action)
		{
			case "commenter":
				if(!empty($_GET['id']))
					{
						if(is_numeric($_GET['id']))
							{
								$ver = $bdd->prepare("SELECT * FROM ticket WHERE id = ?");
								$ver->execute(array($_GET['id']));
								$v = $ver->fetch();

								if($ver->rowCount() == 1)
									{
										if($siteconfig['registration'] == 'force')
											{
												if($_SESSION['id'] == $v['auteur'])
													{
														$isauteur = 'true';
														$auteur = htmlspecialchars($_SESSION['pseudo']);
													}
												else
													{
														echo '<div class="alert alert-danger alrt">'.$lang['error'].'</div>';
														$isauteur = 'false';
													}
											}
										elseif($siteconfig['registration'] == 'none')
											{
												if($_SESSION['email'] == $v['email'])
													{
														$isauteur = 'true';
														$auteur = htmlspecialchars($_SESSION['email']);
													}
												else
													{
														echo '<div class="alert alert-danger alrt">'.$lang['error'].'</div>';
														$isauteur = 'false';
													}
											}

										if($isauteur == 'true')
											{
												if($perm['comment'] == '1')
													{
														if(!empty($_POST['commentaire']))
															{
																if($v['etat'] != '2')
																	{
																		if($v['etat'] == '1')
																			{
																				$upd=$bdd->prepare("UPDATE ticket SET etat = '0' WHERE id = ?");
																				$upd->execute(array($v['id']));
																			}

																		$ins = $bdd->prepare("INSERT INTO response (tid, autor, contenu, datepost) VALUE (:id, :auteur, :contenu, :datepost)");
																		$ins->execute(array('id'=>$v['id'], 'auteur'=>$auteur, 'contenu'=>$_POST['commentaire'], 'datepost'=>time()));
																		echo '<div class="alert alert-success alrt">'.$lang['commentSuccess'].'</div>';
																	}
																else
																	echo '<div class="alert alert-danger alrt">'.$lang['ticketClosed'].'</div>';
															}
														else
															echo '<div class="alert alert-danger alrt">'.$lang['emptyCom'].'</div>';
													}
												else
													echo '<div class="alert alert-danger alrt">'.$lang['permCom'].'</div>';
											}
									}
								else
									{
										echo '<div class="alert alert-danger alrt">'.$lang['error'].'</div>';
									}
							}
						else
							{
								echo '<div class="alert alert-danger alrt">'.$lang['error'].'</div>';
							}
					}
				else
					{
						echo '<label class="label label-danger">'.$lang['error'].'</label>';
					}
			break;

			case "commentaire":
				if(!empty($_GET['id']))
					{
						if(is_numeric($_GET['id']))
							{
								$ver = $bdd->prepare("SELECT * FROM ticket WHERE id = ?");
								$ver->execute(array($_GET['id']));
								$v = $ver->fetch();

								if($ver->rowCount() == 1)
									{
										if($siteconfig['registration'] == 'force' || isset($_SESSION['id']))
											{
												if($_SESSION['id'] == $v['auteur'])
													$isauteur = 'true';
												else
													{
														echo '<label class="label label-danger">'.$lang['error'].'</label>';
														$isauteur = 'false';
													}
											}
										elseif($siteconfig['registration'] == 'none' && !isset($_SESSION['id']))
											{
												if($_SESSION['email'] == $v['email'])
													$isauteur = 'true';
												else
													{
														echo '<label class="label label-danger">'.$lang['error'].'</label>';
														$isauteur = 'false';
													}
											}

										if($isauteur == 'true')
											{
												$coms = $bdd->prepare("SELECT * FROM response WHERE tid = ? ORDER BY id DESC");
												$coms->execute(array($v['id']));

												if($coms->rowCount() >= 1)
													{
														while($co = $coms->fetch())
															{
																if($co['masked'] != '1')
																	{
																		echo '<div class="well" id="c'.$co['id'].'">
																			<em><u>'$lang['by'].' '.htmlspecialchars($co['autor']).' '.$lang['on'].' '.date($lang['phpDate'], $co['datepost']).'</u></em><br />
																			<div class="well">'.$purifier->purify($co['contenu']).'</div>
																		</div>';
																	}
															}
													}
												else
													echo '<div class="alert alert-danger">'.$lang['noResponse'].'</div>';
											}
									}
								else
									{
										echo '<label class="label label-danger">'.$lang['error'].'</label>';
									}
							}
						else
							{
								echo '<label class="label label-danger">'.$lang['error'].'</label>';
							}
					}
				else
					{
						echo '<label class="label label-danger">'.$lang['error'].'</label>';
					}
			break;

			case "etat":
				if(!empty($_GET['id']))
					{
						if(is_numeric($_GET['id']))
							{
								$ver = $bdd->prepare("SELECT * FROM ticket WHERE id = ?");
								$ver->execute(array($_GET['id']));
								$v = $ver->fetch();

								if($ver->rowCount() == 1)
									{
										if($siteconfig['registration'] == 'force' || isset($_SESSION['id']))
											{
												if($_SESSION['id'] == $v['auteur'])
													$isauteur = 'true';
												else
													{
														echo '<label class="label label-danger">'.$lang['error'].'</label>';
														$isauteur = 'false';
													}
											}
										elseif($siteconfig['registration'] == 'none' && !isset($_SESSION['id']))
											{
												if($_SESSION['email'] == $v['email'])
													$isauteur = 'true';
												else
													{
														echo '<label class="label label-danger">'.$lang['error'].'</label>';
														$isauteur = 'false';
													}
											}

										if($isauteur == 'true')
											{
												if($v['etat'] == '0')
													echo '<label class="label label-danger">'.$lang['inProgress'].'</label>';
												elseif($v['etat'] == '1')
													echo '<span class="label label-warning">'.$lang['waitingReply'].'</span>';
												elseif($v['etat'] == '2')
													echo '<span class="label label-success">'.$lang['resolved'].'</span>';
											}
									}
								else
									{
										echo '<label class="label label-danger">'.$lang['error'].'</label>';
									}
							}
						else
							{
								echo '<label class="label label-danger">'.$lang['error'].'</label>';
							}
					}
				else
					{
						echo '<label class="label label-danger">'.$lang['error'].'</label>';
					}
			break;

			case "reopen":
				if($perm['reopen'] == '1')
					{
						if(!empty($_GET['id']))
							{
								$verif = $bdd->prepare('SELECT * FROM ticket WHERE id = :id');
								$verif->execute(array('id'=>$_GET['id']));
								$ver = $verif->fetch();

								if($siteconfig['registration'] == 'none')
									{
										if(!empty($ver['email']) && $ver['email'] == $_SESSION['email'])
											$ok = 'ok';
										else
											echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['yourNotAutor'].'</div>';
									}
								elseif($siteconfig['registration'] == 'force')
									{
										if(!empty($ver['auteur']) && $ver['auteur'] == $_SESSION['id'])
											$ok = 'ok';
										else
											echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['yourNotAutor'].'</div>';
									}

								if(isset($ok) && $ok == 'ok')
									{
										$upd = $bdd->prepare("UPDATE ticket SET etat = '0' WHERE id = :id");
										$upd->execute(array('id'=>$_GET['id']));


										echo '<div class="alert alert-success alrt">'.$lang['ticketReopen'].' <script>$("#ticket'.$_GET['id'].'").slideUp("slow");</script></div>';
									}
							}
						else
							echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['emptyTicketID'].'</div>';
					}
				else
					echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['youCantResolve'].'</div>';
			break;

			case "resolve":
				if($perm['resolve'] == '1')
					{
						if(!empty($_GET['id']))
							{
								$verif = $bdd->prepare('SELECT * FROM ticket WHERE id = :id');
								$verif->execute(array('id'=>$_GET['id']));
								$ver = $verif->fetch();

								if($siteconfig['registration'] == 'none')
									{
										if(!empty($ver['email']) && $ver['email'] == $_SESSION['email'])
											$ok = 'ok';
										else
											echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['yourNotAutor'].'</div>';
									}
								elseif($siteconfig['registration'] == 'force')
									{
										if(!empty($ver['auteur']) && $ver['auteur'] == $_SESSION['id'])
											$ok = 'ok';
										else
											echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['yourNotAutor'].'</div>';
									}

								if(isset($ok) && $ok == 'ok')
									{
										$upd = $bdd->prepare("UPDATE ticket SET etat = '2' WHERE id = :id");
										$upd->execute(array('id'=>$_GET['id']));


										echo '<div class="alert alert-success alrt">'.$lang['ticketResolved'].' <script>$("#ticket'.$_GET['id'].'").slideUp("slow");</script></div>';
									}
							}
						else
							echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['emptyTicketID'].'</div>';
					}
				else
					echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['youCantResolve'].'</div>';
			break;

			case "emailauth":
				if(!empty($_POST['email']) && !empty($_POST['password']) && !isset($_SESSION['email']))
					{
						$verif = $bdd->prepare("SELECT * FROM emails WHERE email = :mail");
						$verif->execute(array('mail'=>$_POST['email']));
						$ver = $verif->fetch();

						if($verif->rowCount() == 1)
							{
								if($ver['pass'] == $_POST['password'])
									{
										$_SESSION['email'] = $ver['email'];
										$_SESSION['token'] = random_str(15);
										echo '<div class="alert alert-success alrt">'.$lang['authSuccess'].'</div><script>setTimeout(function() { window.location.reload(); }, 4000);$("#emailauth").slideUp("slow");</script>';
									}
								else
									{
										
										echo '<div class="alert alert-danger alrt">'.$lang['wrongCode'].'</div>';
									}
							}
						else
							{
								echo '<div class="alert alert-danger alrt">'.$lang['MailJohnDoe'].'</div>';
							}
					}
			break;

			case "new":
				if($siteconfig['registration'] == 'none' && empty($_SESSION['pseudo']))
					{
						if(!empty($_POST['email']) && !empty($_POST['sujet']) && !empty($_POST['categorie']) && !empty($_POST['message']))
							{
								if($perm['sendticket'] == '1')
									{
										if($siteconfig['recaptcha'] == "e")
											{
												include_once '../../recaptchalib.php';

												if(!empty($_POST['recaptcha_response_field']))
													{
														$privatekey = $siteconfig['recaptcha_privatekey'];
														$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

														if (!$resp->is_valid)
															echo '<div class="alert alert-danger alrt">'.$lang['wrongCaptcha'].'</div>';
														else
															$ok = 'ok';
													}
												else
													echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['emptyCaptcha'].'</div>';
											}
										else
											$ok = 'ok';

										if(!empty($ok) && $ok == 'ok')
											{
												if(preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!", $_POST['email']))
													{
														$verifCodeMail = $bdd->prepare('SELECT * FROM emails WHERE email = :email');
														$verifCodeMail->execute(array('email'=>$_POST['email']));
														$vcm = $verifCodeMail->fetch();

														if(!empty($vcm['email']) && !empty($vcm['id']) && !empty($vcm['pass']))
															{
																$mailcorrect = 'ok';
															}
														else
															{
																$random=random_str(5);
																$ins = $bdd->prepare('INSERT INTO emails (email, pass) VALUES (:email, :pass)');
																$ins->execute(array('email'=>$_POST['email'], 'pass'=>$random));

																$mail = new FastMailBuilder();//envoie de mail grâce à fastmailbuilder de cfillion ( http://cfillion.tk )
																$mail->subject('Code pour voir vos tickets sur le support '.$siteconfig['sitename'])
																->from('support '.$siteconfig['sitename'],$siteconfig['sitemail'])
																->to($_POST['email'])
																->replyTo($siteconfig['sitemail'])
																->text($lang['welcomeTextMail1'].$random.'\n'.$lang['welcomeTextMail2'])
																->html($lang['welcomeHTMLMail1'].$random.$lang['welcomeHTMLMail2'])
																->send();

																$mailcorrect = "ok";
															}

														if(!empty($mailcorrect) && $mailcorrect == 'ok')
															{
																$ins = $bdd->prepare('INSERT INTO ticket (sujet, auteur, categorie, email, datepost, contenu) VALUES (:sujet, :auteur, :categorie, :email, :datepost, :contenu)');
																$ins->execute(array('sujet'=>$_POST['sujet'], 'auteur'=>$_POST['email'], 'categorie'=>$_POST['categorie'], 'email'=>$_POST['email'], 'datepost'=>time(), 'contenu'=>$_POST['message']));
																echo '<div class="alert alert-success alrt">'.$lang['sendSuccess'].'</div><script>setTimeout(function () {$("#new").slideUp("slow");document.location.href="./index.php";}, 3000);</script>';
															}
													}
												else
													{
														echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['wrongMail'].'</div>';
													}
											}
									}
								else
									{
										echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['permSendTicket'].'</div>';
									}
							}
						else
							{
								echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['emptyField'].'</div>';
							}
					}
				elseif($siteconfig['registration'] == "force" || !empty($_SESSION['pseudo']))
					{
						if(!empty($_POST['sujet']) && !empty($_POST['categorie']) && !empty($_POST['message']))
							{
								if(isset($_SESSION['id']) && isset($_SESSION['pseudo']))
									{
										$verifCompte = $bdd->prepare('SELECT * FROM users WHERE id = :id AND pseudo = :pseudo');
										$verifCompte->execute(array('id'=>$_SESSION['id'], 'pseudo'=>$_SESSION['pseudo']));
										$compte = $verifCompte->fetch();

										if(!empty($compte))
											{
												if($perm['sendticket'] == '1')
													{
														$ins = $bdd->prepare('INSERT INTO ticket (sujet, auteur, categorie, email, datepost, contenu) VALUES (:sujet, :auteur, :categorie, :email, :datepost, :contenu)');
														$ins->execute(array('sujet'=>$_POST['sujet'], 'auteur'=>$_SESSION['id'], 'categorie'=>$_POST['categorie'], 'email'=>$compte['email'], 'datepost'=>time(), 'contenu'=>$_POST['message']));
														echo '<div class="alert alert-success alrt">'.$lang['sendSuccess2'].'<script>setTimeout(function () {document.location.href="./view.php";}, 4000);</script></div>';
													}
												else
													{
														echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['permSendTicket'].'</div>';
													}
											}
										else
											{
												echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['noAccount'].'</div>';
											}
									}
								else
									{
										echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['noConnected'].'</div>';
									}
							}
						else
							{
								echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['emptyField'].'</div>';
							}
					}
			break;

			case "inscription":
				if(!empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['verifpass']))
					{
						if($siteconfig['recaptcha'] == "e")
							{
								include_once '../../recaptchalib.php';

								if(!empty($_POST['recaptcha_response_field']))
									{
										$privatekey = $siteconfig['recaptcha_privatekey'];
    									$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

										if (!$resp->is_valid)
											echo '<div class="alert alert-danger alrt">'.$lang['wrongCaptcha'].'</div>';
										else
											{
												$ok = 'ok';
											}
									}
								else
									{
										echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['emptyField'].'</div>';
									}
							}
						else
							{
								$ok = 'ok';
							}

						if(!empty($ok) && $ok == 'ok')
							{
								$insc = inscription($_POST['email'], $_POST['pseudo'], $_POST['password'], $_POST['verifpass']);
								if($insc == 'ok')
									{
										echo '<div class="alert alert-success alrt">'.$lang['singinSuccess'].'</div><script>setTimeout(function() { window.location.reload(); }, 4000);$("#groupinsc").slideUp("slow");$("#groupconnex").slideUp("slow");</script>';
									}
								elseif($insc == 'invalidMail')
									{
										echo '<div class="alert alert-danger alrt">'.$lang['wrongMail'].'</div>';
									}
								elseif($insc == 'invalidPassword')
									{
										echo '<div class="alert alert-danger alrt">'.$lang['noPassIdentique'].'</div>';
									}
								elseif($insc == 'compteFound')
									{
										echo '<div class="alert alert-danger alrt">'.$lang['alreadyExists'].'</div>';
									}
								else
									{
										echo '<div class="alert alert-danger alrt">'.$lang['error'].'</div>';
									}
							}
					}
				else
					{
						echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['emptyField'].'</div>';
					}
			break;

			case "connexion":
				if(!empty($_POST['pseudo']) && !empty($_POST['password']))
					{
						$con = connexion($_POST['pseudo'], $_POST['password']);
						if($con == 'ok')
							echo '<div class="alert alert-success alrt">'.$lang['youreConnected'].'</div><script>setTimeout(function() { window.location.reload(); }, 4000);$("#groupinsc").slideUp("slow");$("#groupconnex").slideUp("slow");</script>';
						elseif($con == 'notFound')
							echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['accountNotFound'].'</div>';
						elseif($con == 'password')
							echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['wrongPassword'].'</div>';
					}
				else
					{
						echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['emptyField'].'</div>';
					}
			break;

			case "deconnexion":
				if(isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['token']))
					{
						if($_SESSION['token'] == $_GET['token'])
							{
								session_destroy();

								if(isset($_COOKIE['auth']))
									setcookie('auth', '', time()-3600, null, null, false, false);

								echo '<div class="alert alert-success alrt">'.$lang['disconnectSuccess'].'</div><script>setTimeout(function() { window.location.reload(); }, 4000);</script>';
							}
						else
							{
								echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['invalidToken'].'</div>';
							}
					}
				else
					{
						echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['noConnected'].'</div>';
					}
			break;

			default:
				echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> '.$lang['emptyAction'].'</div>';
			break;
		}