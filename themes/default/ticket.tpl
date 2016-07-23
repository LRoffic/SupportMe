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
						<b>{$lang.ticket.attribute}</b> #<br />
						<b>{$lang.ticket.category}</b> {getCategory($ticket.category_id)}<br />
						<b>{$lang.ticket.date_receive}</b> {date('d/m/Y H:i', $ticket.date_receive)}<br />
						<b>{$lang.ticket.date_last_action}</b> <span id="ticketLastAction">{date('d/m/Y H:i', $ticket.date_last_action)}</span><br />
						{hook_action('ticket_info')}
						<b>{$lang.ticket.message}</b>
					</p>
					<div class="well">
						<p>{$ticket.message|escape:'htmlall'}</p>
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
				<div class="well">
					<h3>{$lang.ticket.addComment}</h3>
					{$comment->build()}
				</div>
				<h3>{$lang.ticket.comment}</h3>
				<div class="comments">
					
				</div>
			</div>
		</div>
	</div>
{/block}