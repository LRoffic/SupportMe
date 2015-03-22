<?php /* Smarty version Smarty-3.1.17, created on 2014-05-26 21:21:04
         compiled from ".\templates\default\ticketlist.html" */ ?>
<?php /*%%SmartyHeaderCode:1014253432b5ad15313-21355203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0fa931150558f3fb5f43ff87a3f0184165cce466' => 
    array (
      0 => '.\\templates\\default\\ticketlist.html',
      1 => 1398370308,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1014253432b5ad15313-21355203',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53432b5b006723_39893480',
  'variables' => 
  array (
    'listTick' => 0,
    'list' => 0,
    'siteconfig' => 0,
    'perm' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53432b5b006723_39893480')) {function content_53432b5b006723_39893480($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("default/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">Liste de vos tickets</div>
		<div class="panel-body">
			<table class="table table-striped">
				<thead>
					<th>Sujet</th>
					<th>Date</th>
					<th>&Eacute;tat</th>
					<th>Assignation</th>
					<th>Options</th>
				</thead>

				<tbody>
					<?php  $_smarty_tpl->tpl_vars['list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['list']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listTick']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['list']->key => $_smarty_tpl->tpl_vars['list']->value) {
$_smarty_tpl->tpl_vars['list']->_loop = true;
?>
						<tr id="ticket<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
">
							<td><?php echo $_smarty_tpl->tpl_vars['list']->value['sujet'];?>
</td>
							<td><?php echo $_smarty_tpl->tpl_vars['list']->value['date'];?>
</td>
							<td>
								<?php if ($_smarty_tpl->tpl_vars['list']->value['etat']=='0') {?>
									<span class="label label-danger">En cours...</span>
								<?php } elseif ($_smarty_tpl->tpl_vars['list']->value['etat']=='1') {?>
									<span class="label label-warning">En attente...</span>
								<?php } elseif ($_smarty_tpl->tpl_vars['list']->value['etat']=='2') {?>
									<span class="label label-success">Résolue</span>
								<?php }?>
							</td>
							<td>
								<?php if ($_smarty_tpl->tpl_vars['list']->value['assigned']=='0') {?>
									Ce ticket n'est pas encore assigné
								<?php } else { ?>
									<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['list']->value['assignto'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

								<?php }?>
							</td>
							<td>
								<?php if ($_smarty_tpl->tpl_vars['siteconfig']->value['htaccess']=='e') {?>
									<a href="./ticket-<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
.php" class="btn btn-default btn-sm">Voir le ticket</a>
								<?php } else { ?>
									<a href="./ticket.php?id=<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
" class="btn btn-default btn-sm">Voir le ticket</a>
								<?php }?> 
								<?php if ($_smarty_tpl->tpl_vars['perm']->value['resolve']=='1') {?>
									<a href="#" class="btn btn-success btn-sm" onclick="resolve('<?php echo $_smarty_tpl->tpl_vars['list']->value['id'];?>
', '0')">Ticket résolue</a>
								<?php }?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php if ($_smarty_tpl->tpl_vars['perm']->value['lastresolved']=='1') {?>
		<div class="well" style="text-align: center">
			<a href="./resolved.php" class="btn btn-success">Voir les tickets déjà résolues</a>
		</div>
	<?php }?>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("default/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
