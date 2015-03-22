<?php /* Smarty version Smarty-3.1.17, created on 2015-03-21 23:34:45
         compiled from ".\templates\permissions.html" */ ?>
<?php /*%%SmartyHeaderCode:27846539493ae18d890-11085534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcea070d0f85ad5151e5e175ad0a67d6314bc63c' => 
    array (
      0 => '.\\templates\\permissions.html',
      1 => 1404799989,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27846539493ae18d890-11085534',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_539493ae3178e4_35343048',
  'variables' => 
  array (
    'retour' => 0,
    'permissions' => 0,
    'p' => 0,
    'perm' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539493ae3178e4_35343048')) {function content_539493ae3178e4_35343048($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['retour']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['retour']->value=="token") {?>
				<div class="alert alert-danger">Token invalide ou innexistant !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retour']->value=="notperm") {?>
				<div class="alert alert-danger">Vous n'avez pas la permission de supprimer les permissions !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retour']->value=="cantDelete") {?>
				<div class="alert alert-danger">Vous ne pouvez pas supprimer cette permission !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retour']->value=="ok") {?>
				<div class="alert alert-success">La permission à été supprimé !</div>
			<?php }?>
		<?php }?>
		<div class="panel panel-default">
			<div class="panel-heading">Gérer les rangs</div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nom</th>
						<th>Peux accéder à l'administration ?</th>
						<th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['permissions']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
						<tr>
							<td><?php echo $_smarty_tpl->tpl_vars['p']->value['id'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['p']->value['nom'];?>
</td>
							<td>
								<?php if ($_smarty_tpl->tpl_vars['p']->value['accessAdmin']=="0") {?>
									<label class="label label-danger">Non</label>
								<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['accessAdmin']=="1") {?>
									<label class="label label-success">Oui</label>
								<?php }?>
							</td>
							<td>
								<div class="btn-group">
									<a href="./permissions.php?pid=<?php echo $_smarty_tpl->tpl_vars['p']->value['id'];?>
" class="btn btn-info">Modifier</a>
									<?php if ($_smarty_tpl->tpl_vars['perm']->value['deletePerms']=="1") {?>
										<?php if ($_smarty_tpl->tpl_vars['p']->value['id']!='1'&&$_smarty_tpl->tpl_vars['p']->value['id']!='2') {?>
											<a href="./permissions.php?option=delete&pid=<?php echo $_smarty_tpl->tpl_vars['p']->value['id'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" class="btn btn-danger">Supprimer</a>
										<?php }?>
									<?php }?>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if ($_smarty_tpl->tpl_vars['perm']->value['addNewPerm']=="1") {?>
			<div class="panel-body">
				<a href="./permissions.php?action=new" class="btn btn-primary btn-lg btn-block">Nouvel permission</a>
			</div>
			<?php }?>
		</div>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
