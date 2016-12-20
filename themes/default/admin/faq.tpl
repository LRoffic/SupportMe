{extends file="admin/template.tpl"}
{block name="body"}
	<div class="container">
		{include file="admin/aside.tpl"}
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<h3>{$lang.admin.faq}</h3>
			<ul class="nav nav-pills">
				<li><a href="#add-faq" data-toggle="modal"><span class="fa fa-plus"></span> {$lang.admin.faq_add}</a></li>
				<div class="modal fade" id="add-faq">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title">{$lang.admin.faq_add}</h4>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<div class="form-group">
										<label>{$lang.admin.faq_title}</label>
										<input type="text" name="title" class="form-control">
									</div>
									<div class="form-group">
										<label>{$lang.admin.faq_category}</label>
										<select name="category" class="form-control">
											{foreach from=$category item=cat}
												<option value="{$cat.id}">{$cat.name|escape:"htmlall"}</option>
											{/foreach}
										</select>
									</div>
									<div class="form-group">
										<label>{$lang.admin.faq_content}</label>
										<textarea name="content" cols="30" rows="10" class="form-control"></textarea>
									</div>
									<input type="submit" class="btn btn-block btn-primary" value="{$lang.admin.faq_add}">
								</form>
							</div>
						</div>
					</div>
				</div>
				<li><a href="{routes('admin_faq_category')}"><span class="fa fa-list"></span> {$lang.admin.faq_category_link}</a></li>
			</ul>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>{$lang.admin.faq_title}</th>
						<th>{$lang.admin.faq_category}</th>
						<th>{$lang.admin.option}</th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$articles item=faq}
						<tr>
							<td>{$faq.id}</td>
							<td>{$faq.title|escape:'htmlall'}</td>
							<td>{$faq.name|escape:'htmlall'}</td>
							<td>
								<a href="#update-{$faq.id}" data-toggle="modal" class="btn btn-default">{$lang.admin.faq_update}</a>
								<div class="modal fade" id="update-{$faq.id}">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title">{$lang.admin.faq_update}</h4>
											</div>
											<div class="modal-body">
												<form action="?update={$faq.id}" method="post">
													<div class="form-group">
														<label>{$lang.admin.faq_title}</label>
														<input type="text" name="title" class="form-control" value="{$faq.title|escape:'htmlall'}">
													</div>
													<div class="form-group">
														<label>{$lang.admin.faq_category}</label>
														<select name="category" class="form-control">
															<option value="{$faq.category_id}">{$faq.name|escape:'htmlall'}</option>
															{foreach from=$category item=cat}
																{if $cat.id neq $faq.category_id}
																	<option value="{$cat.id}">{$cat.name|escape:"htmlall"}</option>
																{/if}
															{/foreach}
														</select>
													</div>
													<div class="form-group">
														<label>{$lang.admin.faq_content}</label>
														<textarea name="content" cols="30" rows="10" class="form-control">{text_replace($faq.content)}</textarea>
													</div>
													<input type="submit" class="btn btn-block btn-primary" value="{$lang.admin.faq_update}">
												</form>
											</div>
										</div>
									</div>
								</div>
								<a href="{answer($faq.id, \utilphp\util::slugify($faq.title))}" target="_blank" class="btn btn-info">
									{$lang.admin.faq_see}
								</a>
								<a href="?delete={$faq.id}&token={$token}" class="btn btn-danger">{$lang.admin.faq_delete}</a>
							</td>
						</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>
{/block}