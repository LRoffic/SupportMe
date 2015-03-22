<?php /* Smarty version Smarty-3.1.17, created on 2014-06-29 17:50:21
         compiled from ".\templates\menu.html" */ ?>
<?php /*%%SmartyHeaderCode:14885383b21881f6e3-46738038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b10cf0a9907ccf11a80e202b5908cf0626ec35c3' => 
    array (
      0 => '.\\templates\\menu.html',
      1 => 1404064140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14885383b21881f6e3-46738038',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_5383b21891dd72_37305914',
  'variables' => 
  array (
    'config' => 0,
    'link' => 0,
    'perm' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5383b21891dd72_37305914')) {function content_5383b21891dd72_37305914($_smarty_tpl) {?><!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Administration - <?php echo $_smarty_tpl->tpl_vars['config']->value['sitename'];?>
</title>

		<link rel="icon" href="../templates/default/img/Supportme.png" />

		<!--CSS-->
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.min.css">

		<!--JavaScript-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
		<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
		<script type="text/javascript" src="./js/javascript.js"></script>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="./connexion.php"><?php echo $_smarty_tpl->tpl_vars['config']->value['sitename'];?>
</a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<?php if (!empty($_smarty_tpl->tpl_vars['link']->value)) {?>
							<li class="dropdown">
				              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Autres liens <b class="caret"></b></a>
				              <ul class="dropdown-menu" role="menu">
				                <?php echo $_smarty_tpl->tpl_vars['link']->value;?>

				              </ul>
				            </li>
				            <?php }?>
							<li><a href="../index.php">Retour au support</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		
		<div class="col-md-2" style="text-align: center;">
			<div class="bs-docs-sidebar hidden-print affix">
				<ul class="nav bs-docs-sidenav">
					<li><b><u>Navigation :</u></b></li>
					<li><a href="./index.php">Accueil</a></li>
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['Categories']=='1') {?>
						<li><a href="./categorie.php">Gérer les catégories</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewticket']=='1') {?>
						<?php if ($_smarty_tpl->tpl_vars['perm']->value['lastresolved']=='1') {?>
							<li><a href="./resolved.php">Gérer les tickets fermé</a></li>
						<?php }?>
					<?php }?>
					<hr />
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['config']=="1"||$_smarty_tpl->tpl_vars['perm']->value['modiftheme']=='1') {?>
						<li><b><u>Configuration :</u></b></li>
							<?php if ($_smarty_tpl->tpl_vars['perm']->value['config']=="1") {?>
								<li><a href="./config.php">Configuration Générale</a></li>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['perm']->value['modiftheme']=='1') {?>
								<li><a href="./theme.php">Thèmes</a></li>
							<?php }?>
						<hr />
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewuser']=="1"||$_smarty_tpl->tpl_vars['perm']->value['modifPerms']=='1') {?>
						<li><b><u>Utilisateurs :</u></b></li>
						<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewuser']=='1') {?>
							<li><a href="./users.php">Gérer les utilisateurs</a></li>
						<?php }?>
						<?php if ($_smarty_tpl->tpl_vars['perm']->value['modifPerms']=='1') {?>
							<li><a href="./permissions.php">Gérer les Permissions</a></li>
						<?php }?>
					<?php }?>
				</ul>
			</div>
		</div><?php }} ?>
