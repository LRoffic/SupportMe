<?php /* Smarty version Smarty-3.1.17, created on 2014-06-26 04:27:07
         compiled from ".\templates\default\erreur.html" */ ?>
<?php /*%%SmartyHeaderCode:2139534325ed581907-60047664%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '451b1a647023e5be2d87d5fa6adf7ea2d1543393' => 
    array (
      0 => '.\\templates\\default\\erreur.html',
      1 => 1397773834,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2139534325ed581907-60047664',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_534325ee0175b6_76383519',
  'variables' => 
  array (
    'erreur' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534325ee0175b6_76383519')) {function content_534325ee0175b6_76383519($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("default/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="container">
	<?php if (isset($_smarty_tpl->tpl_vars['erreur']->value)) {?>
		<?php if ($_smarty_tpl->tpl_vars['erreur']->value=='noticket') {?>
			<div class="alert alert-danger"><b>Erreur :</b> Vous n'avez aucun ticket ouvert !</div>
			<a href="./resolved.php" class="btn btn-success btn-block">Voir mes tickets résolue</a>
		<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='noticketresolved') {?>
			<div class="alert alert-danger"><b>Erreur :</b> Vous n'avez aucun ticket résolue !</div>
			<a href="./view.php" class="btn btn-success btn-block">Voir mes tickets en cours</a>
		<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='emptyid') {?>
			<div class="alert alert-danger"><b>Erreur :</b> Il manque l'id !</div>
		<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='idnotnumeric') {?>
			<div class="alert alert-danger"><b>Erreur :</b> L'id du ticket n'est pas un chiffre !</div>
		<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='ticketnotfound') {?>
			<div class="alert alert-danger"><b>Erreur :</b> Le ticket n'existe pas !</div>
		<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='notautor') {?>
			<div class="alert alert-danger"><b>Erreur :</b> Vous ne pouvez pas voir ce ticket !</div>
		<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='notfaq') {?>
			<div class="alert alert-danger"><b>Erreur :</b> Il n'y a aucun ticket dans les FAQ's !</div>
		<?php }?>
	<?php } else { ?>
		<div class="alert alert-danger"><b>Erreur :</b> Une erreure de type inconnue à été détécté !</div>
	<?php }?>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("default/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
