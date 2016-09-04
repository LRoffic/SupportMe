{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<div class="pull-right">
				<a href="">
					<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
				</a> {$lang.admin.LastRefresh} <span class="date update" data-ago="{time()}">{date('H:m:s', time())}</span>
			</div>
			<div class="text-left"><h3>{$lang.admin.TicketList}</h3></div>
			<table class="table table-hover table-striped table-responive table-condensed sorter">
				<thead>
					<tr>
						<th>{$lang.admin.id}</th>
						<th>{$lang.admin.author}</th>
						<th>{$lang.admin.subject}</th>
						<th>{$lang.admin.resume}</th>
						<th>{$lang.admin.date_receive}</th>
						<th>{$lang.admin.date_last_action}</th>
						<th>{$lang.admin.status}</th>
						<th>{$lang.admin.category}</th>
						<th>{$lang.admin.attribute}</th>
						<th>{$lang.admin.option}</th>
					</tr>
				</thead>
				<tbody>
					{if !empty($tickets)}
						{foreach from=$tickets item=ticket}
							{assign var="status" value=getStatus($ticket.status_id)}
							{assign var="attribute" value=User::getByID($ticket.attribute)}
							{assign var="author" value=User::getByID($ticket.autor)}
							{if $match eq "admin" && !$status.close || $match eq "admin_close_ticket" && $status.close}
								<tr class="ticket" id="{$ticket.id}">
									<td>{$ticket.id}</td>
									<td>{if !empty($author.username)}{$author.username|escape:"htmlall"}{else}{$author.email|escape:"htmlall"}{/if}</td>
									<td>{$ticket.subject|escape:"htmlall"}</td>
									<td>{text_replace(\utilphp\util::safe_truncate($ticket.message, 50))}</td>
									<td><span class="date" data-ago="{$ticket.date_receive}">{date($lang.config.dateformat, $ticket.date_receive)}</span></td>
									<td><span class="date" data-ago="{$ticket.date_last_action}">{date($lang.config.dateformat, $ticket.date_last_action)}</span></td>
									<td>{$status.name}</td>
									<td>{getCategory($ticket.category_id)}</td>
									<td>{if !empty($attribute.username)}{$attribute.username|escape:'htmlall'}{else}{$lang.list.notAttribued}{/if}</td>
									<td><a href="{getTicketURL($ticket.id)}" class="btn btn-default">Voir</a></td>
								</tr>
							{/if}
						{/foreach}
					{else}
						<div class="text-center">{$lang.admin.noTicket}</div>
					{/if}
				</tbody>
			</table>
		</div>
	</div>
{/block}