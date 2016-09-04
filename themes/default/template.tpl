<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{block name="title"}{$config.site_name}{/block}</title>

		<link rel="icon" href="{$smarty.const.FOLDER}/themes/default/web/img/Supportme.png" />

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{$smarty.const.FOLDER}/themes/default/web/css/bootstrap-flat.min.css">
		<link rel="stylesheet" type="text/css" href="{$smarty.const.FOLDER}/themes/default/web/css/bootstrap-flat-extras.min.css">
		<link rel="stylesheet" type="text/css" href="{$smarty.const.FOLDER}/themes/default/web/css/style.css">

		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<a class="navbar-brand" href="{routes('home')}">{$config.site_name}</a>
				<ul class="nav navbar-nav">
					<li><a href="{routes('home')}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {$lang.navbar.home}</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					{if empty($logged)}
						<li class="dropdown">
							<a href="{routes('connexion')}" class="dropdown-toggle" data-toggle="dropdown"><b>{$lang.navbar.login}</b> <span class="caret"></span></a>
							<ul id="login-dp" class="dropdown-menu">
								<li>
									<div class="row">
										<div class="col-md-12">
											{$login->build()}
										</div>
										{if $config.register}
											<div class="bottom text-center">
												<a href="{routes('connexion')}">{$lang.navbar.register}</a>
											</div>
										{/if}
									</div>
								</li>
							</ul>
						</li>
					{else}
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								{if !empty($user_info.username)}
									{$user_info.username}
								{else}
									{$user_info.email}
								{/if}
								 <span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								{if $perm.access_admin}
									<li><a href="{routes('admin')}"><span class="glyphicon glyphicon-user"></span> Administration</a></li>
								{/if}
								<li><a href="{routes('logout')}?token={$token}"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> {$lang.navbar.logout}</a></li>
								
							</ul>
						</li>
					{/if}
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

		{block name="body"}{/block}
		
		{block name="footer"}
			<footer class="footer">
				<div class="container">
					<div class="pull-right">
						{$langs->build()}
					</div>
					<div class="text-center">{$lang.footer.propulsedBy}</div>
				</div>
			</footer>
		{/block}
		<!-- jQuery -->
		<script type="text/javascript" src="//code.jquery.com/jquery.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="{$smarty.const.FOLDER}/themes/default/web/js/jquery.tablesorter.min.js"></script>

		<script type="text/json" id="lang">{json_encode($lang)}</script>
		<script type="text/javascript" src="{$smarty.const.FOLDER}/themes/default/web/js/js.js"></script>
		<script type="text/javascript" src="{$smarty.const.FOLDER}/themes/default/web/js/ago.js"></script>
		{hook_action('javascript')}
	</body>
</html>