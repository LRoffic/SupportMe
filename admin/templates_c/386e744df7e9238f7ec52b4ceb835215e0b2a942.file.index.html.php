<?php /* Smarty version Smarty-3.1.17, created on 2014-04-28 23:38:55
         compiled from "./templates/index.html" */ ?>
<?php /*%%SmartyHeaderCode:763911876535078aad659b6-89096908%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '386e744df7e9238f7ec52b4ceb835215e0b2a942' => 
    array (
      0 => './templates/index.html',
      1 => 1398721122,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '763911876535078aad659b6-89096908',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_535078aada1c58_68988158',
  'variables' => 
  array (
    'alert' => 0,
    'perm' => 0,
    'config' => 0,
    'listuser' => 0,
    'u' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535078aada1c58_68988158')) {function content_535078aada1c58_68988158($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (!empty($_smarty_tpl->tpl_vars['alert']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['alert']->value=="assignok") {?>
				<div class="alert alert-success">Le ticket à été assigné !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="notfound") {?>
				<div class="alert alert-danger">Le ticket n'existe pas</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="notperm") {?>
				<div class="alert alert-danger">Vous n'avez pas la permission requise !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="erreur") {?>
				<div class="alert alert-danger">Erreur</div>
			<?php }?>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewticket']=='1') {?>
		<div class="panel panel-default">
			<div class="panel-heading">Liste des tickets</div>
			<div id="ticket"></div>
			<?php if ($_smarty_tpl->tpl_vars['perm']->value['lastresolved']=='1') {?>
			<hr />
			<div class="panel-body" style="text-align: center;">
				<div class="btn-group">
					<a href="./resolved.php" class="btn btn-success">Voir les tickets résolus</a>
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['ViewNotAssigned']=='1') {?>
						<a href="#" class="btn btn-info">Voir les tickets qui ne me sont pas assigné</a>
					<?php }?>
				</div>
			</div>
			<?php }?>
		</div>
		<?php }?>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Configuration</div>
				<div class="panel-body">
					<form method="post">
						<div class="form-group">
							<label>Nom du support :</label>
							<input type="text" name="nom" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['sitename'];?>
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
						<input type="submit" class="btn btn-primary btn-block" value="Modifier" />
					</form>
				</div>
			</div>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewuser']=='1') {?>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">Derniers utilisateurs</div>
				<table class="table table-striped">
					<thead>
						<tr>
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
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['pseudo'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['email'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['rang'];?>
</td>
							<td>
								<div class="btn-group">
									<a href="#" class="btn btn-info">Modifier</a>
									<a href="#" class="btn btn-danger">Supprimer</a>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<div class="panel-body">
					<a href="#" class="btn btn-block btn-info">Voir les autres</a>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
<script>
	function ticket()
		{
			$( "#ticket" ).load("requete.php?action=listticket");
		}
	setInterval(ticket, 1000);
</script>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
