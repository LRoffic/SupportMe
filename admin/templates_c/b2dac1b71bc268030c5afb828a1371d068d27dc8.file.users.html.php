<?php /* Smarty version Smarty-3.1.17, created on 2014-06-30 05:44:33
         compiled from ".\templates\users.html" */ ?>
<?php /*%%SmartyHeaderCode:156025391981d10b691-48608037%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2dac1b71bc268030c5afb828a1371d068d27dc8' => 
    array (
      0 => '.\\templates\\users.html',
      1 => 1402968516,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156025391981d10b691-48608037',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5391981d327e06_21508942',
  'variables' => 
  array (
    'retour' => 0,
    'infoPseudo' => 0,
    'info' => 0,
    'token' => 0,
    'perm' => 0,
    'infoPermUser' => 0,
    'lrang' => 0,
    'rang' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5391981d327e06_21508942')) {function content_5391981d327e06_21508942($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['retour']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['retour']->value=="token") {?>
				<div class="alert alert-danger">Token invalide ou innexistant !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retour']->value=="ok") {?>
				<div class="alert alert-success">Vous avez modifier le profil de <b><?php echo $_smarty_tpl->tpl_vars['infoPseudo']->value;?>
</b></div>
			<?php }?>
		<?php }?>
		<div class="well">
			<form method="post" action="./users.php?uid=<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
				<h2>Modifier le profil de <b><?php echo $_smarty_tpl->tpl_vars['infoPseudo']->value;?>
</b></h2>
				<div class="form-group">
					<label>Pseudo:</label>
					<input type="text" name="pseudo" required="true" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['infoPseudo']->value;?>
" />
				</div>
				<?php if ($_smarty_tpl->tpl_vars['perm']->value['modifUsersPassword']=='1') {?>
				<div class="form-group">
					<label>Mot de Passe:</label>
					<input type="password" name="password" class="form-control" placeholder="Laissez vide pour ne pas modifier" />
				</div>
				<?php }?>
				<div class="form-group">
					<label>Adresse E-Mail:</label>
					<input type="email" name="email" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['email'];?>
" />
				</div>
				<?php if ($_smarty_tpl->tpl_vars['perm']->value['modifUsersRang']=='1') {?>
				<div class="form-group">
					<label>Rang:</label>
					<select name="rang" class="form-control">
						<option value="<?php echo $_smarty_tpl->tpl_vars['info']->value['permission'];?>
"><?php echo $_smarty_tpl->tpl_vars['infoPermUser']->value['nom'];?>
</option>
						<?php  $_smarty_tpl->tpl_vars['rang'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rang']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lrang']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rang']->key => $_smarty_tpl->tpl_vars['rang']->value) {
$_smarty_tpl->tpl_vars['rang']->_loop = true;
?>
							<?php if ($_smarty_tpl->tpl_vars['rang']->value['id']!=$_smarty_tpl->tpl_vars['info']->value['permission']) {?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['rang']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['rang']->value['nom'];?>
</option>
							<?php }?>
						<?php } ?>
					</select>
					<a href="./permissions.php">Modifier les permissions</a>
				</div>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['perm']->value['modifUsersProtect']=='1') {?>
				<div class="form-group">
					<label>Compte protégé ?</label>
					<select name="protected" class="form-control">
						<?php if ($_smarty_tpl->tpl_vars['info']->value['protected']=='1') {?>
							<option value="1"> Oui </option>
							<option value="0"> Non </option>
						<?php } else { ?>
							<option value="0"> Non </option>
							<option value="1"> Oui </option>
						<?php }?>
					</select>
				</div>
				<?php }?>
				<input type="submit" class="btn btn-primary btn-lg btn-block" value="Modifier" />
			</form><br />
			<a href="javascript:history.back(1)" class="btn btn-default btn-lg btn-block">Retour en arrière</a>
		</div>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
