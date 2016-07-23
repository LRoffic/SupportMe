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
					</div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>{$lang.list.id}</th>
								<th>{$lang.list.subject}</th>
								<th>{$lang.list.message}</th>
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
									<td>{\utilphp\util::safe_truncate($t.message, 50)|escape:"htmlall"}</td>
									<td>{getStatus($t.status_id)}</td>
									<td>#</td>
									<td>{getCategory($t.category_id)}</td>
									<td><a href="{getTicketURL($t.id)}" class="btn btn-default">{$lang.list.see}</a></td>
								</tr>
							{/foreach}
						</tbody>
					</table>
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