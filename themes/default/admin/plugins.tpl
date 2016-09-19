{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h3>{$lang.admin.plugin_list}</h3>
			<ul class="nav nav-pills">
				<li><a href="{routes('admin_plugin_market')}"><i class="fa fa-plus"></i> {$lang.admin.plugin_add}</a></li>
			</ul>
			{if !empty($plugins)}
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>{$lang.admin.plugin_name}</th>
							<th>{$lang.admin.plugin_description}</th>
							<th>{$lang.admin.plugin_version}</th>
							<th>{$lang.admin.plugin_author}</th>
							<th>{$lang.admin.plugin_option}</th>
						</tr>
					</thead>
					<tbody>
						{foreach from=$plugins item=plugin key=info}
							<tr>
								<td>{$plugin.name}</td>
								<td>{$plugin.description}</td>
								<td>{$plugin.version}</td>
								<td><a href="{$plugin.website_author}" target="_blank">{$plugin.author}</a></td>
								<td>
									{if !empty($plugin.website)}
										<a href="{$plugin.website}" target="_blank" class="btn btn-default">{$lang.admin.plugin_info}</a>
									{/if}
									{if !empty($plugin.settings)}
										<a href="{plugin({$info})}" class="btn btn-primary">{$lang.admin.plugin_config}</a>
									{/if}
									{if isUpToDate_plugin({$plugin.updateURL}, {$plugin.version})}
										<a href="?update={$info}&token={$token}" class="btn btn-info">{$lang.admin.plugin_update}</a>
									{/if}
									<a href="?remove={$info}&token={$token}" class="btn btn-danger">{$lang.admin.plugin_remove}</a>
								</td>
							</tr>
						{/foreach}
					</tbody>
				</table>
			{else}
				<div class="alert alert-info">
					{$lang.admin.noplugin}
				</div>
			{/if}
		</div>
	</div>
{/block}