<?php /* Smarty version Smarty-3.1.17, created on 2014-05-04 02:53:57
         compiled from "./templates/default/home.html" */ ?>
<?php /*%%SmartyHeaderCode:4439270875365abae97b771-66505868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '183e38598c97c903aa930196fde7549a6e6c7932' => 
    array (
      0 => './templates/default/home.html',
      1 => 1399172033,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4439270875365abae97b771-66505868',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5365abae991669_72494867',
  'variables' => 
  array (
    'perm' => 0,
    'siteconfig' => 0,
    'nbfaq' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5365abae991669_72494867')) {function content_5365abae991669_72494867($_smarty_tpl) {?><div class="container">
			<div class="row">
				<?php if ($_smarty_tpl->tpl_vars['perm']->value['sendticket']=='1') {?>
				<div class="col-md-6">
					<div class="well">
						<h1><u>Envoyer un ticket</u></h1>
						<div style="display: block;text-align: -webkit-center;">
							<img src="./templates/default/img/new.jpg" />
						</div><br />
						<a href="./new.php" class="btn btn-lg btn-block btn-primary" width="100" height="100">Contacté le support</a>
					</div>
				</div>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewticket']=='1') {?>
				<div class="col-md-6">
					<div class="well">
						<h1><u>Voir un ticket</u></h1>
						<div style="display: block;text-align: -webkit-center;">
							<img src="./templates/default/img/ticket.jpg"  width="100" height="100"/>
						</div>
						<a href="./view.php" class="btn btn-lg btn-block btn-info">Voir un ticket</a>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['siteconfig']->value['faq']=='e'&&$_smarty_tpl->tpl_vars['perm']->value['viewfaq']=='1') {?>
			<?php if ($_smarty_tpl->tpl_vars['nbfaq']->value>'0') {?>
				<div class="container">
					<div class="well">
						<h1><u>Voir la FAQ</u></h1>
						<div style="display: block;text-align: center;">
							<img src="./templates/default/img/faq.jpg"  width="100" height="100"/>
						</div><br />
						<a href="./faq.php" class="btn btn-lg btn-block btn-warning">Consulter la Foire Aux Questions</a>
					</div>
				</div>
			<?php }?>
		<?php }?><?php }} ?>
