{extends file="template.tpl"}
{block name="title" append} - {$lang.title.faq}{/block}
{block name="body"}
<div class="container">
	<h1>{$lang.faq.FAQ}</h1>
</div>
{if !empty($articles)}
	{assign var=i value=0}
	{assign var="previous" value=null}
	<div class="container">
	{foreach from=$articles item=article}
		{if $previous neq $article.category_id}
			{if $previous neq null}
				</ul></div></div>
			{/if}
			{if $i++ eq 3}
				</div><div class="container">
				{assign var=i value=1}
			{/if}
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="well">
					{assign var=i value=$i++}
					<h3>{$article.name|escape: "htmlall"}</h3>
					<ul>
					{assign var="previous" value=$article.category_id}
		{/if}
			<li><a href="{answer($article.id, \utilphp\util::slugify($article.title))}">{$article.title|escape:"htmlall"}</a></li>
	{/foreach}
			</ul>
		</div>
	</div></div>
{else}
	<div class="alert alert-info">
		{$lang.faq.nofaq}
	</div>
{/if}
{/block}