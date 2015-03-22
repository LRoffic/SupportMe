<?php /* Smarty version Smarty-3.1.17, created on 2014-04-29 00:13:22
         compiled from "./templates/ticketlist.html" */ ?>
<?php /*%%SmartyHeaderCode:659946408535ecad354b139-81787516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3e69e06eed4a074d9953df37e5a2cdc93988c1a6' => 
    array (
      0 => './templates/ticketlist.html',
      1 => 1398723197,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '659946408535ecad354b139-81787516',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_535ecad3582e33_52006895',
  'variables' => 
  array (
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535ecad3582e33_52006895')) {function content_535ecad3582e33_52006895($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="col-md-10">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php if (!empty($_smarty_tpl->tpl_vars['page']->value)) {?>
				<?php if ($_smarty_tpl->tpl_vars['page']->value=='resolved') {?>
					Tickets résolus
				<?php } elseif ($_smarty_tpl->tpl_vars['page']->value=='notassignedtome') {?>
					Tickets assigné à quelqu'un d'autre
				<?php }?>
			<?php }?>
		</div>
		<table class="table table-stripped">
			<thead>
				<tr>
					<th>#</th>
					<th>Sujet</th>
					<th>Auteur</th>
					<th>Categorie</th>
					<th>Assigné</th>
					<th>Option</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
