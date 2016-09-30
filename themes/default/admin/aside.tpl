<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
	<div class="list-group">
		<a href="{routes('admin')}" class="list-group-item {if  $match eq 'admin'}active{/if}"><i class="fa fa-home"></i> {$lang.admin.home}</a>
		<a href="{routes('admin_close_ticket')}" class="list-group-item {if  $match eq 'admin_close_ticket'}active{/if}"><i class="fa fa-eye-slash"></i> {$lang.admin.closed_ticket}</a>
		<a href="" class="list-group-item"><i class="fa fa-question"></i> {$lang.admin.faq}</a>
		<a href="" class="list-group-item"><i class="fa fa-users"></i> {$lang.admin.users}</a>
	</div>
	<div class="list-group">
		<a href="{routes('update')}" class="list-group-item {if  $match eq 'update'}active{/if}"><i class="fa fa-refresh"></i> {$lang.admin.aside_update}</a>
		{if $perm.plugin_gestion}
			<a href="{routes('admin_plugins')}" class="list-group-item {if  $match eq 'admin_plugins' || $match eq 'admin_plugin_market' || $match eq 'admin_plugin_settings'}active{/if}"><i class="fa fa-puzzle-piece"></i> {$lang.admin.plugins}</a>
		{/if}
		{if $perm.theme_gestion}
			<a href="{routes('admin_themes')}" class="list-group-item {if  $match eq 'admin_themes'}active{/if}"><i class="fa fa-paint-brush"></i> {$lang.admin.theme}</a>
		{/if}
		{if $perm.lang_gestion}
			<a href="{routes('admin_langs')}" class="list-group-item {if  $match eq 'admin_langs'}active{/if}"><i class="fa fa-flag"></i> {$lang.admin.language}</a>
		{/if}
		{if $perm.config_gestion}
			<a href="{routes('admin_config')}" class="list-group-item {if  $match eq 'admin_config'}active{/if}"><i class="fa fa-cog"></i> {$lang.admin.config}</a>
		{/if}
	</div>
</div>