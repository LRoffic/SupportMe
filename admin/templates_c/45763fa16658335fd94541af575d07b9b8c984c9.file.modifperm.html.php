<?php /* Smarty version Smarty-3.1.17, created on 2015-03-21 23:34:53
         compiled from ".\templates\modifperm.html" */ ?>
<?php /*%%SmartyHeaderCode:17333539799cacdf132-17454111%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45763fa16658335fd94541af575d07b9b8c984c9' => 
    array (
      0 => '.\\templates\\modifperm.html',
      1 => 1403989873,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17333539799cacdf132-17454111',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_539799cb32e352_06342067',
  'variables' => 
  array (
    'retour' => 0,
    'pinf' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539799cb32e352_06342067')) {function content_539799cb32e352_06342067($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['retour']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['retour']->value=="token") {?>
				<div class="alert alert-danger">Token invalide ou innexistant !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retour']->value=="ok") {?>
				<div class="alert alert-success">Vous avez modifié un rang !</div>
			<?php }?>
		<?php }?>
		<div class="panel panel-default">
			<div class="panel-heading">Modifier le rang <b><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pinf']->value['nom'], ENT_QUOTES, 'UTF-8', true);?>
</b></div>
			<div class="panel-body">
				<form method="post" action="./permissions.php?pid=<?php echo $_smarty_tpl->tpl_vars['pinf']->value['id'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
					<div class="form-group">
						<label>Nom du rang :</label>
						<input type="text" name="nom" required="true" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['pinf']->value['nom'], ENT_QUOTES, 'UTF-8', true);?>
" class="form-control" /> 
					</div>
					<div class="form-group">
						<label>Peut envoyer des tickets ? <a href="#info" class="label label-info">info</a> :</label>
						<select name="sendticket" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['sendticket']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['sendticket']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir la FAQ (Foire aux questions) ? <a href="#info" class="label label-info">info</a> :</label>
						<select name="viewfaq" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['viewfaq']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['viewfaq']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir le lien vers l'administration ? <a href="#info" class="label label-info">info</a> :</label>
						<select name="viewLinkAdmin" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['viewLinkAdmin']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['viewLinkAdmin']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les tickets ? <a href="#info" class="label label-warning">info</a> :</label>
						<select name="viewticket" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['viewticket']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['viewticket']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut marquer comme résolue les tickets ? <a href="#info" class="label label-warning">info</a> :</label>
						<select name="resolve" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['resolve']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['resolve']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les dernier tickets résolue ? <a href="#info" class="label label-warning">info</a> :</label>
						<select name="lastresolved" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['lastresolved']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['lastresolved']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut commenter les tickets ? <a href="#info" class="label label-warning">info</a> :</label>
						<select name="comment" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['comment']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['comment']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les tickets qui ne lui sont pas assigné ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="viewNotAssignToMe" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['viewNotAssignToMe']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['viewNotAssignToMe']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les tickets qui ne sont pas assigné ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="ViewNotAssigned" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['ViewNotAssigned']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['ViewNotAssigned']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut réouvrir les tickets ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="reopen" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['reopen']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['reopen']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut accèder à l'administration ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="accessAdmin" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['accessAdmin']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['accessAdmin']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="viewuser" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['viewuser']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['viewuser']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut supprimé les tickets ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="deleteticket" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['deleteticket']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['deleteticket']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifié le thème ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modiftheme" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['modiftheme']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['modiftheme']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut assigné des tickets ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="canAssign" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['canAssign']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['canAssign']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut desassigné des tickets ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="canUnAssign" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['canUnAssign']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['canUnAssign']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier la configuration générale ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="config" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['config']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['config']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut supprimer des utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="deleteUsers" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['deleteUsers']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['deleteUsers']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier les utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifUsers" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['modifUsers']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['modifUsers']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier le mot de passe des utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifUsersPassword" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['modifUsersPassword']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['modifUsersPassword']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier le rang des utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifUsersRang" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['modifUsersRang']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['modifUsersRang']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier la protection de compte des utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifUsersProtect" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['modifUsersProtect']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['modifUsersProtect']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
						<small>La protection de compte permet d'empêcher un compe de se faire supprimer</small>
					</div>
					<div class="form-group">
						<label>Peut modifier les rangs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifPerms" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['modifPerms']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['modifPerms']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut supprimer des rangs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="deletePerms" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['deletePerms']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['deletePerms']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut ajouter des rangs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="addNewPerm" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['addNewPerm']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['addNewPerm']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Peut grer les catégories ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="Categories" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['pinf']->value['Categories']=='1') {?>
								<option value="1">Oui</option>
								<option value="0">Non</option>
							<?php } elseif ($_smarty_tpl->tpl_vars['pinf']->value['Categories']=='0') {?>
								<option value="0">Non</option>
								<option value="1">Oui</option>
							<?php }?>
						</select>
					</div>
					<input type="submit" class="btn btn-primary btn-lg btn-block" value="Ajouter" />
				</form>
			</div>
		</div>
		<div class="well" id="info">
			<ul>
				<li>
					<span class="label label-info">info</span> : Cible seulement les actions possible en dehors de l'administration
				</li>
				<li>
					<span class="label label-warning">info</span> : Cible les actions possible en dehors de l'administration et dans l'administration
				</li>
				<li>
					<span class="label label-danger">info</span> : Cible seulement les actions possible dans l'administration
				</li>
			</ul>
		</div>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
