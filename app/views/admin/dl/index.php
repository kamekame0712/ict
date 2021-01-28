<?php $this->load->view('inc/admin/_head', array('TITLE' => 'ダウンロード | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'dl')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>ダウンロード</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card card-primary">
									<div class="card-body">
										<?php echo form_open('admin/dl', array('id' => 'frm_dl')); ?>
											<div class="container-fluid">
												<div class="row">
													<div class="col-12">
														<div class="form-group">
															<label>期間</label>
															<div class="container-fluid">
																<div class="row">
																	<div class="col-2 px-0">
																		<?php echo form_input(array(
																			'name'	=> 'limit_from',
																			'id'	=> 'limit_from',
																			'class'	=> 'form-control',
																			'value'	=> set_value('limit_from', '')
																		)); ?>
																	</div>
																	<div class="col-1 px-0 text-center">～</div>
																	<div class="col-2 px-0">
																		<?php echo form_input(array(
																			'name'	=> 'limit_to',
																			'id'	=> 'limit_to',
																			'class'	=> 'form-control',
																			'value'	=> set_value('limit_to', '')
																		)); ?>
																	</div>
																</div> <!-- end of .row -->
															</div>
														</div>
													</div>
												</div> <!-- end of .row -->

												<div class="row justify-content-center mt-5 mb-3">
													<div class="col-3 text-center">
														<?php echo form_button(array(
															'name'		=> 'btn-apply',
															'content'	=> '資料請求一覧<br>ダウンロード',
															'class'		=> 'btn-dl btn btn-primary',
															'onclick'	=> 'do_submit(\'dl_apply\')'
														)); ?>
													</div>
													<div class="col-3 text-center">
														<?php echo form_button(array(
															'name'		=> 'btn-consult',
															'content'	=> '無料相談一覧<br>ダウンロード',
															'class'		=> 'btn-dl btn btn-success',
															'onclick'	=> 'do_submit(\'dl_consult\')'
														)); ?>
													</div>
													<div class="col-3 text-center">
														<?php echo form_button(array(
															'name'		=> 'btn-referer',
															'content'	=> 'アクセス状況<br>ダウンロード',
															'class'		=> 'btn-dl btn btn-warning',
															'onclick'	=> 'do_submit(\'dl_referer\')'
														)); ?>
													</div>
												</div> <!-- end of .row -->
											</div> <!-- end of .container-fluid -->
										<?php echo form_close(); ?>
									</div> <!-- end of .card-body -->
								</div> <!-- end of .card -->
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .section-body -->
				</section>
			</div> <!-- end of .main-content -->

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php $this->load->view('inc/admin/_foot'); ?>
	<script src="<?= base_url('js/admin/dl.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
