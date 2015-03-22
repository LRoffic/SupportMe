<?php /* Smarty version Smarty-3.1.17, created on 2014-06-28 18:40:29
         compiled from ".\templates\ticket.html" */ ?>
<?php /*%%SmartyHeaderCode:19586539aefb02c6034-08225686%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc9b9d0b9ca8c9a9f7172075a3a6292325165e2b' => 
    array (
      0 => '.\\templates\\ticket.html',
      1 => 1403977682,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19586539aefb02c6034-08225686',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_539aefb0485394_63394965',
  'variables' => 
  array (
    'retour' => 0,
    'info' => 0,
    'categorie' => 0,
    'auteur' => 0,
    'date' => 0,
    'message' => 0,
    'perm' => 0,
    'pseudo' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_539aefb0485394_63394965')) {function content_539aefb0485394_63394965($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<div class="col-md-10">
		<?php echo $_smarty_tpl->getSubTemplate ("alert.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['retour']->value)) {?>
			<?php if ($_smarty_tpl->tpl_vars['retour']->value=='emptyid') {?>
				<div class="alert alert-danger">Aucun ticket choisis !</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['retour']->value=='notexist') {?>
				<div class="alert alert-danger">Le ticket n'existe pas !</div>
			<?php }?>
		<?php }?>
		<div class="well">
			Sujet : <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['sujet'], ENT_QUOTES, 'UTF-8', true);?>
<br />
			Catégorie : <?php echo $_smarty_tpl->tpl_vars['categorie']->value;?>
<br />
			Auteur : <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['auteur']->value, ENT_QUOTES, 'UTF-8', true);?>
<br />
			Date d'ouverture : <?php echo $_smarty_tpl->tpl_vars['date']->value;?>
<br />
			<span id="etat"></span><br />
			Message :
			<div class="well">
				<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

			</div>
			<div  class="btn-group">
				<?php if ($_smarty_tpl->tpl_vars['perm']->value['canAssign']=='1'&&$_smarty_tpl->tpl_vars['info']->value['assignto']!=$_smarty_tpl->tpl_vars['pseudo']->value) {?>
					<a href="./index.php?option=assign&tid=<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
&to=<?php echo $_smarty_tpl->tpl_vars['pseudo']->value;?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" class="btn btn-warning"> Me l'assigner</a>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['perm']->value['canUnAssign']=='1'&&$_smarty_tpl->tpl_vars['info']->value['assignto']==$_smarty_tpl->tpl_vars['pseudo']->value) {?>
					<a href="./index.php?option=unassign&tid=<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
&token=<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" class="btn btn-warning"> Désassigner</a>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['perm']->value['resolve']=='1') {?>
					<a href="#" onclick="clore('<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
')" class="btn btn-success">Clore</a>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['perm']->value['deleteticket']=='1') {?>
					<a href="#" onclick="deleteTicket('<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
', '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
')" class="btn btn-danger">Supprimer</a>
				<?php }?>
			</div>
		</div>
		<div id="resultcom"></div>
		<?php if ($_smarty_tpl->tpl_vars['perm']->value['comment']=='1'&&$_smarty_tpl->tpl_vars['info']->value['etat']!='2'&&$_smarty_tpl->tpl_vars['info']->value['isfaq']!='1') {?>
			<div class="well">
				<form method="post" id="commentaire">
					<div class="form-group">
							<textarea name="commentaire" class="tiny"></textarea>
					</div>
					<div class="form-group">
						<input type="checkbox" name="mail" checked="true" /> Envoyé un mail à l'utilisateur pour l'avertir de la réponse.
					</div>
					<input type="submit" class="btn btn-primary btn-lg btn-block" value="Envoyer" />
				</form>
			</div>
		<?php }?>
		<div id="com"></div>
		<script>
			function etat()
				{
					$( "#etat" ).load("./requete.php?action=etat&id=<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
");
				}
			function com()
				{
					$( "#com" ).load("./requete.php?action=commentaire&id=<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
");
				}
			setInterval(etat, 1000);
			setInterval(com, 1000);
			$("#commentaire").submit(function () {
	            tinyMCE.triggerSave();
	            $.post("./requete.php?action=commenter&id=<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
",$("#commentaire").serialize(),function(texte){
	                $("div#resultcom").append(texte).slideDown("slow");
	                $("div#resultcom").delay(4000).slideUp("slow");
	                $(".alrt").delay(5000).hide("slow");
	            });
	            return false; // ne change pas de page
	    	});
		</script>
	</div>
<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
