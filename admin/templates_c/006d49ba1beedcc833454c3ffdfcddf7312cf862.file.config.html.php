<?php /* Smarty version Smarty-3.1.17, created on 2014-06-01 04:10:14
         compiled from ".\templates\config.html" */ ?>
<?php /*%%SmartyHeaderCode:3846538a7eec94ed48-33735467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '006d49ba1beedcc833454c3ffdfcddf7312cf862' => 
    array (
      0 => '.\\templates\\config.html',
      1 => 1401588599,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3846538a7eec94ed48-33735467',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_538a7eecb85b62_07374421',
  'variables' => 
  array (
    'alert' => 0,
    'token' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_538a7eecb85b62_07374421')) {function content_538a7eecb85b62_07374421($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['alert']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['alert']->value=='token') {?>
				<div class="alert alert-danger">Token invalide ou innexistant !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=='mail') {?>
				<div class="alert alert-danger">Le format de l'email n'est pas compatible !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=='inputBroken') {?>
				<div class="alert alert-danger">Un des champs à été modifier et n'est désormais plus compatible avec le formulaire !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value=='modifok') {?>
				<div class="alert alert-success">La configuration a été modifié !</div>
			<?php }?>
		<?php }?>
		<div class="panel panel-primary">
			<div class="panel-heading">Modifier la configuration de <b>Support Me</b></div>
			<div class="panl panel-body">
				<form method="post" action="./config.php?token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
					<div class="form-group">
						<label>Nom du support:</label>
						<input type="text" name="sitename" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['sitename'];?>
" required="true" class="form-control" />
					</div>
					<div class="form-group">
						<label>Email du support:</label>
						<input type="text" name="sitemail" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['sitemail'];?>
" required="true" class="form-control" />
					</div>
					<div class="form-group">
						<label>Inscription:</label>
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
						<label>Autorisation des cookies (garder la session active):</label>
						<select name="cookie" class="form-control">
						<?php if ($_smarty_tpl->tpl_vars['config']->value['cookie']=='1') {?>
							<option value="1">Autoriser</option>
							<option value="0">Pas autoriser</option>
						<?php } else { ?>
							<option value="0">Pas autoriser</option>
							<option value="1">Autoriser</option>
						<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Système de FAQ:</label>
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
					<div class="form-group">
						<label>Utiliser <a href="https://www.google.fr/search?q=recaptcha" target="_blank">Recaptcha</a> ?:</label>
						<select name="recaptcha" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['config']->value['recaptcha']=='e') {?>
								<option value="e">Activé</option>
								<option value="d">Désactivé</option>
							<?php } else { ?>
								<option value="d">Désactivé</option>
								<option value="e">Activé</option>
							<?php }?>
						</select>
					</div>
					<div class="form-group">
						<label>Recaptcha Key:</label>
						<input type="text" name="recaptcha_key" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['recaptcha_key'];?>
" class="form-control" />
					</div>
					<div class="form-group">
						<label>Recaptcha Key:</label>
						<input type="text" name="recaptcha_privatekey" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['recaptcha_privatekey'];?>
" class="form-control" />
					</div>
					<div class="form-group">
						<label>
							Utiliser l'<a href="http://fr.wikipedia.org/wiki/Htaccess#R.C3.A9.C3.A9criture_d.27URL" target="_blank">URL Rewrite</a> ?:
						</label>
						<select name="htaccess" class="form-control">
							<?php if ($_smarty_tpl->tpl_vars['config']->value['htaccess']=='e') {?>
								<option value="e">Activé</option>
								<option value="d">Désactivé</option>
							<?php } else { ?>
								<option value="d">Désactivé</option>
								<option value="e">Activé</option>
							<?php }?>
						</select>
					</div>
					<input type="submit" class="btn btn-lg btn-block btn-primary" value="Modifier" />
				</form>
			</div>
		</div>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
