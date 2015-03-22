<?php /* Smarty version Smarty-3.1.17, created on 2014-04-26 22:27:02
         compiled from "./templates/default/erreur.html" */ ?>
<?php /*%%SmartyHeaderCode:1319791758535c32b6550798-15948347%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31e66c56cc79482112a440b140025b4f284b14fc' => 
    array (
      0 => './templates/default/erreur.html',
      1 => 1397781035,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1319791758535c32b6550798-15948347',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'erreur' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_535c32b65cd460_35981664',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535c32b65cd460_35981664')) {function content_535c32b65cd460_35981664($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("default/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
