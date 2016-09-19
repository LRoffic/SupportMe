{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>{$lang.admin.theme_name}</th>
						<th>{$lang.admin.theme_author}</th>
						<th>{$lang.admin.theme_version}</th>
						<th>{$lang.admin.theme_option}</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$listfiles item=item key=key}
						<tr>
							<td>{$item.name}</td>
							<td><a href="{$item.author_site}" target="_blank">{$item.author}</a></td>
							<td>{$item.version}</td>
							<td>
								{if !empty($item.theme_site)}
									<a href="{$item.theme_site}" class="btn btn-default" target="_blank">{$lang.admin.theme_info}</a>
								{/if}
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}