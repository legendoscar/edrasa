<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#list" data-toggle="tab"><i class="fas fa-list-ul"></i> <?php echo translate('menu') . " " . translate('list'); ?></a>
			</li>
	<?php if (get_permission('frontend_menu', 'is_add')) { ?>
			<li class="">
				<a href="#create" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('add') . " " . translate('menu'); ?></a>
			</li>
	<?php } ?>
		</ul>
		<div class="tab-content">
			<div id="list" class="tab-pane active">
				<table class="table table-bordered table-hover table-condensed table_default" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th><?php echo translate('sl'); ?></th>
<?php if (is_superadmin_loggedin()): ?>
							<th><?=translate('branch')?></th>
<?php endif; ?>
							<th><?php echo translate('title'); ?></th>
							<th><?php echo translate('position'); ?></th>
							<th><?php echo translate('publish'); ?></th>
							<th><?php echo translate('action'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$count = 1;
							if (!empty($menulist)) {
								foreach ($menulist as $row):
								?>
						<tr>
							<td><?php echo $count++; ?></td>
<?php if (is_superadmin_loggedin()): ?>
							<td><?php
							if ($row['system'] == 1) {
								echo "System Menu";
							} else {
								echo $row['branch_name'];
							}
							?></td>
<?php endif; ?>
							<td><?php echo strip_tags($row['title']); ?></td>
							<td><?php echo $row['ordering']; ?></td>
							<td>
		                        <div class="material-switch ml-xs">
		                            <input class="switch_menu" id="switch_<?php echo $row['id']; ?>" data-menu-id="<?php echo $row['id']; ?>" name="sw_menu<?php echo $row['id']; ?>" type="checkbox" <?php echo $row['publish'] == 1 ? 'checked' : ''; ?> />
		                            <label for="switch_<?php echo $row['id']; ?>" class="label-primary"></label>
		                        </div>
							</td>
							<td class="min-w-xs">
							<?php if (get_permission('frontend_menu', 'is_edit')) { ?>
								<a href="<?php echo base_url('frontend/menu/edit/' . $row['id']); ?>" class="btn btn-default btn-circle icon" data-toggle="tooltip" data-original-title="<?php echo translate('edit'); ?>"> 
									<i class="fas fa-pen-nib"></i>
								</a>
							<?php } ?>
							<?php
								if ($row['system'] == 0) {
									if (get_permission('frontend_menu', 'is_delete')) {
										echo btn_delete('frontend/menu/delete/' . $row['id']); 
									}
								}
							?>
							</td>
						</tr>
						<?php endforeach; }?>
					</tbody>
				</table>
			</div>
	<?php if (get_permission('frontend_menu', 'is_add')) { ?>
			<div class="tab-pane" id="create">
				<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
					<?php if (is_superadmin_loggedin()): ?>
						<div class="form-group">
							<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
							<div class="col-md-6">
								<?php
								$arrayBranch = $this->app_lib->getSelectList('branch');
								echo form_dropdown("branch_id", $arrayBranch, set_value('branch_id'), "class='form-control' data-width='100%'
								data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
								?>
								<span class="error"></span>
							</div>
						</div>
					<?php endif; ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?php echo translate('title'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="title" value="<?php echo set_value('title'); ?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo translate('position'); ?> <span class="required">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="position" value="<?php echo set_value('position'); ?>" />
							<span class="error"></span>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo translate('publish'); ?></label>
						<div class="col-md-6">
	                        <div class="material-switch">
	                            <input name="publish" id="publish" type="checkbox" value="1" <?php echo set_checkbox('publish', '1', true); ?> />
	                            <label for="publish" class="label-primary"></label>
	                        </div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo translate('target_new_window'); ?></label>
						<div class="col-md-6">
	                        <div class="material-switch">
	                            <input name="new_tab" id="new_tab" type="checkbox" value="1" <?php echo set_checkbox('new_tab', '1'); ?> />
	                            <label for="new_tab" class="label-primary"></label>
	                        </div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo translate('external_url'); ?></label>
						<div class="col-md-6">
	                        <div class="material-switch">
	                            <input class="ext_url" name="external_url" id="external_url" type="checkbox" value="1" <?php echo set_checkbox('external_url', '1'); ?> />
	                            <label for="external_url" class="label-primary"></label>
	                        </div>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-md-3 control-label"><?php echo translate('external_link'); ?></label>
						<div class="col-md-6">
	                        <input type="text" class="form-control" name="external_link" id="external_link" value="<?php echo set_value('external_link'); ?>" <?php echo (!set_value('external_url')) ? 'disabled' : ''; ?> />
							<span class="error"></span>
						</div>
					</div>
					<footer class="panel-footer mt-lg">
						<div class="row">
							<div class="col-md-2 col-md-offset-3">
								<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
									<i class="fas fa-plus-circle"></i> <?php echo translate('save'); ?>
								</button>
							</div>
						</div>	
					</footer>
				<?php echo form_close(); ?>
			</div>
	<?php } ?>
		</div>
	</div>
</section>