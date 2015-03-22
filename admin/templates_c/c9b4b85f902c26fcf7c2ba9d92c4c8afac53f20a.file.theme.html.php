<?php /* Smarty version Smarty-3.1.17, created on 2014-06-11 01:31:15
         compiled from "..\templates\admin\theme.html" */ ?>
<?php /*%%SmartyHeaderCode:22282539795431fff21-72305848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c9b4b85f902c26fcf7c2ba9d92c4c8afac53f20a' => 
    array (
      0 => '..\\templates\\admin\\theme.html',
      1 => 1398643568,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22282539795431fff21-72305848',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'erreur' => 0,
    'listfiles' => 0,
    'f' => 0,
    't' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53979543f31010_19591047',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53979543f31010_19591047')) {function content_53979543f31010_19591047($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (!empty($_smarty_tpl->tpl_vars['erreur']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['erreur']->value=='token') {?>
				<div class="alert alert-danger"><b>Erreur :</b> Token invalide ou innexistant.</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='foldernotfound') {?>
				<div class="alert alert-danger"><b>Erreur :</b> Le thème n'existe pas !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='versionnotfound') {?>
				<div class="alert alert-danger"><b>Erreur :</b> Le fichier version du thème n'existe pas !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='okupd') {?>
				<div class="alert alert-success">Votre thème a été modifié !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='delok') {?>
				<div class="alert alert-success">Le thème a été correctement supprimé !</div>
			<?php }?>
		<?php }?>
		<div class="panel panel-default">
			<div class="panel-heading">Liste des thèmes</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Auteur</th>
						<th>Version</th>
						<th>Option</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['f'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['f']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listfiles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['f']->key => $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->_loop = true;
?>
						<tr <?php if ($_smarty_tpl->tpl_vars['f']->value['verif']==$_smarty_tpl->tpl_vars['t']->value['template']) {?>class="success"<?php }?>>
							<td><?php echo $_smarty_tpl->tpl_vars['f']->value['nom'];?>
</td>
							<td>
								<?php if (!empty($_smarty_tpl->tpl_vars['f']->value['auteur'])) {?>
									<?php if (!empty($_smarty_tpl->tpl_vars['f']->value['siteautor'])) {?>
										<a href="<?php echo $_smarty_tpl->tpl_vars['f']->value['siteautor'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['f']->value['auteur'];?>
</a>
									<?php } else { ?>
										<?php echo $_smarty_tpl->tpl_vars['f']->value['auteur'];?>

									<?php }?>
								<?php } else { ?>
									Inconnue
								<?php }?>
							</td>
							<td>
								<?php echo $_smarty_tpl->tpl_vars['f']->value['version'];?>

								<?php if ($_smarty_tpl->tpl_vars['f']->value['updver']!=$_smarty_tpl->tpl_vars['f']->value['version']) {?>
									(<a href="<?php echo $_smarty_tpl->tpl_vars['f']->value['download'];?>
" target="_blank">La nouvelle version <?php echo $_smarty_tpl->tpl_vars['f']->value['updver'];?>
 est disponible</a>)
								<?php }?>
							</td>
							<td>
								<div class="btn-group">
									<?php if ($_smarty_tpl->tpl_vars['f']->value['verif']!=$_smarty_tpl->tpl_vars['t']->value['template']) {?>
										<a href="./theme.php?use=<?php echo $_smarty_tpl->tpl_vars['f']->value['folder'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" class="btn btn-success">Utiliser</a>
										<a href="./theme.php?del=<?php echo $_smarty_tpl->tpl_vars['f']->value['folder'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" class="btn btn-danger">Supprimer</a>
									<?php } else { ?>
										Aucune option possible
									<?php }?>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<div style="text-align:center; padding-top: 10px;"><a href="" class="btn btn-primary btn-block btn-lg">Plus de thèmes</a></div>
		</div>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
