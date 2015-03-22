<?php /* Smarty version Smarty-3.1.17, created on 2014-06-26 04:28:03
         compiled from ".\templates\default\ticket.html" */ ?>
<?php /*%%SmartyHeaderCode:617853446d1851ce13-30810521%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ddf4a9a71e0e69cbf36557386b342c0476e2d55' => 
    array (
      0 => '.\\templates\\default\\ticket.html',
      1 => 1403756405,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '617853446d1851ce13-30810521',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53446d18a53e33_44597690',
  'variables' => 
  array (
    'perm' => 0,
    'info' => 0,
    'sujet' => 0,
    'date' => 0,
    'contenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53446d18a53e33_44597690')) {function content_53446d18a53e33_44597690($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("default/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="container">
	<div style="text-align: right;">
		<?php if ($_smarty_tpl->tpl_vars['perm']->value['resolve']=='1'&&$_smarty_tpl->tpl_vars['info']->value['etat']!='2'&&$_smarty_tpl->tpl_vars['info']->value['isfaq']!='1') {?>
		<a href="#" onclick="resolve('<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
', '1')" class="btn btn-success" id="resolve">Résoudre le ticket</a>
		<?php } elseif ($_smarty_tpl->tpl_vars['perm']->value['reopen']=='1'&&$_smarty_tpl->tpl_vars['info']->value['etat']=='2'&&$_smarty_tpl->tpl_vars['info']->value['isfaq']!='1') {?>
		<a href="#" onclick="reopen('<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
', '1')" class="btn btn-danger" id="reopen">Réouvrir le ticket</a>
		<?php }?>
	</div>
	<div class="well">
		<h2><b><u><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['sujet']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</u></b></h2><br />
		<em><u>date : <?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</u></em><br />
		Assigné à : 
		<?php if ($_smarty_tpl->tpl_vars['info']->value['assigned']=='0') {?>
			Ce ticket n'est pas encore assigné
		<?php } else { ?>
			<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['assignto'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

		<?php }?><br />
		&Eacute;tat : <span id="etat"></span><br /><br />
		<div class="well">
			<?php echo $_smarty_tpl->tpl_vars['contenu']->value;?>

		</div>
	</div>
	<div id="resultcom"></div>
	<?php if ($_smarty_tpl->tpl_vars['perm']->value['comment']=='1'&&$_smarty_tpl->tpl_vars['info']->value['etat']!='2'&&$_smarty_tpl->tpl_vars['info']->value['isfaq']!='1') {?>
	<div class="well" id="formcom">
		<form method="post" id="commentaire">
			<textarea name="commentaire" class="form-control tiny"></textarea>
			<input type="submit" class="btn btn-lg btn-block btn-primary" value="Envoyer" />
		</form>
	</div>
	<?php }?>
	<div id="com"></div>

	<script>
		function etat()
			{
				$( "#etat" ).load("./templates/default/requete.php?action=etat&id=<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
");
			}
		setInterval(etat, 1000);
		function com()
			{
				$( "#com" ).load("./templates/default/requete.php?action=commentaire&id=<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
");
			}
		setInterval(com, 1000);
		$("#commentaire").submit(function () {
            tinyMCE.triggerSave();
            $.post("./templates/default/requete.php?action=commenter&id=<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
",$("#commentaire").serialize(),function(texte){
                $("div#resultcom").append(texte).slideDown("slow");
                $("div#resultcom").delay(4000).slideUp("slow");
                $(".alrt").delay(5000).hide("slow");
            });
            return false; // ne change pas de page
    	});
	</script>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("default/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
