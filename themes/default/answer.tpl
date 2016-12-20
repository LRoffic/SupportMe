{extends file="template.tpl"}
{block name="title" append} - {$lang.title.faq}{/block}
{block name="body"}
<div class="container">
	<ul class="nav nav-pills">
		<li><a href="{routes('FAQ')}"><i class="fa fa-reply"></i> {$lang.answer.backToFAQ}</a></li>
	</ul>
	<div class="well">
		<h3>
			{$answer.title}<br />
			<small>{$lang.answer.By} {autor($answer.autor)} {$lang.answer.On} {date($lang.config.dateformat ,$answer.datepost)}</small>
		</h3>
		{text_replace($answer.content)}
	</div>
</div>
{/block}