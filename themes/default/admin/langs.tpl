{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
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
					{foreach from=$langages item=langs}
						<tr>
							<td>{$langs.name}</td>
							<td>{$langs.filename}</td>
							<td>{$langs.version}</td>
							<td>
								{if $config.lang neq $langs.filename}<a href="?use={$langs.filename}&token={$token}" class="btn btn-default">use</a>{else}<a href="" class="btn btn-default disabled">use</a>{/if}
								{if $langs.filename neq 'fr_FR'}<a href="?remove={$langs.filename}&token={$token}" class="btn btn-danger">remove</a>{/if}
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}