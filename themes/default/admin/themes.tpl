{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h3>{$lang.admin.theme_list}</h3>
			<ul class="nav nav-pills">
				<li><a href="http://supportme.dzv.me/themes" target="_blank"><i class="fa fa-plus"></i> {$lang.admin.theme_add}</a></li>
			</ul>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>{$lang.admin.theme_name}</th>
						<th>{$lang.admin.theme_author}</th>
						<th>{$lang.admin.theme_version}</th>
						<th>{$lang.admin.option}</th>
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
								{if $config.theme eq $item.folder}
									<a href="" class="btn btn-info disabled">{$lang.admin.theme_use}</a>
								{else}
									<a href="?use={$item.folder}&token={$token}" class="btn btn-info">{$lang.admin.theme_use}</a>
								{/if}
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}