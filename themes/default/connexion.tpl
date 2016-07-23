{extends file="template.tpl"}
{block name="title" append} - {$lang.title.connexion}{/block}
{block name="body"}
	<div class="container">
		<div class="row">
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
		</div>
	</div>
{/block}