{extends file="template.tpl"}
{block name="title" append} - {$lang.title.list}{/block}
{block name="body"}
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				{if !empty($Tickets)}
					<div class="text-right">
						<a href="{routes('home')}" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {$lang.list.back}</a>
						<a href="{routes('new')}" class="btn btn-info"><span class="fa fa-edit" aria-hidden="true"></span> {$lang.list.send}</a>
					</div><br />
					<div class="panel panel-default">
						<div class="panel-heading">{$lang.list.TicketList}</div>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>{$lang.list.id}</th>
									<th>{$lang.list.subject}</th>
									<th>{$lang.list.message}</th>
									<th>{$lang.list.date_receive}</th>
									<th>{$lang.list.date_last_action}</th>
									<th>{$lang.list.status}</th>
									<th>{$lang.list.attribute}</th>
									<th>{$lang.list.category}</th>
									<th>{$lang.list.option}</th>
								</tr>
							</thead>
							<tbody>
								{foreach from=$Tickets item=t}
									<tr>
										<td>{$t.id}</td>
										<td>{$t.subject|escape: "htmlall"}</td>
										<td>{text_replace(\utilphp\util::safe_truncate($t.message, 50))}</td>
										<td>{date($lang.config.dateformat, $t.date_receive)}</td>
										<td>{date($lang.config.dateformat, $t.date_last_action)}</td>
										<td>{getStatus($t.status_id)}</td>
										{assign var="attribute" value=User::getByID($t.attribute)}
										<td>{if !empty($attribute.username)}{$attribute.username|escape:'htmlall'}{else}{$lang.list.notAttribued}{/if}</td>
										<td>{getCategory($t.category_id)}</td>
										<td><a href="{getTicketURL($t.id)}" class="btn btn-default">{$lang.list.see}</a></td>
									</tr>
								{/foreach}
							</tbody>
						</table>
					</div>
				{else}
					<div class="text-center">
						<h2>{$lang.list.noTicket}</h2><br />
						<a href="{routes('home')}" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> {$lang.list.back}</a>
						<a href="{routes('new')}" class="btn btn-info"><span class="fa fa-edit" aria-hidden="true"></span> {$lang.list.send}</a>
					</div>
				{/if}
			</div>
		</div>
	</div>
{/block}