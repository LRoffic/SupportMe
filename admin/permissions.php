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

	if($perm['modifPerms'] != "1")
		{
			header("Location: ./index.php?option=notperm");
			exit();
		}

	if(isset($_GET['pid']) && !isset($_GET['option']))
		{
			$verifExist=$bdd->prepare("SELECT * FROM permissions WHERE id = ?");
			$verifExist->execute(array($_GET['pid']));

			if($verifExist->rowCount() == 1)
				{
					if(!empty($_POST['nom']))
						{
							if(isset($_GET['token']) && verifToken($_GET['token']))
								{
									$upd=$bdd->prepare("UPDATE permissions SET nom = :nom, sendticket = :sendticket, viewfaq = :viewfaq, viewLinkAdmin = :viewLinkAdmin, viewticket = :viewticket, resolve = :resolve, lastresolved = :lastresolved, comment = :comment, viewNotAssignToMe = :viewNotAssignToMe, ViewNotAssigned = :ViewNotAssigned, reopen = :reopen, accessAdmin = :accessAdmin, viewuser = :viewuser, deleteticket = :deleteticket, modiftheme = :modiftheme, canAssign = :canAssign, canUnAssign = :canUnAssign, config = :config, deleteUsers = :deleteUsers, modifUsers = :modifUsers, modifUsersPassword = :modifUsersPassword, modifUsersRang = :modifUsersRang, modifUsersProtect = :modifUsersProtect, modifPerms = :modifPerms, deletePerms = :deletePerms, addNewPerm = :addNewPerm, Categories = :Categories WHERE id = :id");
									$upd->execute(array('nom'=>$_POST['nom'], 'sendticket'=>$_POST['sendticket'], 'viewfaq'=>$_POST['viewfaq'], 'viewLinkAdmin'=>$_POST['viewLinkAdmin'], 'viewticket'=>$_POST['viewticket'], 'resolve'=>$_POST['resolve'], 'lastresolved'=>$_POST['lastresolved'], 'comment'=>$_POST['comment'], 'viewNotAssignToMe'=>$_POST['viewNotAssignToMe'], 'ViewNotAssigned'=>$_POST['ViewNotAssigned'], 'reopen'=>$_POST['reopen'], 'accessAdmin'=>$_POST['accessAdmin'], 'viewuser'=>$_POST['viewuser'], 'deleteticket'=>$_POST['deleteticket'], 'modiftheme'=>$_POST['modiftheme'], 'canAssign'=>$_POST['canAssign'], 'canUnAssign'=>$_POST['canUnAssign'], 'config'=>$_POST['config'], 'deleteUsers'=>$_POST['deleteUsers'], 'modifUsers'=>$_POST['modifUsers'], 'modifUsersPassword'=>$_POST['modifUsersPassword'], 'modifUsersRang'=>$_POST['modifUsersRang'], 'modifUsersProtect'=>$_POST['modifUsersProtect'], 'modifPerms'=>$_POST['modifPerms'], 'deletePerms'=>$_POST['deletePerms'], 'addNewPerm'=>$_POST['addNewPerm'],'Categories'=>$_POST['Categories'], 'id'=>$_GET['pid'] ));
									$tpl->assign("retour", "ok");
								}
							else
								$tpl->assign("retour", "token");
						}

					$perminfo=$bdd->prepare("SELECT * FROM permissions WHERE id = ?");
					$perminfo->execute(array($_GET['pid']));
					$pinf=$perminfo->fetch();

					$tpl->assign("pinf", $pinf);

					$tpl->display("modifperm.html");
				}
			else
				{
					header("Location: ./permissions.php");
					exit();
				}
		}
	elseif(isset($_GET['action']) && $_GET['action'] == "new")
		{
			if($perm['addNewPerm'] != "1")
				{
					header("Location: ./index.php?option=notperm");
					exit();
				}
			else
				{
					if(!empty($_POST['nom']))
						{
							if($perm['addNewPerm'] != "1")
								{
									header("Location: ./index.php?option=notperm");
									exit();
								}
							else
								{
									if(isset($_GET['token']) && verifToken($_GET['token']))
										{
											$ins=$bdd->prepare("INSERT INTO permissions (nom,sendticket,viewfaq,viewLinkAdmin,viewticket,resolve,lastresolved,comment,viewNotAssignToMe,ViewNotAssigned,reopen,accessAdmin,viewuser,deleteticket,modiftheme,canAssign,canUnAssign,config,deleteUsers,modifUsers,modifUsersPassword,modifUsersRang,modifUsersProtect,modifPerms,deletePerms,addNewPerm, Categories) VALUES (:nom,:sendticket,:viewfaq,:viewLinkAdmin,:viewticket,:resolve,:lastresolved,:comment,:viewNotAssignToMe,:ViewNotAssigned,:reopen,:accessAdmin,:viewuser,:deleteticket,:modiftheme,:canAssign,:canUnAssign,:config,:deleteUsers,:modifUsers,:modifUsersPassword,:modifUsersRang,:modifUsersProtect,:modifPerms,:deletePerms,:addNewPerm,:Categories)");
											$ins->execute(array( 'nom'=>$_POST['nom'],'sendticket'=>$_POST['sendticket'],'viewfaq'=>$_POST['viewfaq'],'viewLinkAdmin'=>$_POST['viewLinkAdmin'],'viewticket'=>$_POST['viewticket'],'resolve'=>$_POST['resolve'],'lastresolved'=>$_POST['lastresolved'],'comment'=>$_POST['comment'],'viewNotAssignToMe'=>$_POST['viewNotAssignToMe'],'ViewNotAssigned'=>$_POST['ViewNotAssigned'],'reopen'=>$_POST['reopen'],'accessAdmin'=>$_POST['accessAdmin'],'viewuser'=>$_POST['viewuser'],'deleteticket'=>$_POST['deleteticket'],'modiftheme'=>$_POST['modiftheme'],'canAssign'=>$_POST['canAssign'],'canUnAssign'=>$_POST['canUnAssign'],'config'=>$_POST['config'],'deleteUsers'=>$_POST['deleteUsers'],'modifUsers'=>$_POST['modifUsers'],'modifUsersPassword'=>$_POST['modifUsersPassword'],'modifUsersRang'=>$_POST['modifUsersRang'],'modifUsersProtect'=>$_POST['modifUsersProtect'],'modifPerms'=>$_POST['modifPerms'],'deletePerms'=>$_POST['deletePerms'],'addNewPerm'=>$_POST['addNewPerm'],'Categories'=>$_POST['Categories']));
											
											header("Location: ./permissions.php");
										}
									else
										$tpl->assign("retour", "token");
								}
						}

					$tpl->display("newPerm.html");
				}
		}
	else
		{
			if(isset($_GET['option']) && $_GET['option'] == "delete" && isset($_GET['pid']))
				{
					if($perm['deletePerms'] == "1")
						{
							if(isset($_GET['token']) && verifToken($_GET['token']))
								{
									if($_GET['pid'] != "1" && $_GET["pid"] != "2")
										{
											$del=$bdd->prepare("DELETE FROM permissions WHERE id = ?");
											$del->execute(array($_GET['pid']));

											$tpl->assign("retour", "ok");
										}
									else
										$tpl->assign("retour", "cantDelete");
								}
							else
								$tpl->assign("retour", "token");
						}
					else
						$tpl->assign("retour", "notperm");
				}

			$p=0;
			$getPerms=$bdd->query("SELECT * FROM permissions ORDER BY id");
			while($permissions=$getPerms->fetch())
				{
					$permission[$p]=array(
						'id'=>$permissions['id'],
						'nom'=>htmlspecialchars($permissions['nom']),
						'accessAdmin'=>$permissions['accessAdmin']
					);
					$p++;
				}
			$tpl->assign("permissions", $permission);

			$tpl->display("permissions.html");
		}