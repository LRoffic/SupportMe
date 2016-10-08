{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h1>{$lang.admin.users_list}</h1>
			<ul class="nav nav-pills">
				<li><a href="#"><i class="fa fa-cog"></i> {$lang.admin.update_permissions}</a></li>
			</ul>
			<h3>{$lang.admin.register_users}</h3>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>{$lang.admin.users_username}</th>
						<th>{$lang.admin.users_email}</th>
						<th>{$lang.admin.users_rank}</th>
						<th>{$lang.admin.users_ip}</th>
						<th>{$lang.admin.users_last_active}</th>
						<th>{$lang.admin.users_options}</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$users item=user}
						{if !empty($user.username)}
							<tr>
								<td>{$user.id}</td>
								<td>{$user.username|escape:'hmlall'}</td>
								<td>{$user.email|escape:'hmlall'}</td>
								<td>{getRangName($user.rank)} ({$user.rank})</td>
								<td>{$user.ip|escape:'htmlall'}</td>
								<td>{if !empty($user.last_active)}{date({$lang.config.dateformat}, {$user.last_active})}{else}{$lang.admin.never}{/if}</td>
								<td>
									<a href="#user-{$user.id}" class="btn btn-default" data-toggle="modal">{$lang.admin.users_update_rank}</a>
									{if $user.id neq '1'}
										<a href="?delete={$user.id}&token={$token}" class="btn btn-danger">{$lang.admin.users_delete}</a>
									{/if}
								</td>
							</tr>
							<div class="modal fade" id="user-{$user.id}">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">{$lang.admin.users_update_rank}</h4>
										</div>
										<div class="modal-body">
											<form action="?update={$user.id}" method="post">
												<select name="rang" class="form-control">
													<option value="">{getRangName($user.rank)}</option>
													{foreach from=$rangs item=rang}
														{if $user.rank neq $rang.id}
															<option value="{$rang.id}">{$rang.name}</option>
														{/if}
													{/foreach}

													<input type="submit" class="btn btn-primary btn-block btn-lg" value="{$lang.admin.rank_valid}">
												</select>
											</form>
										</div>
									</div>
								</div>
							</div>
						{/if}
					{/foreach}
				</tbody>
			</table>
			<h3>{$lang.admin.unregistered_users}</h3>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>{$lang.admin.users_email}</th>
						<th>{$lang.admin.users_rank}</th>
						<th>{$lang.admin.users_ip}</th>
						<th>{$lang.admin.users_last_active}</th>
						<th>{$lang.admin.users_options}</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$users item=user}
						{if empty($user.username)}
							<tr>
								<td>{$user.id}</td>
								<td>{$user.email|escape:'hmlall'}</td>
								<td>{getRangName($user.rank)} ({$user.rank})</td>
								<td>{$user.ip|escape:'htmlall'}</td>
								<td>{if !empty($user.last_active)}{date({$lang.config.dateformat}, {$user.last_active})}{else}{$lang.admin.never}{/if}</td>
								<td>
									<a href="#user-{$user.id}" class="btn btn-default" data-toggle="modal">{$lang.admin.users_update_rank}</a>
									{if $user.id neq '1'}
										<a href="?delete={$user.id}&token={$token}" class="btn btn-danger">{$lang.admin.users_delete}</a>
									{/if}
								</td>
							</tr>
							<div class="modal fade" id="user-{$user.id}">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											<h4 class="modal-title">{$lang.admin.users_update_rank}</h4>
										</div>
										<div class="modal-body">
											<form action="?update={$user.id}" method="post">
												<select name="rang" class="form-control">
													<option value="">{getRangName($user.rank)}</option>
													{foreach from=$rangs item=rang}
														{if $user.rank neq $rang.id}
															<option value="{$rang.id}">{$rang.name}</option>
														{/if}
													{/foreach}

													<input type="submit" class="btn btn-primary btn-block btn-lg" value="{$lang.admin.rank_valid}">
												</select>
											</form>
										</div>
									</div>
								</div>
							</div>
						{/if}
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}