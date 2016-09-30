{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h3>{$lang.admin.plugin_setting_of} {$plugin.name|escape:'htmlall'}</h3>
			<ul class="nav nav-pills">
				<li><a href="{routes('admin_plugins')}"><i class="fa fa-reply"></i> {$lang.admin.plugin_back_to_plugin}</a></li>
			</ul>
			{if !empty($retour)}
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{$lang.admin.plugin_update_success}
				</div>
			{/if}
			{$setting_form->build()}
			{hook_action($plugin.name)}
		</div>
	</div>
{/block}