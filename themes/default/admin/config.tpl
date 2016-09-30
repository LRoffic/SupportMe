{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h1>{$lang.admin.config}</h1>
			<div class="well">
				{$form->build()}
			</div>
		</div>
	</div>
{/block}