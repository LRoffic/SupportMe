{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h3>{$lang.admin.category_gestion}</h3>
			<ul class="nav nav-pills">
				<li><a href="#add-category" data-toggle="modal"><i class="fa fa-plus"></i> {$lang.admin.category_add}</a></li>
			</ul>
			<div class="modal fade" id="add-category">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title">{$lang.admin.category_add}</h4>
						</div>
						<div class="modal-body">
							{$add->build()}
						</div>
					</div>
				</div>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>{$lang.admin.category_name}</th>
						<th>{$lang.admin.category_published}</th>
						<th>{$lang.admin.option}</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$category item=cat}
						<tr>
							<td>{$cat.id}</td>
							<td>{$cat.name|escape:'htmlall'}</td>
							<td>
								{if $cat.published}
									<span class="label label-success">{$lang.admin.yes}</span>
								{else}
									<span class="label label-danger">{$lang.admin.no}</span>
								{/if}
							</td>
							<td>
								<a href="#update-{$cat.id}" data-toggle="modal" class="btn btn-default">{$lang.admin.category_update}</a>
								<div class="modal fade" id="update-{$cat.id}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">{$lang.admin.category_modal_update}</h4>
											</div>
											<div class="modal-body">
												<form action="?update={$cat.id}" method="post">
													<div class="form-group">
														<label>{$lang.admin.category_name}</label>
														<input class="form-control" type="text" name="name" value="{$cat.name|escape:'htmlall'}" required>
													</div>
													<div class="form-group">
														<label>{$lang.admin.category_published}</label>
														<select class="form-control" name="published">
															{if $cat.published}
																<option value="1">{$lang.admin.yes}</option>
																<option value="0">{$lang.admin.no}</option>
															{else}
																<option value="0">{$lang.admin.no}</option>
																<option value="1">{$lang.admin.yes}</option>
															{/if}
														</select>
													</div>
													<input type="submit" class="btn btn-primary btn-lg btn-block" value="{$lang.admin.category_update}">
												</form>
											</div>
										</div>
									</div>
								</div>
								{if $cat.id neq "1"}
									<a href="?delete={$cat.id}&token={$token}" class="btn btn-danger">{$lang.admin.category_delete}</a>
								{/if}
							</td>
						</tr>	
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}