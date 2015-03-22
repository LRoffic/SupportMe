<?php /* Smarty version Smarty-3.1.17, created on 2014-06-26 05:17:09
         compiled from ".\templates\default\faq.html" */ ?>
<?php /*%%SmartyHeaderCode:3206153473f6d54d239-15164897%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0aac3a7024dadc17390b4fc4ccdb86fe6fc73ed8' => 
    array (
      0 => '.\\templates\\default\\faq.html',
      1 => 1403759826,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3206153473f6d54d239-15164897',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53473f6d7846e9_93043466',
  'variables' => 
  array (
    'listfa' => 0,
    'fa' => 0,
    'listcom' => 0,
    'com' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53473f6d7846e9_93043466')) {function content_53473f6d7846e9_93043466($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("default/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="container">
	<div class="well"><h1>Foire aux questions</h1></div>
	<div class="panel-group" id="accordion">
	<?php  $_smarty_tpl->tpl_vars['fa'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fa']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listfa']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fa']->key => $_smarty_tpl->tpl_vars['fa']->value) {
$_smarty_tpl->tpl_vars['fa']->_loop = true;
?>
	<div class="panel panel-default">
		<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $_smarty_tpl->tpl_vars['fa']->value['id'];?>
">
			<h4 class="panel-title">
				<?php echo $_smarty_tpl->tpl_vars['fa']->value['sujet'];?>

			</h4>
		</div>
		<div id="<?php echo $_smarty_tpl->tpl_vars['fa']->value['id'];?>
" class="panel-collapse collapse">
			<div class="panel-body">
				<em><u>Posé par <?php echo $_smarty_tpl->tpl_vars['fa']->value['auteur'];?>
 le <?php echo $_smarty_tpl->tpl_vars['fa']->value['date'];?>
</u></em><br />
				<div class="well">
					<?php echo $_smarty_tpl->tpl_vars['fa']->value['contenu'];?>

				</div><br /><br />
				Réponses :<br />
				<?php  $_smarty_tpl->tpl_vars['com'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['com']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listcom']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['com']->key => $_smarty_tpl->tpl_vars['com']->value) {
$_smarty_tpl->tpl_vars['com']->_loop = true;
?>
					<?php if ($_smarty_tpl->tpl_vars['com']->value['tid']==$_smarty_tpl->tpl_vars['fa']->value['id']&&$_smarty_tpl->tpl_vars['com']->value['masked']!='1') {?>
					<div class="well">
						<em><u>Réponse par <?php echo $_smarty_tpl->tpl_vars['com']->value['auteur'];?>
 le <?php echo $_smarty_tpl->tpl_vars['com']->value['date'];?>
</u></em><br />
						<?php echo $_smarty_tpl->tpl_vars['com']->value['contenu'];?>

					</div>
					<?php }?>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php } ?>
	</div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("default/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
