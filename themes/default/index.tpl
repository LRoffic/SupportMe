{extends file="template.tpl"}
{block name="title" append} - {$lang.title.home}{/block}
{block name="body"}
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<a href="{routes('new')}" class="homeLink">
				<div class="well">
					<h1><u>{$lang.home.newTicket}</u></h1>
					<div class="text-center">
						<img src="{$smarty.const._FOLDER_}themes/default/web/img/new.jpg" alt="New ticket" height="150px">
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<a href="{routes('list')}" class="homeLink">
				<div class="well">
					<h1><u>{$lang.home.viewTicket}</u></h1>
					<div class="text-center">
						<img src="{$smarty.const._FOLDER_}themes/default/web/img/ticket.png" alt="New ticket" height="150px">
					</div>
				</div>
			</a>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<a href="" class="homeLink">
				<div class="well">
					<h1><u>{$lang.home.Faq}</u></h1>
					<div class="text-center">
						<img src="{$smarty.const._FOLDER_}themes/default/web/img/faq.png" alt="FAQ" height="150px">
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
{/block}