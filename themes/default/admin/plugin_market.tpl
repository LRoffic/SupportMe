{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<span class="pull-right nodisplay">
				<input type="text" class="form-control" id="search" placeholder="{$lang.admin.plugin_search}">
			</span>
			<ul class="nav nav-pills">
				<li><a href="{routes('admin_plugins')}"><i class="fa fa-reply"></i> {$lang.admin.plugin_back_to_plugin}</a></li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">
						{$lang.admin.plugin_market}
					</h2>
				</div>
				{if empty($market_plugins)}
					<div class="panel-body">
						<div class="text-center">
							<h4>{$lang.admin.noplugin}</h4>
						</div>
					</div>
				{else}
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>{$lang.admin.plugin_name}</th>
								<th>{$lang.admin.plugin_description}</th>
								<th>{$lang.admin.plugin_author}</th>
								<th>{$lang.admin.plugin_option}</th>
							</tr>
						</thead>
						<tbody>
							{foreach from=$market_plugins item=plugin key=key}
								<tr class="plugins" data-name="{$plugin.name|escape:'htmlall'}" data-desc="{$plugin.description|escape:"htmlall"}">
									<td>{$plugin.name|escape:"htmlall"}</td>
									<td>{$plugin.description|escape:"htmlall"}</td>
									<td><a href="{$plugin.website_author}" target="_blank">{$plugin.author|escape:"htmlall"}</a></td>
									<td>
										{if !empty($plugin.website)}
											<a href="{$plugin.website}" class="btn btn-info" target="_blank">{$lang.admin.plugin_info}</a>
										{/if}
										{if verif_installed_plugin($plugin.downloadURL)}
											<a href="?install={$key}&token={$token}" class="btn btn-primary">{$lang.admin.plugin_install}</a>
										{else}
											<button class="btn btn-primary disabled">{$lang.admin.plugin_install}</button>
										{/if}
									</td>
								</tr>
							{/foreach}
						</tbody>
					</table>
				{/if}
				</div>
			</div>
		</div>
	</div>
{/block}