{extends file="template.tpl"}
{block name="title" append} - {$lang.title.connexion}{/block}
{block name="body"}
	<div class="container">
		<div class="row">
			{if $config.register}
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="well">
						<h1>{$lang.connexion.register}</h1>
						{$register->build()}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="well">
						<h1>{$lang.connexion.connexion}</h1>
						{$login->form}
					</div>
				</div>
			{else}
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="well">
						<h1>{$lang.connexion.connexion}</h1>
						{$login->form}
					</div>
				</div>
			{/if}
		</div>
	</div>
{/block}