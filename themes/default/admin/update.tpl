{extends file="admin/template.tpl"}

{block name="title" append} - {$lang.title.update}{/block}

{block name="body"}
	<div class="container">
		{if !empty($update)}
			{if $update eq "true"}
				<div class="alert alert-success">
					{$lang.update.Success}
				</div>
			{else}
				<div class="alert alert-danger">
					{$lang.update.Failed}
				</div>
				<h1>{$lang.update.log}</h1>
				<div class="well">
					{$log}
				</div>
			{/if}
		{/if}
		{if !empty($upToDate)}
			<div class="alert alert-success">
				{$lang.update.upToDate}
			</div>
		{/if}
		{if $smarty.const.DEBUG_MODE}
			{if empty($update)}
				<h1>{$lang.update.log}</h1>
				<div class="well">
					{$log}
				</div>
			{/if}
		{/if}
	</div>
{/block}