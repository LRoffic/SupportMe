{extends file="template.tpl"}
{block name="title" append} - {$lang.title.newTicket}{/block}
{block name="body"}
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="well">
					<h3>{$lang.newTicket.newTicket}</h3><hr />
					{$newTicket->build()}
				</div>
			</div>
		</div>
	</div>
{/block}