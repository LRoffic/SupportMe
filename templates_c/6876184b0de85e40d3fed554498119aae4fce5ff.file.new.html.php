<?php /* Smarty version Smarty-3.1.17, created on 2014-04-18 18:37:39
         compiled from "./templates/default/new.html" */ ?>
<?php /*%%SmartyHeaderCode:1424865288535170f33bab46-85204854%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6876184b0de85e40d3fed554498119aae4fce5ff' => 
    array (
      0 => './templates/default/new.html',
      1 => 1397781035,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1424865288535170f33bab46-85204854',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'siteconfig' => 0,
    'getmail' => 0,
    'categorie' => 0,
    'cat' => 0,
    'categ' => 0,
    'perm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_535170f3453923_38118709',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535170f3453923_38118709')) {function content_535170f3453923_38118709($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("default/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['siteconfig']->value['registration']=='none') {?>
		<div class="container">
			<div class="row">
				<div class="well">
					<h2><u>Envoyer un nouveau ticket</u></h2>
					<form method="post" id="new">
						<div class="form-group">
							<label for="email">Adresse Mail :</label>
							<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
							<input type="email" class="form-control" name="email" required="true" <?php if (isset($_smarty_tpl->tpl_vars['getmail']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['getmail']->value;?>
"<?php }?>/>
						</div>
						<div class="form-group">
							<label for="sujet">Sujet :</label>
							<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
							<input type="text" class="form-control" name="sujet" required="true" />
						</div>
						<div class="form-group">
							<label for="categorie">Catégorie :</label>
							<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
							<select name="categorie" class="form-control" required="true">
								<?php if (!isset($_smarty_tpl->tpl_vars['categorie']->value)) {?>
								<option>-- Choisir une option --</option>
								<?php } else { ?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['categorie']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['categorie']->value['nom'];?>
</option>
								<?php }?>

								<?php  $_smarty_tpl->tpl_vars['categ'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categ']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categ']->key => $_smarty_tpl->tpl_vars['categ']->value) {
$_smarty_tpl->tpl_vars['categ']->_loop = true;
?>
									<option value="<?php echo $_smarty_tpl->tpl_vars['categ']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['categ']->value['nom'];?>
</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="message">Message :</label>
							<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
							<textarea class="tiny" name="message"></textarea>
						</div>
						<?php if ($_smarty_tpl->tpl_vars['siteconfig']->value['recaptcha']=="e") {?>
						<div class="form-group">
							<label for="captcha">Captcha :</label>
							<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
							<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $_smarty_tpl->tpl_vars['siteconfig']->value['recaptcha_key'];?>
"></script>
				        	<noscript>
				            	<iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $_smarty_tpl->tpl_vars['siteconfig']->value['recaptcha_key'];?>
" height="300" width="500" frameborder="0"></iframe><br>
				             	<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
				            	<input type="hidden" name="recaptcha_response_field" value="manual_challenge" />
				        	</noscript>
						</div>
						<?php }?>
						<input type="submit" class="btn btn-lg btn-block btn-primary" value="Envoyer" />
					</form>
				</div>
			</div>
		</div>
	<?php } elseif ($_smarty_tpl->tpl_vars['siteconfig']->value['registration']=='force') {?>
	<div class="container">
		<div class="row">
			<div class="well">
				<h2><u>Envoyer un nouveau ticket</u></h2>
				<form method="post" id="new">
					<div class="form-group">
						<label for="sujet">Sujet :</label>
						<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
						<input type="text" class="form-control" name="sujet" required="true" />
					</div>
					<div class="form-group">
						<label for="categorie">Catégorie :</label>
						<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
						<select name="categorie" class="form-control" required="true">
							<?php if (!isset($_smarty_tpl->tpl_vars['categorie']->value)) {?>
								<option>-- Choisir une option --</option>
							<?php } else { ?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['categorie']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['categorie']->value['nom'];?>
</option>
							<?php }?>

							<?php  $_smarty_tpl->tpl_vars['categ'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['categ']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['categ']->key => $_smarty_tpl->tpl_vars['categ']->value) {
$_smarty_tpl->tpl_vars['categ']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['categ']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['categ']->value['nom'];?>
</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="message">Message :</label>
						<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
						<textarea class="tiny" name="message"></textarea>
					</div>
					<input type="submit" class="btn btn-lg btn-block btn-primary" value="Envoyer" />
				</form>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['perm']->value['lastresolved']=='1'||$_smarty_tpl->tpl_vars['perm']->value['viewticket']=='1') {?>
				<div class="well" style="text-align: center">
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['lastresolved']=='1') {?>
						<a href="./resolved.php" class="btn btn-success">Voir les tickets déjà résolues</a>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewticket']=='1') {?>
						<a href="./viwe.php" class="btn btn-default">Voir les tickets en cours</a>
					<?php }?>
				</div>
			<?php }?>
		</div>
	</div>
	<?php } else { ?>
	<div class="alert alert-danger">
		<b>Erreur :</b> Une erreur interne du serveur à été détéctez !
	</div>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("default/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
