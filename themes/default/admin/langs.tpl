{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h3>{$lang.admin.lang_list}</h3>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>{$lang.admin.lang_name}</th>
						<th>{$lang.admin.lang_local}</th>
						<th>{$lang.admin.lang_version}</th>
						<th>{$lang.admin.option}</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$languages item=langs}
						<tr>
							<td>{$langs.name}</td>
							<td>{$langs.filename}</td>
							<td>{$langs.version}</td>
							<td>
								{if $config.lang neq $langs.filename}
									<a href="?use={$langs.filename}&token={$token}" class="btn btn-default">{$lang.admin.lang_use}</a>
								{else}
									<a href="" class="btn btn-default disabled">{$lang.admin.lang_use}</a>
								{/if}
								{if $langs.filename neq $smarty.const.default_language}
									<a href="?remove={$langs.filename}&token={$token}" class="btn btn-danger">{$lang.admin.lang_remove}</a>
								{else}
									<a href="" class="btn btn-danger disabled">{$lang.admin.lang_remove}</a>
								{/if}
								{if in_array($langs.filename, $needUpdate)}<a href="?update={$langs.filename}&token={$token}" class="btn btn-info">{$lang.admin.lang_update}</a>{/if}
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}