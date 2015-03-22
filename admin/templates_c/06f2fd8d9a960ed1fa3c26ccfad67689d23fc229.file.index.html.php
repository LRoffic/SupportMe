<?php /* Smarty version Smarty-3.1.17, created on 2014-06-13 14:18:59
         compiled from ".\templates\index.html" */ ?>
<?php /*%%SmartyHeaderCode:249795383b2182ac930-82596220%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06f2fd8d9a960ed1fa3c26ccfad67689d23fc229' => 
    array (
      0 => '.\\templates\\index.html',
      1 => 1402661939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '249795383b2182ac930-82596220',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5383b2187bd4a4_46393062',
  'variables' => 
  array (
    'alert' => 0,
    'config' => 0,
    'perm' => 0,
    'token' => 0,
    'listuser' => 0,
    'u' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5383b2187bd4a4_46393062')) {function content_5383b2187bd4a4_46393062($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php if (!empty($_smarty_tpl->tpl_vars['alert']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['alert']->value=="assignok") {?>
				<div class="alert alert-success">Le ticket à été assigné !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="unassignok") {?>
				<div class="alert alert-success">Le ticket à été désassigné !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="configok") {?>
				<div class="alert alert-success">Votre configuration a été modifié !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="notfound") {?>
				<div class="alert alert-danger">Le ticket n'existe pas</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="notperm") {?>
				<div class="alert alert-danger">Vous n'avez pas la permission requise !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="token") {?>
				<div class="alert alert-danger">Token invalide ou innexistant !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="erreur") {?>
				<div class="alert alert-danger">Erreur</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="emptyValues") {?>
				<div class="alert alert-danger">Un des champs de la configuration n'a pas été remplis, vérifié puis réésayé.</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="registrationBroken") {?>
				<div class="alert alert-danger">Le champs "Inscription" a été modifié pour un format non-autorisé, vérifié puis réésayé.</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="faqBroken") {?>
				<div class="alert alert-danger">Le champs "FAQ" a été modifié pour un format non-autorisé, vérifié puis réésayé.</div>
			<?php }?>
		<?php }?>
		<div class="jumbotron" style="text-align: center;">
			<h2>Bienvenue dans l'administration de <?php echo $_smarty_tpl->tpl_vars['config']->value['sitename'];?>
</h2>
			<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		</div>
		<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewticket']=='1') {?>
		<div class="panel panel-default">
			<div class="panel-heading">Liste des tickets</div>
			<div id="ticket"></div>
			<?php if ($_smarty_tpl->tpl_vars['perm']->value['lastresolved']=='1') {?>
			<hr />
			<div class="panel-body" style="text-align: center;">
				<div class="btn-group">
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['lastresolved']=='1') {?>
						<a href="./resolved.php" class="btn btn-success">Voir les tickets résolus</a>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewNotAssignToMe']=='1') {?>
						<a href="./assign.php" class="btn btn-info">Voir les tickets qui ne me sont pas assigné</a>
					<?php }?>
				</div>
			</div>
			<?php }?>
		</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['perm']->value['config']=="1") {?>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Configuration</div>
				<div class="panel-body">
					<form method="post" action="./index.php?option=config&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
						<div class="form-group">
							<label>Nom du support :</label>
							<input type="text" name="sitename" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['sitename'];?>
" required="true" class="form-control" />
						</div>
						<div class="form-group">
							<label>Inscription :</label>
							<select name="registration" class="form-control">
								<?php if ($_smarty_tpl->tpl_vars['config']->value['registration']=='none') {?>
								<option value="none">Pas obligatoire</option>
								<option value="force">Obligatoire</option>
								<?php } else { ?>
								<option value="force">Obligatoire</option>
								<option value="none">Pas obligatoire</option>
								<?php }?>
							</select>
						</div>
						<div class="form-group">
							<label>Système de FAQ :</label>
							<select name="faq" class="form-control">
								<?php if ($_smarty_tpl->tpl_vars['config']->value['faq']=='e') {?>
								<option value="e">Activé</option>
								<option value="d">Désactivé</option>
								<?php } else { ?>
								<option value="d">Désactivé</option>
								<option value="e">Activé</option>
								<?php }?>
							</select>
						</div>
						<input type="submit" class="btn btn-primary btn-lg btn-block" value="Modifier" />
					</form>
				</div>
			</div>
		</div>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewuser']=='1') {?>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Les 3 derniers utilisateurs</div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nom</th>
							<th>Email</th>
							<th>Rang</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listuser']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
						<tr>
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['pseudo'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['email'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['rang'];?>
</td>
							<td>
								<div class="btn-group">
									<?php if ($_smarty_tpl->tpl_vars['perm']->value['modifUsers']=='1') {?>
										<a href="./users.php?uid=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
" class="btn btn-info">Modifier</a>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['perm']->value['deleteUsers']=='1') {?>
										<a href="./users.php?action=delete&uid=<?php echo $_smarty_tpl->tpl_vars['u']->value['id'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" class="btn btn-danger">Supprimer</a>
									<?php }?>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="panel-body">
					<a href="./users.php" class="btn btn-block btn-lg btn-info">Voir les autres</a>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
<script>
	setInterval( function(){ $( "#ticket" ).load("requete.php?action=listticket"); }, 1000);
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
