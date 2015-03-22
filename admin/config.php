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
	include_once "menu.php";

	if($perm['config'] != '1')
		{
			header("Location: index.php?option=notperm");
			exit();
		}

	if(isset($_GET['option']))
		{
			if($_GET['option'] == 'modifok')
				{
					$tpl->assign('alert', 'modifok');
				}
		}

	if(!empty($_POST['sitename']) && !empty($_POST['sitemail']) && !empty($_POST['registration']) && !empty($_POST['cookie']) && !empty($_POST['faq']) && !empty($_POST['recaptcha']) && !empty($_POST['htaccess']))
		{
			$info=array(
				'sitename'=>htmlspecialchars($_POST['sitename']),
				'sitemail'=>$_POST['sitemail'],
				'reg'=>$_POST['registration'],
				'cookie'=>$_POST['cookie'],
				'faq'=>$_POST['faq'],
				'recaptcha'=>$_POST['recaptcha'],
				'recaptcha_key'=>(!empty($_POST['recaptcha_key']))?htmlspecialchars($_POST['recaptcha_key']):'',
				'recaptcha_privatekey'=>(!empty($_POST['recaptcha_privatekey']))?htmlspecialchars($_POST['recaptcha_privatekey']):'',
				'htaccess'=>$_POST['htaccess'],
			);
			if(isset($_GET['token']) && verifToken($_GET['token']))
				{
					if(preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!i", $info['sitemail']))
						{
							if($info['reg'] == "none" || $info['reg'] == "force")
								{
									if($info['cookie'] == "1" || $info['cookie'] == "0")
										{
											if($info['faq'] == "e" || $info['faq'] == "d")
												{
													if($info['recaptcha'] == "e" || $info['recaptcha'] == "d")
														{
															if($info['recaptcha'] == "e" || $info['recaptcha'] == "d")
																{
																	$upd=$bdd->prepare("UPDATE config SET sitename=:sitename, sitemail=:sitemail, registration=:reg, cookie=:coo, faq=:faq, recaptcha=:rec, recaptcha_key=:reckey, recaptcha_privatekey=:recprivkey, htaccess=:htaccess")->execute(array(
																		'sitename'=>$info['sitename'],
																		'sitemail'=>$info['sitemail'],
																		'reg'=>$info['reg'],
																		'coo'=>$info['cookie'],
																		'faq'=>$info['faq'],
																		'rec'=>$info['recaptcha'],
																		'reckey'=>$info['recaptcha_key'],
																		'recprivkey'=>$info['recaptcha_privatekey'],
																		'htaccess'=>$info['htaccess']
																	));

																	header("Location: ./config.php?option=modifok");
																}
															else
																$tpl->assign('alert', 'inputBroken');
														}
													else
														$tpl->assign('alert', 'inputBroken');
												}
											else
												$tpl->assign('alert', 'inputBroken');
										}
									else
										$tpl->assign('alert', 'inputBroken');
								}
							else
								$tpl->assign('alert', 'inputBroken');
						}
					else
						$tpl->assign('alert', 'mail');
				}
			else
				$tpl->assign('alert', 'token');
		}

	$tpl->display("config.html");