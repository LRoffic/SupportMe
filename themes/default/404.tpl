{extends file="template.tpl"}
{block name="title" append} - {$lang.title.404}{/block}
{block name="body"}
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h1 class="text-center">{$lang.404.notfound}</h1>
			</div>
		</div>
	</div>
{/block}