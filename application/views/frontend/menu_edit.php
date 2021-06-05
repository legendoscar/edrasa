<section class="panel">
	<div class="tabs-custom">
		<ul class="nav nav-tabs">
			<li>
				<a href="<?php echo base_url('frontend/menu'); ?>"><i class="fas fa-list-ul"></i> <?php echo translate('menu') . " " . translate('list'); ?></a>
			</li>
			<li class="active">
				<a href="#edit" data-toggle="tab"><i class="far fa-edit"></i> <?php echo translate('edit') . " " . translate('menu'); ?></a>
			</li>
		</ul>
		<div class="tab-content active" id="edit">
			<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal form-bordered frm-submit')); ?>
				<input type="hidden" name="menu_id" value="<?php echo $menu['id']; ?>">
				<?php if (is_superadmin_loggedin()): ?>
					<div class="form-group">
						<label class="col-md-3 control-label"><?=translate('branch')?> <span class="required">*</span></label>
						<div class="col-md-6">
							<?php
							$arrayBranch = $this->app_lib->getSelectList('branch');
							echo form_dropdown("branch_id", $arrayBranch, $menu['branch_id'], "class='form-control' data-width='100%'
							data-plugin-selectTwo  data-minimum-results-for-search='Infinity'");
							?>
							<span class="error"></span>
						</div>
					</div>
				<?php endif; ?>
				<div class="form-group">
					<label class="col-md-3 control-label"><?php echo translate('title'); ?> <span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="title" value="<?php echo set_value('title', $menu['title']); ?>" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label  class="col-md-3 control-label"><?php echo translate('position'); ?> <span class="required">*</span></label>
					<div class="col-md-6">
						<input type="text" class="form-control" name="position" value="<?php echo set_value('position', $menu['ordering']); ?>" />
						<span class="error"></span>
					</div>
				</div>
				<div class="form-group">
					<label  class="col-md-3 control-label"><?php echo translate('publish'); ?></label>
					<div class="col-md-6">
	                    <div class="material-switch">
	                        <input class="switch_lang" name="publish" id="publish" type="checkbox" <?php echo set_checkbox('publish', '1', $menu['publish'] ? true : false); ?> />
	                        <label for="publish" class="label-primary"></label>
	                    </div>
					</div>
				</div>
				<div class="form-group">
					<label  class="col-md-3 control-label"><?php echo translate('target_new_window'); ?></label>
					<div class="col-md-6">
	                    <div class="material-switch">
	                        <input name="new_tab" id="new_tab" type="checkbox" value="1" <?php echo set_checkbox('new_tab', '1', $menu['open_new_tab'] ? true : false); ?> />
	                        <label for="new_tab" class="label-primary"></label>
	                    </div>
					</div>
				</div>
				<?php if (!$menu['system']): ?>
				<div class="form-group">
					<label  class="col-md-3 control-label"><?php echo translate('external_url'); ?></label>
					<div class="col-md-6">
	                    <div class="material-switch">
	                        <input class="ext_url" name="external_url" id="external_url" type="checkbox" value="1" <?php echo set_checkbox('external_url', '1', $menu['ext_url'] ? true : false); ?> />
	                        <label for="external_url" class="label-primary"></label>
	                    </div>
					</div>
				</div>
				<div class="form-group">
					<label  class="col-md-3 control-label"><?php echo translate('external_link'); ?></label>
					<div class="col-md-6">
	                    <input type="text" class="form-control" name="external_link" id="external_link" value="<?php echo set_value('external_link', $menu['ext_url_address']); ?>" <?php echo (!set_value('external_url',$menu['ext_url'])) ? 'disabled' : ''; ?> />
						<span class="error"><?php echo form_error('external_link'); ?></span>
					</div>
				</div>
				<?php endif; ?>
				<footer class="panel-footer mt-lg">
					<div class="row">
						<div class="col-md-2 col-md-offset-3">
							<button type="submit" class="btn btn-default btn-block" data-loading-text="<i class='fas fa-spinner fa-spin'></i> Processing">
								<i class="fas fa-edit"></i> <?php echo translate('update'); ?>
							</button>
						</div>
					</div>	
				</footer>
			<?php echo form_close(); ?>
		</div>
	</div>
</section>