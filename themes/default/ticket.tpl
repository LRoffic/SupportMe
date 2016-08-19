{extends file="template.tpl"}
{block name="title" append} - {$ticket.subject|escape:'htmlall'}{/block}
{block name="body"}
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				{if $createTicket}
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{$lang.ticket.createSuccess}
					</div>
				{/if}
				<div class="well">
					<h2>{$ticket.subject|escape:'htmlall'}</h2>
					<p>
						<b>{$lang.ticket.status}</b> <span id="ticketStatus">{getStatus($ticket.status_id)}</span><br />
						{assign var="attribute" value=User::getByID($ticket.attribute)}
						<b>{$lang.ticket.attribute}</b> {if !empty($attribute.username)}{$attribute.username|escape:'htmlall'}{else}{$lang.ticket.notAttribued}{/if}<br />
						<b>{$lang.ticket.category}</b> {getCategory($ticket.category_id)}<br />
						<b>{$lang.ticket.date_receive}</b> {date($lang.config.dateformat, $ticket.date_receive)}<br />
						<b>{$lang.ticket.date_last_action}</b> <span id="ticketLastAction">{date('d/m/Y H:i', $ticket.date_last_action)}</span><br />
						{hook_action('ticket_info')}
						<b>{$lang.ticket.message}</b>
					</p>
					<div class="well">
						<p>{text_replace($ticket.message)}</p>
					</div>
					<div class="text-right">
						<a href="{routes('list')}" class="btn btn-default">
							<span class="glyphicon glyphicon-list" aria-hidden="true"></span> {$lang.ticket.backToList}
						</a>
						{if $ticket.status_id neq "3"}
							<a href="#" class="btn btn-info">
								<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> {$lang.ticket.close}
							</a>
						{/if}
					</div>
				</div>
				{if !empty($retour)}
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{$retour}
					</div>
				{/if}
				<div class="well">
					<h3>{$lang.ticket.addComment}</h3>
					{$comment->build()}
				</div>
				<h3>{$lang.ticket.comment}</h3>
				<div class="comments">
					{if empty($getComments)}
						<p class="text-center">{$lang.ticket.noComment}</p>
					{else}
						{foreach from=$getComments item=com}
							{assign var="autor" value=User::getByID($com.autor_id)}
							<div class="well">
								<h4>
									{if $autor.id eq $user_info.id}
										<img src="{$user_info.avatar}?s=50"> {$lang.ticket.you},
									{else}
										<img src="https://www.gravatar.com/avatar/{md5(strtolower(trim($autor.email)))}?s=50"> {$autor.username},
									{/if} 
									<span class="date" data-ago="{$com.date_reply}">{$lang.ticket.sendon} {date($lang.config.dateformat, $com.date_reply)}</span>
								</h4>
								<div class="well">
									{$com.comment}
								</div>
							</div>
						{/foreach}
					{/if}
				</div>
			</div>
		</div>
	</div>
{/block}