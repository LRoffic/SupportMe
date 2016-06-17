<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{block name="title"}{$config.site_name} - {/block}</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{$smarty.const._PATH_}themes/default/web/css/bootstrap-flat.min.css">
		<link rel="stylesheet" type="text/css" href="{$smarty.const._PATH_}themes/default/web/css/bootstrap-flat-extras.min.css">
		<link rel="stylesheet" type="text/css" href="{$smarty.const._PATH_}themes/default/web/css/style.css">

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
				<a class="navbar-brand" href="{routes('home')}">{$config.site_name}</a>
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>{$lang.navbar.login}</b> <span class="caret"></span></a>
					<ul id="login-dp" class="dropdown-menu">
						<li>
							<div class="row">
								<div class="col-md-12">
								 	<form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
										<div class="form-group">
											<label class="sr-only" for="exampleInputEmail2">{$lang.navbar.email}</label>
											<input type="email" class="form-control" id="exampleInputEmail2" placeholder="{$lang.navbar.email}" required>
										</div>
										<div class="form-group">
											<label class="sr-only" for="exampleInputPassword2">{$lang.navbar.password}</label>
											<input type="password" class="form-control" id="exampleInputPassword2" placeholder="{$lang.navbar.password}" required>
											<div class="help-block text-right"><a href="">{$lang.navbar.forget}</a></div>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary btn-block">{$lang.navbar.login}</button>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" checked> {$lang.navbar.keep}
											</label>
										</div>
									</form>
								</div>
								{if $config.register}
									<div class="bottom text-center">
										<a href="">{$lang.navbar.register}</a>
									</div>
								{/if}
							</div>
						</li>
					</ul>
				</li>
			</ul>
			</div>
		</nav>
		{block name="body"}{/block}
		
		{block name="footer"}
			<footer class="footer">
				<div class="container">
					<div class="pull-right">
						<form action="" method="POST" class="form-inline" role="form">
						
							<div class="form-group">
								<label>{$lang.footer.language}</label>
								<select class="form-control">
									<option>Français</option>
									<option>Anglais</option>
								</select>
							</div>
						
							
						
							<button type="submit" class="btn btn-default">Ok</button>
						</form>
					</div>
					<div class="text-center">{$lang.footer.propulsedBy}</div>
				</div>
			</footer>
		{/block}
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</body>
</html>