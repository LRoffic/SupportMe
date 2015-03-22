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
	
	if($perm['lastresolved'] == "1")
		{
			$getTickets=$bdd->query("SELECT * FROM ticket WHERE etat = '2' ORDER BY datepost DESC");

			$t=0;

			while($tickets=$getTickets->fetch())
				{
					if($perm['viewNotAssignToMe'] == "0" && $tickets['assignto'] == $_SESSION['pseudo'] || $perm['viewNotAssignToMe'] == "1")
						{
							$lists[$t] = array(
								'id'=>$tickets['id'],
								'sujet'=>$tickets['sujet'],
								'auteur'=>getAuteurName($tickets['auteur']),
								'date'=>date('d/m/Y', $tickets['datepost']),
								'categorie'=>getCategorieName($tickets['categorie']),
								'assigned'=>$tickets['assigned'],
								'assignto'=>htmlspecialchars($tickets['assignto']),
								'isfaq'=>$tickets['isfaq']
							);
							$t++;
						}
				}
			$tpl->assign("list", $lists);
		}
	else
		{
			header("Location: ./index.php?option=notperm");
			exit();
		}
	
	$tpl->assign('page', 'resolved');
	$tpl->display("ticketlist.html");
?>