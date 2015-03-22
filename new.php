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

	$tpl->assign('page', 'Envoyer un ticket');

	if($siteconfig['registration'] == 'force')
		{
			if(empty($_SESSION['id']) || empty($_SESSION['pseudo']) || empty($_SESSION['token'])) 
				{
					header('Location: index.php');
					exit();
				}
		}
	else
		{
			if(!empty($_SESSION['id']) && !empty($_SESSION['pseudo']) && !empty($_SESSION['token']))
				$tpl->assign("pseudo", "true");
		}

	if($perm['sendticket'] == '0')
		{
			header('Location: ./index.php');
			exit();
		}

	if(!empty($_GET['c']) && is_numeric($_GET['c']))
		{
			$getcateg = $bdd->prepare('SELECT * FROM categories WHERE id = ?');
			$getcateg->execute(array($_GET['c']));
			$verifcateg = $getcateg->fetch();

			if(!empty($verifcateg['nom']) && $verifcateg['actif'] == '1')
				$tpl->assign('categorie', array('id'=>$verifcateg['id'], 'nom'=>$verifcateg['nom']));
		}
	if(!empty($_GET['e']) && preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!", $_GET['e']) && $siteconfig['registration'] == 'none')
		$tpl->assign('getemail', htmlspecialchars($_GET['e']));

	$categories = $bdd->query("SELECT * FROM categories WHERE actif = '1' ORDER BY nom");

	if($categories->rowCount() > 0)
		{
			$c=0;
			$categ=array();
			while($cat = $categories->fetch())
				{
					if(isset($verifcateg) && $verifcateg['id'] != $cat['id'])
						$categ[$c] = array('id'=>$cat['id'], 'nom'=>$cat['nom']);
					elseif(!isset($verifcateg))
						$categ[$c] = array('id'=>$cat['id'], 'nom'=>$cat['nom']);
					
					$c++;
				}
			$tpl->assign('cat', $categ);
		}
	else
		{
			$tpl->assign('cat', array('id'=>'0', 'nom'=>'Générale'));
		}

	$tpl->display($template.'new.html');