{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h3>{$lang.admin.category_gestion}</h3>
			<ul class="nav nav-pills">
				<li><a href="{routes('admin_faq')}"><span class="fa fa-reply"></span>{$lang.admin.backToFaq}</a></li>
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
							<form action="" method="post">
								<div class="form-group">
									<label>{$lang.admin.category_name}</label>
									<input type="text" name="name" class="form-control">
								</div>
								<input type="submit" class="btn btn-block btn-primary">
							</form>
						</div>
					</div>
				</div>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>{$lang.admin.category_name}</th>
						<th>{$lang.admin.option}</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$category item=cat}
						<tr>
							<td>{$cat.id}</td>
							<td>{$cat.name|escape:'htmlall'}</td>
							<td>
								<a href="#update-category-{$cat.id}" data-toggle="modal" class="btn btn-info">{$lang.admin.category_update}</a>
								<div class="modal fade" id="update-category-{$cat.id}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button class="close" data-dismiss="modal," aria-hidden="true"></button>
												<h4 class="modal-title">{$lang.admin.category_modal_update}</h4>
											</div>
											<div class="modal-body">
												<form action="?update={$cat.id}" method="post">
													<div class="form-group">
														<label>{$lang.admin.category_name}</label>
														<input type="text" name="name" value="{$cat.name|escape:'htmlall'}" class="form-control">
													</div>
													<input type="submit" class="btn btn-primary btn-block">
												</form>
											</div>
										</div>
									</div>
								</div>
								<a href="#delete-{$cat.id}" data-toggle="modal" class="btn btn-danger">{$lang.admin.category_delete}</a>
								<div class="modal fade" id="delete-{$cat.id}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button class="close" data-dismiss="modal," aria-hidden="true"></button>
												<h4 class="modal-title">{$lang.admin.category_delete}</h4>
											</div>
											<div class="modal-body">
												<h4>{$lang.admin.category_modal_delete_text}</h4>
												<a href="?delete={$cat.id}&token={$token}" class="btn btn-danger btn-block btn-lg">{$lang.admin.category_delete}</a>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}