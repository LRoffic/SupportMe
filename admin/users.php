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

	if($perm['viewuser'] != "1")
		{
			header("Location: ./index.php?option=notperm");
			exit();
		}

	if(isset($_GET['uid']) && !isset($_GET['action']))
		{
			if($perm['modifUsers'] != "1")
				{
					header("Location: ./index.php?option=notperm");
					exit();
				}

			if(!empty($_POST['pseudo']) && !empty($_POST['email']))
				{
					if(isset($_GET['token']) && verifToken($_GET['token']))
						{
							$upd=$bdd->prepare("UPDATE users SET pseudo = :pseudo, email = :email WHERE id = :id");
							$upd->execute(array('pseudo'=>$_POST['pseudo'], 'email'=>$_POST['email'], 'id' => $_GET['uid']));

							if(!empty($_POST['password']) && $perm['modifUsersPassword'] == '1')
								{
									$updpass=$bdd->prepare("UPDATE users SET password = :pass WHERE id = :id");
									$upd->execute(array('password'=>password_hash($_POST['password'], PASSWORD_BCRYPT), 'id' => $_GET['uid']));
								}

							if(!empty($_POST['rang']) && $perm["modifUsersRang"] == "1")
								{
									$verifRangExist=$bdd->prepare("SELECT * FROM permissions WHERE id = ?");
									$verifRangExist->execute(array($_POST['rang']));

									if($verifRangExist->rowCount() == "1")
										{
											$updpass=$bdd->prepare("UPDATE users SET permission = :perm WHERE id = :id");
											$updpass->execute(array('perm'=>$_POST['rang'], 'id' => $_GET['uid']));
										}
								}

							if(!empty($_POST['protected']) && $perm['modifUsersProtect'] == "1")
								{
									if($_POST['protected'] == "1" || $_POST['protected'] == "0")
										{
											$updprotect=$bdd->prepare("UPDATE users SET protected = :pro WHERE id = :id");
											$updprotect->execute(array('pro'=>$_POST['protected'], 'id'=>$_GET['uid']));
										}
								}

							$tpl->assign("retour", "ok");
						}
					else
						$tpl->assign("retour", "token");
				}

			$inf=$bdd->prepare('SELECT * FROM users WHERE id = ?');
			$inf->execute(array($_GET['uid']));
			$info=$inf->fetch();

			$r=0;
			$listRang=$bdd->query("SELECT * FROM permissions");
			while($rangs=$listRang->fetch())
				{
					$lrang[$r]=array(
						'id'=>$rangs['id'],
						'nom'=>$rangs['nom']
					);
					$r++;
				}

			$tpl->assign('lrang', $lrang);
			$tpl->assign('info', $info);
			$tpl->assign('infoPseudo', htmlspecialchars($info['pseudo']));
			$tpl->assign('infoPermUser', getPerm($info['permission']));
			$tpl->display('users.html');
		}
	else
		{
			if(isset($_GET['action']) && $_GET['action'] == "delete")
				{
					if(isset($_GET['token']) && verifToken($_GET['token']))
						{
							if($perm['deleteUsers'] == "1")
								{
									$verifprotected=$bdd->prepare("SELECT * FROM users WHERE id = ?");
									$verifprotected->execute(array($_GET['uid']));
									$v=$verifprotected->fetch();
									if(isset($v['id']))
										{
											if($v['protected'] != "1")
												{
													$del=$bdd->prepare("DELETE FROM users WHERE id = ?");
													$del->execute(array($_GET['uid']));

													$tpl->assign("usernamedel", htmlspecialchars($v['pseudo']));
													$tpl->assign("alert", "delok");
												}
											else
												$tpl->assign("alert", "accountProtected");
										}
									else
										$tpl->assign("alert", "userNotFound");
								}
							else
								$tpl->assign("alert", "notperm");
						}
					else
						$tpl->assign("alert", "token");
				}

			$getusers=$bdd->query("SELECT users.*, permissions.nom FROM users LEFT JOIN permissions ON users.permission = permissions.id ORDER BY users.id DESC");
			$u=0;
			while($ulist=$getusers->fetch())
				{
					$ul[$u]=array(
						'id'=>$ulist['id'],
						'pseudo'=>htmlspecialchars($ulist['pseudo']),
						'email'=>htmlspecialchars($ulist['email']),
						'dateinsc'=>date("d/m/Y", $ulist['dateinsc']),
						'lastview'=>date("d/m/Y", $ulist['lastview']),
						'rang'=>$ulist['nom'],
						'ip'=>htmlspecialchars($ulist['ip'])
					);
					$u++;
				}
			$tpl->assign('ulist', $ul);

			$tpl->display("listuser.html");
		}