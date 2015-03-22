<?php /* Smarty version Smarty-3.1.17, created on 2014-05-28 01:10:37
         compiled from ".\templates\connexion.html" */ ?>
<?php /*%%SmartyHeaderCode:5144534cc12e0439d3-98983462%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e32e1c9add7bbef848163fc84709c59f70358d0d' => 
    array (
      0 => '.\\templates\\connexion.html',
      1 => 1397774938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5144534cc12e0439d3-98983462',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_534cc12e1bfda6_59021959',
  'variables' => 
  array (
    'config' => 0,
    'erreur' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_534cc12e1bfda6_59021959')) {function content_534cc12e1bfda6_59021959($_smarty_tpl) {?><!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Connexion</title>

		<link rel="icon" href="../templates/default/img/Supportme.png" />

		<!--CSS-->
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="./css/bootstrap-theme.min.css">

		<!--JavaScript-->
		<script type="text/javascript" src="./js/bootstrap.min.js"></script>
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
							<li><a href="../index.php">Retour au site</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<div class="container">
			<div class="col-md-4 col-md-offset-4">
				<?php if (isset($_smarty_tpl->tpl_vars['erreur']->value)) {?>
					<?php if ($_smarty_tpl->tpl_vars['erreur']->value=='noaccess') {?>
						<div class="alert alert-danger">
							<b>Erreur :</b> Vous n'avez pas la permission d'accèder à l'administration
						</div>
					<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='badpass') {?>
						<div class="alert alert-danger">
							<b>Erreur :</b> Mot de passe incorrect !
						</div>
					<?php } elseif ($_smarty_tpl->tpl_vars['erreur']->value=='notexist') {?>
						<div class="alert alert-danger">
							<b>Erreur :</b> Le compte n'existe pas !
						</div>
					<?php }?>
				<?php }?>
				<div class="well">
					<h2>Connexion</h2>
					<hr />
					<form method="post" role="form">
						<div class="form-group">
							<label>Pseudo ou Email :</label>
							<input type="text" name="pseudo" required="true" class="form-control" />
						</div>
						<div class="form-group">
							<label>Mot de passe :</label>
							<input type="password" name="password" required="true" class="form-control" />
						</div>
						<input type="submit" value="Connexion" class="btn btn-primary btn-lg btn-block" />
					</form>
				</div>
			</div>
		</div>
		<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
