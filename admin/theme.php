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

	if($perm['modiftheme'] != '1')
		{
			header("Location: index.php?option=notperm");
			exit();
		}

	if(!empty($_GET['use']))
		{
			if(!empty($_GET['token']) && $_GET['token'] == $_SESSION['token'])
				{
					if(file_exists('../templates/'.$_GET['use'].'/'))
						{
							if(file_exists('../templates/'.$_GET['use'].'/version.json'))
								{
									$new=$bdd->prepare("UPDATE config SET template = :temp WHERE id = '1'");
									$new->execute(array('temp'=>$_GET['use'].'/'));
									$tpl->assign('erreur', 'okupd');
								}
							else
								$tpl->assign('erreur','versionnotfound');
						}
					else
						$tpl->assign('erreur','foldernotfound');
				}
			else
				$tpl->assign('erreur', 'token');
		}
	
	if(!empty($_GET['del']))
		{
			if(!empty($_GET['token']) && $_GET['token'] == $_SESSION['token'])
				{
					if(file_exists('../templates/'.$_GET['del'].'/'))
						{
							delete_folder('../templates/'.$_GET['del'].'/');
							$tpl->assign('erreur','delok');
						}
					else
						$tpl->assign('erreur','foldernotfound');
				}
			else
				$tpl->assign('erreur', 'token');
		}

	$dirname = '../templates/';
	$dir = opendir($dirname); 
	
	$f=0;

	$gettheme=$bdd->query("SELECT template FROM config WHERE id = '1'");
	$t=$gettheme->fetch();
	$tpl->assign('t',$t);
	
	while($file = readdir($dir))
		{
			if($file != '.' && $file != '..')
				{
					if(file_exists($dirname.$file.'/version.json'))
						{
							$content=file_get_contents($dirname.$file.'/version.json');
							$contenu = json_decode($content);

							if(!empty($contenu->{'update_file'}))
								$upd = file_get_contents($contenu->{'update_file'});
							else
								$upd = $contenu->{'version'};

							if(!empty($contenu->{'update_download'}))
								$down = $contenu->{'update_download'};
							else
								$down="#";

							$listfiles[$f] = array(
								'nom'=>htmlspecialchars($contenu->{'nom'}),
								'auteur'=>htmlspecialchars($contenu->{'auteur'}),
								'siteautor'=>htmlspecialchars($contenu->{'auteur_site'}),
								'version'=>htmlspecialchars($contenu->{'version'}),
								'updver'=>htmlspecialchars($upd),
								'download'=>htmlspecialchars($down),
								'dir'=>$dirname.$file,
								'folder'=>$file,
								'verif'=>$file.'/'
							);
						}

					$f++;
				}
		}

	closedir($dir);
	
	$tpl->assign('listfiles',$listfiles);

	$tpl->display('theme.html');