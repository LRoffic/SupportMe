<?php /* Smarty version Smarty-3.1.17, created on 2014-06-26 03:57:06
         compiled from ".\templates\default\authentification.html" */ ?>
<?php /*%%SmartyHeaderCode:2517534361654c5fc8-35433473%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13da87dd59c05b58e0405db09ee1b16e0d714b28' => 
    array (
      0 => '.\\templates\\default\\authentification.html',
      1 => 1397773834,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2517534361654c5fc8-35433473',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_534361658552e8_79605138',
  'variables' => 
  array (
    'siteconfig' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534361658552e8_79605138')) {function content_534361658552e8_79605138($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("default/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="container">
		<div class="well">
			<h1>Voir la liste de ses tickets</h1>
			<form method="post" id="emailauth">
				<div class="form-group">
					<label for="email">Adresse Mail :</label>
					<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
					<input type="email" class="form-control" name="email" required="true" />
				</div>
				<div class="form-group">
					<label for="password">Code reçus par email :</label>
					<span style="color: red;" class="glyphicon glyphicon-asterisk"></span>
					<input type="password" class="form-control" name="password" required="true" />
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
				<input type="submit" class="btn btn-lg btn-block btn-info" value="Connexion" />
			</form>
		</div>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("default/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
