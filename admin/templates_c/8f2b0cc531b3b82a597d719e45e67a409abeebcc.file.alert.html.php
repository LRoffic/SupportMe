<?php /* Smarty version Smarty-3.1.17, created on 2014-04-19 04:32:58
         compiled from "./templates/alert.html" */ ?>
<?php /*%%SmartyHeaderCode:9824687245351e05a9a9452-89000851%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f2b0cc531b3b82a597d719e45e67a409abeebcc' => 
    array (
      0 => './templates/alert.html',
      1 => 1397873340,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9824687245351e05a9a9452-89000851',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'alerte' => 0,
    'version' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5351e05a9bb389_87409087',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5351e05a9bb389_87409087')) {function content_5351e05a9bb389_87409087($_smarty_tpl) {?><?php if (!empty($_smarty_tpl->tpl_vars['alerte']->value)) {?><?php echo $_smarty_tpl->tpl_vars['alerte']->value;?>
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['version']->value)) {?>
<div class="alert alert-info">La version <?php echo $_smarty_tpl->tpl_vars['version']->value;?>
 est désormais disponible ! <a href="http://lroffic.net/projet-2.php" target="_blank">Pensez à faire la mise à jour </a></a></div>
<?php }?><?php }} ?>
