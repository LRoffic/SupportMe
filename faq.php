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

	if($perm['viewfaq'] == '0')
		{
			header("Location: ./index.php");
			exit();
		}

	if($siteconfig['faq'] == 'd')
		{
			header("Location: ./index.php");
			exit();
		}
	else
		{
			$nbfa = $bdd->query("SELECT * from ticket WHERE isfaq = '1'");

			if($nbfa->rowCount() >= 1)
				{
					$tpl->assign('page', 'FAQ\'s');

					$f=0;
					while($fa = $nbfa->fetch())
						{
							if(preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!", $fa['auteur']))
								$auteur = "utilisateur";
							else
								{
									$ps = $bdd->prepare("SELECT * FROM users WHERE id = ?");
									$ps->execute(array($fa['auteur']));
									$aut = $ps->fetch();
									$auteur = $purifier->purify($aut['pseudo']);
								}

							$listfa[$f] = array(
								'id'=>$fa['id'],
								'sujet'=>$purifier->purify($fa['sujet']),
								'auteur'=>$auteur,
								'contenu'=>$purifier->purify($fa['contenu']),
								'date'=>date($lang['phpDate'], $fa['datepost'])
							);
							$f++;
						}

					$c=0;
					$com = $bdd->query("SELECT * FROM response");
					while($co = $com->fetch())
						{
							if(preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!", $co['autor']))
								$autorcom = "utilisateur";
							else
								$autorcom = $purifier->purify($co['autor']);

							$listcom[$c] = array(
								'tid'=>$co['tid'],
								'auteur'=>$autorcom,
								'contenu'=>$purifier->purify($co['contenu']),
								'date'=>date($lang['phpDate'], $co['datepost']),
								'masked'=>$co['masked']
							);
							$c++;
						}

					$tpl->assign('listfa', $listfa);

					if(isset($listcom))
						$tpl->assign('listcom', $listcom);

					$tpl->display($template.'faq.html');
				}
			else
				{
					$tpl->assign('page', 'FAQ');
					$tpl->assign('erreur', 'notfaq');
					$tpl->display($template.'erreur.html');
				}
		}