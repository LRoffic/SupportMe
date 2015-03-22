<?php /* Smarty version Smarty-3.1.17, created on 2014-06-11 02:22:36
         compiled from ".\templates\newPerm.html" */ ?>
<?php /*%%SmartyHeaderCode:57125394bc770573b4-63801227%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98f8a52314a683d960d035cee18aaaa11ff8bb69' => 
    array (
      0 => '.\\templates\\newPerm.html',
      1 => 1402446146,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57125394bc770573b4-63801227',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5394bc7726f6d0_93636883',
  'variables' => 
  array (
    'retour' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5394bc7726f6d0_93636883')) {function content_5394bc7726f6d0_93636883($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['retour']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['retour']->value=="token") {?>
				<div class="alert alert-danger">Token invalide ou innexistant !</div>
			<?php }?>
		<?php }?>
		<div class="panel panel-info">
			<div class="panel-heading">Ajouter un rang</div>
			<div class="panel-body">
				<form method="post" action="./permissions.php?action=new&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
					<div class="form-group">
						<label>Nom du rang :</label>
						<input type="text" name="nom" required="true" placeholder="Nom du rang du genre Administrateur, Modérateur ou autres" class="form-control" /> 
					</div>
					<div class="form-group">
						<label>Peut envoyer des tickets ? <a href="#info" class="label label-info">info</a> :</label>
						<select name="sendticket" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir la FAQ (Foire aux questions) ? <a href="#info" class="label label-info">info</a> :</label>
						<select name="viewfaq" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir le lien vers l'administration ? <a href="#info" class="label label-info">info</a> :</label>
						<select name="viewLinkAdmin" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les tickets ? <a href="#info" class="label label-warning">info</a> :</label>
						<select name="viewticket" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut marquer comme résolue les tickets ? <a href="#info" class="label label-warning">info</a> :</label>
						<select name="resolve" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les dernier tickets résolue ? <a href="#info" class="label label-warning">info</a> :</label>
						<select name="lastresolved" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut commenter les tickets ? <a href="#info" class="label label-warning">info</a> :</label>
						<select name="comment" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les tickets qui ne lui sont pas assigné ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="viewNotAssignToMe" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les tickets qui ne sont pas assigné ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="ViewNotAssigned" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut réouvrir les tickets ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="reopen" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut accèder à l'administration ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="accessAdmin" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut voir les utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="viewuser" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut supprimé les tickets ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="deleteticket" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifié le thème ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modiftheme" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut assigné des tickets ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="canAssign" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut desassigné des tickets ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="canUnAssign" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier la configuration générale ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="config" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut supprimer des utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="deleteUsers" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier les utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifUsers" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier le mot de passe des utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifUsersPassword" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier le rang des utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifUsersRang" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut modifier la protection de compte des utilisateurs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifUsersProtect" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
						<small>La protection de compte permet d'empêcher un compe de se faire supprimer</small>
					</div>
					<div class="form-group">
						<label>Peut modifier les rangs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="modifPerms" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut supprimer des rangs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="deletePerms" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
						</select>
					</div>
					<div class="form-group">
						<label>Peut ajouter des rangs ? <a href="#info" class="label label-danger">info</a> :</label>
						<select name="addNewPerm" class="form-control">
							<option>-- Choisir une option --</option>
							<option value="1">Oui</option>
							<option value="0">Non</option>
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
