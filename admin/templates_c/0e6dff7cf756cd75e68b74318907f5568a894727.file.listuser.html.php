<?php /* Smarty version Smarty-3.1.17, created on 2014-06-04 04:57:51
         compiled from ".\templates\listuser.html" */ ?>
<?php /*%%SmartyHeaderCode:25801538a92962c1091-19416433%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e6dff7cf756cd75e68b74318907f5568a894727' => 
    array (
      0 => '.\\templates\\listuser.html',
      1 => 1401850647,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25801538a92962c1091-19416433',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_538a929642cc60_16116735',
  'variables' => 
  array (
    'alert' => 0,
    'usernamedel' => 0,
    'ulist' => 0,
    'u' => 0,
    'perm' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_538a929642cc60_16116735')) {function content_538a929642cc60_16116735($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['alert']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['alert']->value=="token") {?>
				<div class="alert alert-danger">Token invalide ou innexistant !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="notperm") {?>
				<div class="alert alert-danger">Vous n'avez pas la permission de supprimé un utilisateur !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="userNotFound") {?>
				<div class="alert alert-danger">L'utilisateur est introuvable !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="accountProtected") {?>
				<div class="alert alert-danger">Ce compte est protégé, vous ne pouvez pas le supprimer !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=="delok") {?>
				<div class="alert alert-success">Vous avez supprimer le compte de <b><?php echo $_smarty_tpl->tpl_vars['usernamedel']->value;?>
</b> !</div>
			<?php }?>
		<?php }?>
		<div class="panel panel-default">
			<div class="panel-heading">Listes des utilisateurs inscrit</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Pseudo</th>
						<th>Email</th>
						<th>Date d'inscription</th>
						<th>Dernière connexion</th>
						<th>Rang</th>
						<th>IP</th>
						<th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ulist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['dateinsc'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['lastview'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['rang'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['u']->value['ip'];?>
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
		</div>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
