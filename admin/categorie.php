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

	if($perm['Categories'] != "1")
		{
			header("Location: ./index.php?option=notperm");
			exit();
		}

	if(isset($_GET['action']))
		{
			if($_GET['action'] == "new")
				{
					if(!empty($_POST['name']))
						{
							if(isset($_GET['token']) && verifToken($_GET['token']))
								{
									$ins=$bdd->prepare("INSERT INTO categories (nom) VALUES (:nom)");
									$ins->execute(array('nom'=>$_POST['name']));

									$tpl->assign('retour', 'okadd');
								}
							else
								$tpl->assign('retour', 'token');
						}
					else
						$tpl->assign('retour', 'emptyname');
				}
			elseif($_GET['action'] == "delete")
				{
					if(isset($_GET['id']))
						{
							if(isset($_GET['token']) && verifToken($_GET['token']))
								{
									if($_GET['id'] != '1')
										{
											$del=$bdd->prepare('DELETE FROM categories WHERE id = ?');
											$del->execute(array($_GET['id']));

											$tpl->assign('retour', 'okdel');
										}
									elseif($_GET['id'] == '1')
										$tpl->asign('retour', 'categ1');
								}
							else
								$tpl->assign("retour", 'token');
						}
					else
						$tpl->assign('retour', 'emptyid');
				}
		}

	$getcateg=$bdd->query("SELECT * FROM categories ORDER BY id");
	if($getcateg->rowCount() >= 1)
		{
			$i=0;
			while($ca=$getcateg->fetch())
				{
					$cat[$i]=array(
						'id'=>$ca['id'],
						'nom'=>$ca['nom'],
						'actif'=>$ca['actif']
					);
					$i++;
				}
			$tpl->assign('categs', $cat);
		}
	else
		$tpl->assign('empty', 'nocateg');

	$tpl->display("categorie.html");