<?php /* Smarty version Smarty-3.1.17, created on 2015-03-21 23:27:17
         compiled from ".\templates\alert.html" */ ?>
<?php /*%%SmartyHeaderCode:25055383b21896c644-80813933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '852dc18f795aebbdee330f723381e19c36e46d94' => 
    array (
      0 => '.\\templates\\alert.html',
      1 => 1409288644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25055383b21896c644-80813933',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5383b2189f0e92_53140483',
  'variables' => 
  array (
    'alerte' => 0,
    'version' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5383b2189f0e92_53140483')) {function content_5383b2189f0e92_53140483($_smarty_tpl) {?><div id="result" style="display: none;"></div>
<?php if (!empty($_smarty_tpl->tpl_vars['alerte']->value)) {?><?php echo $_smarty_tpl->tpl_vars['alerte']->value;?>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['version']->value)) {?>
<div class="alert alert-info" style="text-align:center">La version <?php echo $_smarty_tpl->tpl_vars['version']->value;?>
 de Support Me est désormais disponible ! <a href="http://supportme.dzv.me" target="_blank">Pensez à faire la mise à jour </a></div>
<?php }?><?php }} ?>
