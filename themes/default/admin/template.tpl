<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{block name="title"}Administration{/block}</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{$smarty.const.FOLDER}/themes/default/web/css/bootstrap-flat.min.css">
		<link rel="stylesheet" type="text/css" href="{$smarty.const.FOLDER}/themes/default/web/css/bootstrap-flat-extras.min.css">
		<link rel="stylesheet" type="text/css" href="{$smarty.const.FOLDER}/themes/default/web/css/style.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<a class="navbar-brand" href="{routes('admin')}">{$config.site_name}</a>
				<ul class="nav navbar-nav">
					<li><a href="{routes('admin')}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {$lang.navbar.home}</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{routes('home')}"><span class="glyphicon glyphicon-road" aria-hidden="true"></span> {$lang.navbar.BackToHome}</a></li>
				</ul>
			</div>
		</nav>

		{if !empty($error)}
			<div class="container">
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{$error}
				</div>
			</div>
		{/if}

		{if !empty($newUpdate)}
			<div class="container">
				<div class="alert alert-info text-center">
					{$lang.admin.NewVersionAvailable}
					<span class="text-right">
						<a href="{routes('update')}" class="btn btn-info"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> {$lang.admin.update}</a>
					</span>
				</div>
			</div>
		{/if}

		{block name="body"}{/block}

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="{$smarty.const.FOLDER}/themes/default/web/js/jquery.tablesorter.min.js"></script>

		<script type="text/json" id="lang">{json_encode($lang)}</script>
		<script type="text/javascript" src="{$smarty.const.FOLDER}/themes/default/web/js/js.js"></script>
		<script type="text/javascript" src="{$smarty.const.FOLDER}/themes/default/web/js/ago.js"></script>
		{hook_action('javascript')}
	</body>
</html>