<?php if (is_superadmin_loggedin() ): ?>
	<?php $this->load->view('frontend/branch_select'); ?>
<?php endif; if (!empty($branch_id)): ?>
<div class="row">
	<div class="col-md-3 mb-md">
		<?php include 'sidebar.php'; ?>
	</div>
	<div class="col-md-9">
		<section class="panel">
			<div class="tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#welcome" data-toggle="tab"><?php echo translate('welcome') . ' ' . translate('message'); ?></a>
					</li>
					<li>
						<a href="#teachers" data-toggle="tab"><?php echo translate('teachers'); ?></a>
					</li>
					<li>
						<a href="#testimonial" data-toggle="tab"><?php echo translate('testimonial'); ?></a>
					</li>
					<li>
						<a href="#services" data-toggle="tab"><?php echo translate('services'); ?></a>
					</li>
					<li>
						<a href="#cta" data-toggle="tab"><?php echo translate('call_to_action_section'); ?></a>
					</li>
					<li>
						<a href="#options" data-toggle="tab"><?php echo translate('options'); ?></a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="welcome">
						<?php echo form_open_multipart('frontend/section/home_wellcome' . get_request_url(), array('class' => 'form-horizontal frm-submit-data')); ?>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('title'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="wel_title" value="<?php echo set_value('wel_title', $wellcome['title']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('subtitle'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="subtitle" value="<?php echo set_value('subtitle', $wellcome['subtitle']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-md-3 control-label"><?php echo translate('description'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<textarea class="form-control" name="description" rows="5"><?php echo set_value('description', $wellcome['description']); ?></textarea>
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('photo'); ?> <span class="required">*</span></label>
								<div class="col-md-4">
									<input type="hidden" name="old_photo" value="<?php $well_ele = json_decode($wellcome['elements'], true); echo $well_ele['image'] ?>">
									<input type="file" name="photo" class="dropify" data-height="150" data-default-file="<?php echo base_url('uploads/frontend/home_page/' . $well_ele['image']); ?>" />
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
					<div class="tab-pane" id="teachers">
						<?php echo form_open_multipart('frontend/section/home_teachers' . get_request_url(), array('class' => 'form-horizontal frm-submit-data')); ?>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('title'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="doc_title" value="<?php echo set_value('doc_title', $teachers['title']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Start No Of Teacher <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="teacher_start" value="<?php $doc_ele = json_decode($teachers['elements'], true); echo set_value('teacher_start', $doc_ele['teacher_start']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label  class="col-md-3 control-label"><?php echo translate('description'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<textarea class="form-control" name="doc_description" rows="5"><?php echo set_value('doc_description', $teachers['description']); ?></textarea>
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('photo'); ?> <span class="required">*</span></label>
								<div class="col-md-4">
									<input type="hidden" name="old_photo" value="<?php echo $doc_ele['image']; ?>">
									<input type="file" name="photo" class="dropify" data-height="150" data-default-file="<?php echo base_url('uploads/frontend/home_page/' . $doc_ele['image']); ?>" />
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
					<div class="tab-pane" id="testimonial">
						<?php echo form_open('frontend/section/home_testimonial' . get_request_url(), array('class' => 'form-horizontal frm-submit')); ?>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('title'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="tes_title" value="<?php echo set_value('tes_title', $testimonial['title']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('description'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<textarea class="form-control" name="tes_description" rows="3"><?php echo set_value('tes_description', $testimonial['description']); ?></textarea>
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
					<div class="tab-pane" id="services">
						<?php echo form_open('frontend/section/home_services' . get_request_url(), array('class' => 'form-horizontal frm-submit')); ?>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('title'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="ser_title" value="<?php echo set_value('ser_title', $services['title']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('description'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<textarea class="form-control" name="ser_description" rows="3"><?php echo set_value('ser_description', $services['description']); ?></textarea>
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
					<div class="tab-pane" id="cta">
						<?php echo form_open_multipart('frontend/section/home_cta' . get_request_url(), array('class' => 'form-horizontal frm-submit')); ?>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('cta') . " " . translate('title'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="cta_title" value="<?php echo set_value('cta_title', $cta['title']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('mobile_no'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="mobile_no" value="<?php $elements = json_decode($cta['elements'], true); echo set_value('mobile_no', $elements['mobile_no']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('button_text'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="button_text" value="<?php echo set_value('button_text', $elements['button_text']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('button_url'); ?> <span class="required">*</span></label>
								<div class="col-md-7">
									<input type="text" class="form-control" name="button_url" value="<?php echo set_value('button_url', $elements['button_url']); ?>" />
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
					<div class="tab-pane" id="options">
						<?php echo form_open('frontend/section/home_options' . get_request_url(), array('class' => 'form-horizontal frm-submit')); ?>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('page') . " " .  translate('_title'); ?> <span class="required">*</span></label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="page_title" value="<?php echo set_value('page_title', $home_seo['page_title']); ?>" />
									<span class="error"></span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('meta') . " " . translate('keyword'); ?></label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="meta_keyword" value="<?php echo set_value('meta_keyword', $home_seo['meta_keyword']); ?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo translate('meta') . " " . translate('description'); ?></label>
								<div class="col-md-8">
									<input type="text" class="form-control" name="meta_description" value="<?php echo set_value('meta_description', $home_seo['meta_description']); ?>" />
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
				</div>
			</div>
		</section>
	</div>
</div>
<?php endif; ?>