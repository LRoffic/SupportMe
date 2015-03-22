<?php /* Smarty version Smarty-3.1.17, created on 2014-04-28 04:18:47
         compiled from "./templates/menu.html" */ ?>
<?php /*%%SmartyHeaderCode:726237130535078eb6d8b97-54252608%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a7a51173f137397c12eb6d39f601f885ebcd976' => 
    array (
      0 => './templates/menu.html',
      1 => 1398651513,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '726237130535078eb6d8b97-54252608',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_535078eb712ac7_75328574',
  'variables' => 
  array (
    'config' => 0,
    'perm' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535078eb712ac7_75328574')) {function content_535078eb712ac7_75328574($_smarty_tpl) {?><!DOCTYPE HTML>
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
					<hr />
					<li><b><u>Configuration :</u></b></li>
					<li><a href="#">Configuration Générale</a></li>
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['modiftheme']=='1') {?>
						<li><a href="./theme.php">Thèmes</a></li>
					<?php }?>
					<li><a href="#">Configuration des Permissions</a></li>
					<hr />
					<li><b><u>Utilisateurs :</u></b></li>
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewuser']=='1') {?>
						<li><a href="#">Gérer les utilisateurs</a></li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewticket']=='1') {?>
						<li><a href="#">Gérer les tickets</a></li>
						<?php if ($_smarty_tpl->tpl_vars['perm']->value['lastresolved']=='1') {?>
							<li><a href="#">Gérer les tickets fermé</a></li>
						<?php }?>
					<?php }?>
				</ul>
			</div>
		</div><?php }} ?>
