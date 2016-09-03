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
						{assign var="status" value=getStatus($ticket.status_id)}
						<b>{$lang.ticket.status}</b> <span id="ticketStatus">{$status.name}</span><br />
						{assign var="attribute" value=User::getByID($ticket.attribute)}
						<b>{$lang.ticket.attribute}</b> {if !empty($attribute.username)}{$attribute.username|escape:'htmlall'}{else}{$lang.ticket.notAttribued}{/if}<br />
						<b>{$lang.ticket.category}</b> {getCategory($ticket.category_id)}<br />
						<b>{$lang.ticket.date_receive}</b> <span class="date" data-ago="{$ticket.date_receive}">{date($lang.config.dateformat, $ticket.date_receive)}</span><br />
						<b>{$lang.ticket.date_last_action}</b> <span class="date LastAction" data-ago="{$ticket.date_last_action}">{date($lang.config.dateformat, $ticket.date_last_action)}</span><br />
						{hook_action('ticket_info')}
						<b>{$lang.ticket.message}</b>
					</p>
					<div class="well">
						<p>{text_replace($ticket.message)}</p>
					</div>
					<div class="pull-right">
						<a href="{routes('list')}" class="btn btn-default">
							<span class="glyphicon glyphicon-list" aria-hidden="true"></span> {$lang.ticket.backToList}
						</a>
					</div>
					<div class="text-left">
						{if !$status.close || $perm.reopen_ticket}
							{assign var="AllStatus" value=getStatusArray()}
							<form action="" method="POST" class="form-inline">
								<label>{$lang.ticket.updateStatus}</label>
								<select name="newstatus" class="form-control">
									<option value="{$ticket.status_id}">{$status.name}</option>
									{assign var="i" value=0}
									{foreach from=$AllStatus item=OptionStatus}
										{if $i neq $ticket.status_id}
											<option value="{$i}">{$OptionStatus.name}</option>
										{/if}
										{$i++}
									{/foreach}
								</select>
								<input type="submit" class="btn btn-info" value="{$lang.ticket.Send}">
							</form>
						{/if}
					</div>
				</div>
				{if !empty($retour)}
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{$retour}
					</div>
				{/if}
				{if !$status.close || $perm.comment_closed_ticket}
					<div class="well">
						<h3>{$lang.ticket.addComment}</h3>
						{$comment->build()}
					</div>
				{/if}
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