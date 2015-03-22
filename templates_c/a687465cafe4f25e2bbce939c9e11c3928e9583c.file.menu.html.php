<?php /* Smarty version Smarty-3.1.17, created on 2014-07-08 05:36:02
         compiled from ".\templates\default\menu.html" */ ?>
<?php /*%%SmartyHeaderCode:278153305c008a61d4-50490211%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a687465cafe4f25e2bbce939c9e11c3928e9583c' => 
    array (
      0 => '.\\templates\\default\\menu.html',
      1 => 1404593941,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '278153305c008a61d4-50490211',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.17',
  'unifunc' => 'content_53305c00984af7_17013795',
  'variables' => 
  array (
    'page' => 0,
    'sitename' => 0,
    'isconnect' => 0,
    'nbticket' => 0,
    'siteconfig' => 0,
    'perm' => 0,
    'nbfaq' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53305c00984af7_17013795')) {function content_53305c00984af7_17013795($_smarty_tpl) {?><!DOCTYPE HTML>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title><?php if (!empty($_smarty_tpl->tpl_vars['page']->value)) {?><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['sitename']->value)) {?><?php if (!empty($_smarty_tpl->tpl_vars['page']->value)) {?>-<?php }?> <?php echo $_smarty_tpl->tpl_vars['sitename']->value;?>
<?php }?></title>

		<link rel="icon" href="./templates/default/img/Supportme.png" />

		<!--CSS-->
		<link rel="stylesheet" type="text/css" href="./templates/default/css/style.css">
		<link rel="stylesheet" type="text/css" href="./templates/default/css/design.css">

		<!--JavaScript-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script type="text/javascript" src="./templates/default/js/bootstrap.js"></script>
		<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
		<script type="text/javascript" src="./templates/default/js/javascript.js"></script>
	</head>

	<body>
		<header>
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		    	<div class="container">
			        <div clas="col-md-offset-2">
			          <div class="navbar-header">
			            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			              <span class="sr-only">Toggle navigation</span>
			              <span class="icon-bar"></span>
			              <span class="icon-bar"></span>
			              <span class="icon-bar"></span>
			            </button>
			            <a class="navbar-brand" href="./index.php"><?php if (isset($_smarty_tpl->tpl_vars['sitename']->value)) {?><?php echo $_smarty_tpl->tpl_vars['sitename']->value;?>
<?php } else { ?>Support<?php }?></a>
			          </div>
			        </div>
			        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	          			<ul class="nav navbar-nav">
	            			<li <?php if (empty($_smarty_tpl->tpl_vars['page']->value)) {?>class="active"<?php }?>><a href="./index.php"><i class="glyphicon glyphicon-home"></i> Accueil</a></li>
	            			<?php if (isset($_smarty_tpl->tpl_vars['isconnect']->value)&&$_smarty_tpl->tpl_vars['isconnect']->value=='true') {?>
	            				<?php if (isset($_smarty_tpl->tpl_vars['nbticket']->value)&&$_smarty_tpl->tpl_vars['nbticket']->value>0) {?>
	            					<li <?php if (isset($_smarty_tpl->tpl_vars['page']->value)&&$_smarty_tpl->tpl_vars['page']->value=='Liste des tickets') {?>class="active"<?php }?>>
	            						<a href="./view.php">
	            							<i class="glyphicon glyphicon-comment"></i> Ticket 
	            							<span class="label label-danger"><?php echo $_smarty_tpl->tpl_vars['nbticket']->value;?>
</span>
	            						</a>
	            					</li>
	            				<?php }?>
	            			<?php }?>
	            			<?php if ($_smarty_tpl->tpl_vars['siteconfig']->value['faq']=='e'&&$_smarty_tpl->tpl_vars['perm']->value['viewfaq']=='1') {?>
								<?php if ($_smarty_tpl->tpl_vars['nbfaq']->value>'0') {?>
	            					<li <?php if (isset($_smarty_tpl->tpl_vars['page']->value)&&$_smarty_tpl->tpl_vars['page']->value=="FAQ's") {?>class="active"<?php }?>>
	            						<a href="./faq.php">
	            							<i class="glyphicon glyphicon-info-sign"></i> FAQ
	            						</a>
	            					</li>
	            				<?php }?>
	            			<?php }?>
	            		</ul>
	            		<ul class="nav navbar-nav navbar-right">
	            			<?php if ($_smarty_tpl->tpl_vars['perm']->value['viewLinkAdmin']=='1') {?>
	            				<li><a href="./admin/"><i class="glyphicon glyphicon-cog"></i> Administration</a></li>
	            			<?php }?>
	            			<?php if (isset($_smarty_tpl->tpl_vars['isconnect']->value)&&$_smarty_tpl->tpl_vars['isconnect']->value=='true') {?>
	            				<li><a href="#" onclick="deconnexion('<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
');"><i class="glyphicon glyphicon-off"></i> Déconnexion</a></li>
	            			<?php }?>
	            		</ul>
	            	</div>
            	</div>
			</nav>
		</header>
		<div id="result"></div>
		<div style="padding: 30px;"></div>
		<noscript>
			<div class="alert alert-danger">
				Le javascript est désactivé sur votre navigateur, nous vous invitons à l'activé afin de pouvoir envoyé les formulaires et effectué des actions sur notre site. Rien d'abusif ne seras affiché.
			</div>
		</noscript><?php }} ?>
