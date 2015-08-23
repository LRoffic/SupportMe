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
																		echo '<div class="alert alert-success alrt">Votre commentaire a été poster !</div>';
																	}
																else
																	echo '<div class="alert alert-danger alrt">Le ticket est fermé !</div>';
															}
														else
															echo '<div class="alert alert-danger alrt">Votre commentaire est vide !</div>';
													}
												else
													echo '<div class="alert alert-danger alrt">Erreur, vous n\'avez pas la permission de commenter !</div>';
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
																			<em><u>Par '.htmlspecialchars($co['autor']).' le '.date('d/m/Y', $co['datepost']).'</u></em><br />
																			<div class="well">'.$purifier->purify($co['contenu']).'</div>
																		</div>';
																	}
															}
													}
												else
													echo '<div class="alert alert-danger">Aucune réponse n\'est disponible pour le moment !</div>';
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
													echo '<label class="label label-danger">En cours...</label>';
												elseif($v['etat'] == '1')
													echo '<span class="label label-warning">En attente de votre réponse</span>';
												elseif($v['etat'] == '2')
													echo '<span class="label label-success">Résolue</span>';
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
											echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> Vous n\'êtes pas l\'auteur du ticket !</div>';
									}
								elseif($siteconfig['registration'] == 'force')
									{
										if(!empty($ver['auteur']) && $ver['auteur'] == $_SESSION['id'])
											$ok = 'ok';
										else
											echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> Vous n\'êtes pas l\'auteur du ticket !</div>';
									}

								if(isset($ok) && $ok == 'ok')
									{
										$upd = $bdd->prepare("UPDATE ticket SET etat = '0' WHERE id = :id");
										$upd->execute(array('id'=>$_GET['id']));


										echo '<div class="alert alert-success alrt">Ticket réouvert ! <script>$("#ticket'.$_GET['id'].'").slideUp("slow");</script></div>';
									}
							}
						else
							echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> id du ticket manquant !</div>';
					}
				else
					echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> vous ne pouvez pas résoudre les tickets !</div>';
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
											echo '<div class="alert alert-danger alrt"><b>Erreur :</b> Vous n\'êtes pas l\'auteur du ticket !</div>';
									}
								elseif($siteconfig['registration'] == 'force')
									{
										if(!empty($ver['auteur']) && $ver['auteur'] == $_SESSION['id'])
											$ok = 'ok';
										else
											echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> Vous n\'êtes pas l\'auteur du ticket !</div>';
									}

								if(isset($ok) && $ok == 'ok')
									{
										$upd = $bdd->prepare("UPDATE ticket SET etat = '2' WHERE id = :id");
										$upd->execute(array('id'=>$_GET['id']));


										echo '<div class="alert alert-success alrt">Ticket résolue ! <script>$("#ticket'.$_GET['id'].'").slideUp("slow");</script></div>';
									}
							}
						else
							echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> id du ticket manquant !</div>';
					}
				else
					echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> vous ne pouvez pas résoudre les tickets !</div>';
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
										echo '<div class="alert alert-success alrt">Authentification approuvé ! La page va se rafraîchir !</div><script>setTimeout(function() { window.location.reload(); }, 4000);$("#emailauth").slideUp("slow");</script>';
									}
								else
									{
										
										echo '<div class="alert alert-danger alrt">Le code est incorrect !</div>';
									}
							}
						else
							{
								echo '<div class="alert alert-danger alrt">Aucun email n\'est ouvert avec cette adresse email !</div>';
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
															echo '<div class="alert alert-danger alrt">Le code captcha est incorrect !</div>';
														else
															$ok = 'ok';
													}
												else
													echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> le champs captcha est vide !</div>';
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
																->text('Bonjour et bienvenu sur le support de '.$siteconfig['sitename'].'.\n voici votre code d\'accès pour pouvoir voir la liste de vos ticket :\n '.$random.'\n Gardez le précieusement il ne vous en seras communiquez aucun autre !\n Cordialement l\'équipe de '.$siteconfig['sitename'])
																->html('Bonjour et bienvenu sur le support de '.$siteconfig['sitename'].'.<br /> voici votre code d\'accès pour pouvoir voir la liste de vos ticket :<br /> <b style="align: center;">'.$random.'</b><br /> Gardez le précieusement il ne vous en seras communiquez aucun autre !<br /> Cordialement l\'équipe de '.$siteconfig['sitename'])
																->send();

																$mailcorrect = "ok";
															}

														if(!empty($mailcorrect) && $mailcorrect == 'ok')
															{
																$ins = $bdd->prepare('INSERT INTO ticket (sujet, auteur, categorie, email, datepost, contenu) VALUES (:sujet, :auteur, :categorie, :email, :datepost, :contenu)');
																$ins->execute(array('sujet'=>$_POST['sujet'], 'auteur'=>$_POST['email'], 'categorie'=>$_POST['categorie'], 'email'=>$_POST['email'], 'datepost'=>time(), 'contenu'=>$_POST['message']));
																echo '<div class="alert alert-success alrt">Votre ticket à été envoyé ! Un administrateur y répondras au plus vite ! Pour consultez votre ticket, utilisez votre code d\'accès, si vous n\'en avez pas, regardez dans votre boîte mail (n\'hésitez pas à regarder si le code est dans les spams).</div><script>setTimeout(function () {$("#new").slideUp("slow");document.location.href="./index.php";}, 3000);</script>';
															}
													}
												else
													{
														echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> l\'email saisie est incorrect !</div>';
													}
											}
									}
								else
									{
										echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> Vous n\'avez pas la permissions d\'envoyer un ticket !</div>';
									}
							}
						else
							{
								echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> un des champs n\'est pas remplis !</div>';
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
														echo '<div class="alert alert-success alrt">Votre ticket à été envoyé ! Un administrateur y répondras au plus vite ! Vous allez être redirigé vers la liste de vos tickets ! <script>setTimeout(function () {document.location.href="./view.php";}, 4000);</script></div>';
													}
												else
													{
														echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> Vous n\'avez pas la permissions d\'envoyer un ticket !</div>';
													}
											}
										else
											{
												echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> Votre compte n\'existe pas !</div>';
											}
									}
								else
									{
										echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> Vous n\'êtes pas connectez !</div>';
									}
							}
						else
							{
								echo '<div class="alert alert-danger alrt"><b>'.$lang['error'].' :</b> un des champs n\'est pas remplis !</div>';
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
											echo '<div class="alert alert-danger alrt">Le code captcha est incorrect !</div>';
										else
											{
												$ok = 'ok';
											}
									}
								else
									{
										echo '<div class="alert alert-danger alrt"><b>Erreur :</b> le champs captcha est vide !</div>';
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
										echo '<div class="alert alert-success alrt">Vous êtes inscrit et connécté sur '.htmlspecialchars($siteconfig['sitename']).' ! La page va se rafraîchir !</div><script>setTimeout(function() { window.location.reload(); }, 4000);$("#groupinsc").slideUp("slow");$("#groupconnex").slideUp("slow");</script>';
									}
								elseif($insc == 'invalidMail')
									{
										echo '<div class="alert alert-danger alrt">Votre adresse mail est incorrect !</div>';
									}
								elseif($insc == 'invalidPassword')
									{
										echo '<div class="alert alert-danger alrt">Vos deux mot de passe ne sont pas identique !</div>';
									}
								elseif($insc == 'compteFound')
									{
										echo '<div class="alert alert-danger alrt">Un compte existe déjà sous se pseudo ou cet adresse mail !</div>';
									}
								else
									{
										echo '<div class="alert alert-danger alrt">Erreur !</div>';
									}
							}
					}
				else
					{
						echo '<div class="alert alert-danger alrt"><b>Erreur :</b> un des champs est vide !</div>';
					}
			break;

			case "connexion":
				if(!empty($_POST['pseudo']) && !empty($_POST['password']))
					{
						$con = connexion($_POST['pseudo'], $_POST['password']);
						if($con == 'ok')
							echo '<div class="alert alert-success alrt">'.$lang['youreConnected'].'</div><script>setTimeout(function() { window.location.reload(); }, 4000);$("#groupinsc").slideUp("slow");$("#groupconnex").slideUp("slow");</script>';
						elseif($con == 'notFound')
							echo '<div class="alert alert-danger alrt"><b>Erreur :</b> aucun compte n\'a été trouvé !</div>';
						elseif($con == 'password')
							echo '<div class="alert alert-danger alrt"><b>Erreur :</b> mot de passe incorrect !</div>';
					}
				else
					{
						echo '<div class="alert alert-danger alrt"><b>Erreur :</b> un des champs n\'est pas remplis !</div>';
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

								echo '<div class="alert alert-success alrt">Vous êtes déconnectez ! La page va se rafraîchir !</div><script>setTimeout(function() { window.location.reload(); }, 4000);</script>';
							}
						else
							{
								echo '<div class="alert alert-danger alrt"><b>Erreur :</b> Token invalide ou innexistant !</div>';
							}
					}
				else
					{
						echo '<div class="alert alert-danger alrt"><b>Erreur :</b> Vous n\'êtes pas connectez !</div>';
					}
			break;

			default:
				echo '<div class="alert alert-danger alrt"><b>Erreur :</b> Aucune action choisis !</div>';
			break;
		}