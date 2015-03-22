<?php /* Smarty version Smarty-3.1.17, created on 2014-06-11 01:41:02
         compiled from ".\..\templates\default\index.html" */ ?>
<?php /*%%SmartyHeaderCode:221755397978eeb48c1-20344217%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b9b0767087a628e54115310a63c8b5c9238622e' => 
    array (
      0 => '.\\..\\templates\\default\\index.html',
      1 => 1399164808,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '221755397978eeb48c1-20344217',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'siteconfig' => 0,
    'isconnect' => 0,
    'sitename' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5397978f374477_88096034',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5397978f374477_88096034')) {function content_5397978f374477_88096034($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("default/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['siteconfig']->value['registration']=='none') {?>
		<?php echo $_smarty_tpl->getSubTemplate ("default/home.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php } elseif ($_smarty_tpl->tpl_vars['siteconfig']->value['registration']=='force') {?>
		<?php if (isset($_smarty_tpl->tpl_vars['isconnect']->value)&&$_smarty_tpl->tpl_vars['isconnect']->value=='false'||empty($_smarty_tpl->tpl_vars['isconnect']->value)) {?>
			<div class="container">
				<div class="well well-lg">
					<p>Bienvenu sur le support de <?php echo $_smarty_tpl->tpl_vars['sitename']->value;?>
,<br /> pour pouvoir contacter le support veuillez vous connectez ou vous inscrire !</p>
				</div>
				<div class="col-md-6">
					<div class="well"  id="groupinsc">
						<h2><u>Inscription : </u></h2>
						<form method="post" id="inscription">
							<div class="form-group">
								<label for="email">Adresse Mail :</label>
								<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
								<input type="email" class="form-control" name="email" required="true" />
							</div>
							<div class="form-group">
								<label for="pseudo">Nom ou Pseudo :</label>
								<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
								<input type="text" class="form-control" name="pseudo" required="true" />
							</div>
							<div class="form-group">
								<label for="password">Mot de passe :</label>
								<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
								<input type="password" class="form-control" name="password" required="true" />
							</div>
							<div class="form-group">
								<label for="verifpass">Retapez le mot de passe :</label>
								<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
								<input type="password" class="form-control" name="verifpass" required="true" />
							</div>
							<?php if (isset($_smarty_tpl->tpl_vars['siteconfig']->value)&&$_smarty_tpl->tpl_vars['siteconfig']->value['recaptcha']=="e") {?>
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
							<input type="submit" class="btn btn-lg btn-block btn-primary" value="S'inscrire" />
						</form>
					</div>
				</div>
				<div class="col-md-6">
					<div class="well" id="groupconnex">
						<h2><u>Connexion :</u></h2>
						<form method="post" id="connexion">
							<div class="form-group">
								<label for="pseudo">Nom, Pseudo ou adresse mail :</label>
								<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
								<input type="text" class="form-control" name="pseudo" required="true" />
							</div>
							<div class="form-group">
								<label for="password">Mot de passe :</label>
								<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
								<input type="password" class="form-control" name="password" required="true" />
							</div>
							<?php if (isset($_smarty_tpl->tpl_vars['siteconfig']->value)&&$_smarty_tpl->tpl_vars['siteconfig']->value['cookie']=='1') {?>
							<div class="form-group">
								<input type="checkbox" name="remember" checked="true" /> Se souvenir de moi
							</div>
							<?php }?>
							<input type="submit" class="btn btn-lg btn-block btn-info" value="Connexion" />
						</form>
					</div>
				</div>
			</div>
		<?php } elseif (isset($_smarty_tpl->tpl_vars['isconnect']->value)&&$_smarty_tpl->tpl_vars['isconnect']->value=='true') {?>
			<?php echo $_smarty_tpl->getSubTemplate ("default/home.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php }?>
	<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("default/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
