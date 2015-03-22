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
	
	if($perm['viewNotAssignToMe'] == "1")
		{
			$getTickets=$bdd->prepare("SELECT * FROM ticket WHERE assignto != ? AND etat != '2'");
			$getTickets->execute(array($_SESSION['pseudo']));

			$t=0;

			while($tickets=$getTickets->fetch())
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
			$tpl->assign("list", $lists);
		}
	else
		{
			header("Location: ./index.php?option=notperm");
			exit();
		}
	
	$tpl->assign('page', 'notassignedtome');
	$tpl->display("ticketlist.html");
?>