<?php /* Smarty version Smarty-3.1.17, created on 2014-06-13 21:06:30
         compiled from ".\templates\ticketlist.html" */ ?>
<?php /*%%SmartyHeaderCode:2829253853c1b021672-34006110%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b856cc9bd4bea20cf91f367de73b8c951677f57' => 
    array (
      0 => '.\\templates\\ticketlist.html',
      1 => 1402686361,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2829253853c1b021672-34006110',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53853c1b3213d2_65573142',
  'variables' => 
  array (
    'page' => 0,
    'list' => 0,
    'l' => 0,
    'perm' => 0,
    'pseudo' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53853c1b3213d2_65573142')) {function content_53853c1b3213d2_65573142($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="col-md-10">
	<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
					<th>Auteur</th>
					<th>Sujet</th>
					<th>Date</th>
					<th>Categorie</th>
					<th>Assigné</th>
					<th>Option</th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['l'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['l']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['l']->key => $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
?>
					<tr>
						<td><?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['l']->value['auteur'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['l']->value['sujet'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['l']->value['date'];?>
</td>
						<td><?php echo $_smarty_tpl->tpl_vars['l']->value['categorie'];?>
</td>
						<td>
							<?php if ($_smarty_tpl->tpl_vars['l']->value['assigned']=='0') {?>
								Le ticket n'est pas assigné !
							<?php } else { ?>
								<?php echo $_smarty_tpl->tpl_vars['l']->value['assignto'];?>

							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['l']->value['isfaq']=='1') {?>
								<br /><label class="label label-success">Le ticket est une faq</label>
							<?php }?>
						</td>
						<td>
							<div class="btn-group">
								<a href="./ticket.php?tid=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
" class="btn btn-info">Voir</a>
								<?php if ($_smarty_tpl->tpl_vars['page']->value=='notassignedtome') {?>
									<?php if ($_smarty_tpl->tpl_vars['perm']->value['canAssign']=='1'&&$_smarty_tpl->tpl_vars['l']->value['assignto']!=$_smarty_tpl->tpl_vars['pseudo']->value) {?>
										<a href="./index.php?option=assign&tid=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
&to=<?php echo $_smarty_tpl->tpl_vars['pseudo']->value;?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" class="btn btn-warning"> Me l'assigner</a>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['perm']->value['canUnAssign']=='1'&&$_smarty_tpl->tpl_vars['l']->value['assignto']==$_smarty_tpl->tpl_vars['pseudo']->value) {?>
										<a href="./index.php?option=unassign&tid=<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" class="btn btn-warning"> Désassigner</a>
									<?php }?>
									<?php if ($_smarty_tpl->tpl_vars['perm']->value['resolve']=='1') {?>
										<a href="#" onclick="clore('<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
')" class="btn btn-success">Clore</a>
									<?php }?>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['perm']->value['deleteticket']=='1') {?>
									<a href="#" onclick="deleteTicket('<?php echo $_smarty_tpl->tpl_vars['l']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
')" class="btn btn-danger">Supprimer</a>
								<?php }?>
							</div>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
