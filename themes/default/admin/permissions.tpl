{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h3>{$lang.admin.permissions_gestion}</h3>
			{if !empty($error)}
				{if $error eq 'update'}
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						{$lang.error.permission_update}
					</div>
				{/if}
			{/if}
			<ul class="nav nav-pills">
				<li><a href="#add-permission" data-toggle="modal"><i class="fa fa-plus"></i> {$lang.admin.add_permission}</a></li>
			</ul>
			<div class="modal fade" id="add-permission">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">{$lang.admin.add_permission}</h4>
						</div>
						<div class="modal-body">
							{$new->build()}
						</div>
					</div>
				</div>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>{$lang.admin.permission_name}</th>
						<th>{$lang.admin.admin_access}</th>
						<th>{$lang.admin.option}</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$rangs item=rang}
						<tr>
							<td>{$rang.id}</td>
							<td>{$rang.name}</td>
							<td>
								{if $rang.access_admin eq "1"}
									<span class="label label-success">{$lang.admin.yes}</span>
								{else}
									<span class="label label-danger">{$lang.admin.no}</span>
								{/if}
							</td>
							<td>
								<a class="btn btn-primary" data-toggle="modal" href='#info-{$rang.id}'>{$lang.admin.more_info}</a>
								<div class="modal fade" id="info-{$rang.id}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">{$rang.name|upper}</h4>
											</div>
											<div class="modal-body">
												<b>{$lang.admin.admin_access}</b>
												{if $rang.access_admin eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span><br />
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.view_all_ticket}</b>
												{if $rang.view_all_ticket eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.reopen_ticket}</b>
												{if $rang.reopen_ticket eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.comment_closed_ticket}</b>
												{if $rang.comment_closed_ticket eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.assign_to_me}</b>
												{if $rang.assign_to_me eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.assign_to_other}</b>
												{if $rang.assign_to_other eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.change_assign}</b>
												{if $rang.change_assign eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.category_gestion}</b>
												{if $rang.category_gestion eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.faq_gestion}</b>
												{if $rang.faq_gestion eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.lang_gestion}</b>
												{if $rang.lang_gestion eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.plugin_gestion}</b>
												{if $rang.plugin_gestion eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.theme_gestion}</b>
												{if $rang.theme_gestion eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.users_gestion}</b>
												{if $rang.users_gestion eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.perm_gestion}</b>
												{if $rang.perm_gestion eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
												<b>{$lang.admin.config_gestion}</b>
												{if $rang.config_gestion eq "1"}
													<span class="label label-success">{$lang.admin.yes}</span>
												{else}
													<span class="label label-danger">{$lang.admin.no}</span>
												{/if}<br />
											</div>
										</div>
									</div>
								</div>
								<a href="#update-{$rang.id}" data-toggle="modal" class="btn btn-default">{$lang.admin.perm_update}</a>
								<div class="modal fade" id="update-{$rang.id}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">{$lang.admin.perm_update}</h4>
											</div>
											<div class="modal-body">
												<form action="?update={$rang.id}" method="post">
													<div class="form-group">
														<label>{$lang.admin.permission_name}</label>
														<input type="text" value="{$rang.name}" name="name" class="form-control" required>
													</div>
													<div class="form-group">
														<label>{$lang.admin.admin_access}</label>
														<select name="admin_access" class="form-control">
															{if $rang.access_admin eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.view_all_ticket}</label>
														<select name="view_all_ticket" class="form-control">
															{if $rang.view_all_ticket eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.reopen_ticket}</label>
														<select name="reopen_ticket" class="form-control">
															{if $rang.reopen_ticket eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.comment_closed_ticket}</label>
														<select name="comment_closed_ticket" class="form-control">
															{if $rang.comment_closed_ticket eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.assign_to_me}</label>
														<select name="assign_to_me" class="form-control">
															{if $rang.assign_to_me eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.assign_to_other}</label>
														<select name="assign_to_other" class="form-control">
															{if $rang.assign_to_other eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.change_assign}</label>
														<select name="change_assign" class="form-control">
															{if $rang.change_assign eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.category_gestion}</label>
														<select name="category_gestion" class="form-control">
															{if $rang.category_gestion eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.faq_gestion}</label>
														<select name="faq_gestion" class="form-control">
															{if $rang.faq_gestion eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.lang_gestion}</label>
														<select name="lang_gestion" class="form-control">
															{if $rang.lang_gestion eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.theme_gestion}</label>
														<select name="theme_gestion" class="form-control">
															{if $rang.theme_gestion eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.users_gestion}</label>
														<select name="users_gestion" class="form-control">
															{if $rang.users_gestion eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.perm_gestion}</label>
														<select name="perm_gestion" class="form-control">
															{if $rang.perm_gestion eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.config_gestion}</label>
														<select name="config_gestion" class="form-control">
															{if $rang.config_gestion eq "1"}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<input type="submit" class="btn btn-primary btn-lg btn-block" value="{$lang.admin.perm_update}">
												</form>
											</div>
										</div>
									</div>
								</div>
								{if $rang.id neq '1'}
									<a href="?delete={$rang.id}&token={$token}" class="btn btn-danger">{$lang.admin.perm_delete}</a>
								{/if}
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}