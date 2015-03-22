<?php /* Smarty version Smarty-3.1.17, created on 2015-03-21 23:58:05
         compiled from ".\templates\categorie.html" */ ?>
<?php /*%%SmartyHeaderCode:2394353b0526771a986-16904288%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fbc0cfe26ef9c695aad8dac9a697da13f7e4435' => 
    array (
      0 => '.\\templates\\categorie.html',
      1 => 1404105409,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2394353b0526771a986-16904288',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53b05267890602_46157186',
  'variables' => 
  array (
    'retour' => 0,
    'retou' => 0,
    'empty' => 0,
    'token' => 0,
    'categs' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53b05267890602_46157186')) {function content_53b05267890602_46157186($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['retour']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['retour']->value=='token') {?>
				<div class="alert alert-danger">Token invalide ou innexistant !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retou']->value=='okadd') {?>
				<div class="alert alert-success">Catégorie ajouté avec succès !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retou']->value=='okdel') {?>
				<div class="alert alert-success">Catégorie supprimé avec succès !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retour']->value=='emptyname') {?>
				<div class="alert alert-danger">Le nom de la catégorie est manquant ! La catégorie n'a pas été ajouté !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retour']->value=='emptyid') {?>
				<div class="alert alert-danger">L'id' de la catégorie est manquant ! La catégorie n'a pas été supprimé !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retour']->value=='categ1') {?>
				<div class="alert alert-danger">
					Cette catégorie ne peux pas être supprimé, si vous la supprimé certaines erreurs peuvent apparaîtres !
				</div>
			<?php }?>
		<?php }?>
		<div class="panel-group" id="accordion">
			<div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#AddCateg">
					Ajoutez une catégorie
				</div>
				<div id="AddCateg" class="panel-collapse collapse <?php if (isset($_smarty_tpl->tpl_vars['empty']->value)) {?> in <?php }?>">
					<div class="panel-body">
						<form metod="post" action="./categorie.php?action=new&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
							<div class="form-group">
								<label>Nom de la catégorie</label>
								<input type="text" name="name" required="true" class="form-control"/>
							</div>
							<input type="submit" class="btn btn-primary btn-lg btn-block" value="envoyer" />
							</form>
						</form>
					</div>
				</div>
			</div>
			<?php if (isset($_smarty_tpl->tpl_vars['empty']->value)) {?>
				<div class="alert alert-danger">Il n'y a aucune catégorie !</div>
			<?php } else { ?>
				<div class="panel panel-default">
					<div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#listCateg">
						Liste des catégories
					</div>
					<div id="listCateg" class="panel-collapse collapse in">
						<table class="table table-stripped table-bordered">
							<thead>
								<tr>
									<th>Nom</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
									<tr>
										<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value['nom'], ENT_QUOTES, 'UTF-8', true);?>
</td>
										<td>
											<?php if ($_smarty_tpl->tpl_vars['c']->value['id']!='1') {?>
												<a href="./categorie.php?action=delete&id=<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" class="btn btn-danger">Supprimer</a>
											<?php } elseif ($_smarty_tpl->tpl_vars['c']->value['id']=='1') {?>
												<a class="btn btn-danger disabled">Supprimer</a>
											<?php }?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			<?php }?>
		</div>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
