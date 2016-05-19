{extends file="template.tpl"}
{block name="title" append}{$lang.title.home}{/block}
{block name="body"}
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="well">
				<h1><u>{$lang.home.newTicket}</u></h1>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="well">
				<h1><u>{$lang.home.viewTicket}</u></h1>
			</div>
		</div>
	</div>
</div>
{/block}