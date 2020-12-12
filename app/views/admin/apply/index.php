<?php $this->load->view('inc/admin/_head', array('TITLE' => '資料請求管理 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'apply')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>資料請求管理</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card card-primary">
									<div class="card-header">
										<h4>抽出条件</h4>
										<div class="card-header-action">
											<a data-collapse="#condition-box" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
										</div>
									</div> <!-- end of .card-header -->

									<?php echo form_open('admin/apply', array('id' => 'frm_apply')); ?>
										<?php echo form_input(array(
											'type'	=> 'hidden',
											'name'	=> 'record_num',
											'id'	=> 'record_num',
											'value'	=> set_value('record_num', $RECORD_NUM)
										)); ?>

										<div id="condition-box" class="collapse show">
											<div class="card-body">
												<div class="container-fluid">
													<div class="row">
														<div class="col-4">
															<div class="form-group">
																<div class="control-label">処理対象</div>

																<?php echo form_checkbox(array(
																	'name'	=> 'flg_processed',
																	'id'	=> 'flg_processed',
																	'value'	=> '1',
																	'checked'	=> set_checkbox('flg_processed', '1', FALSE)
																)); ?>
																<?php echo form_label('未処理のみ', 'flg_processed', array('class' => 'conditions-label')); ?>
															</div>
														</div>

														<div class="col-4">
															<div class="form-group">
																<div class="control-label">フォーム種別</div>

																<?php foreach( $CONF['form_type'] as $key => $val ): ?>
																	<?php echo form_checkbox(array(
																		'name'	=> 'type[]',
																		'id'	=> 'type' . $key,
																		'value'	=> $key,
																		'checked'	=> set_checkbox('type[]', $key, TRUE)
																	)); ?>
																	<?php echo form_label($val, 'type' . $key, array('class' => 'conditions-label')); ?>
																<?php endforeach; ?>
															</div>
														</div>
													</div> <!-- end of .row -->

													<div class="row">
														<div class="col-4">
															<div class="form-group">
																<label>塾名</label>
																<?php echo form_input(array(
																	'name'	=> 'juku_name',
																	'class'	=> 'form-control',
																	'value'	=> set_value('juku_name', '')
																)); ?>
															</div>
														</div>

														<div class="col-4">
															<div class="form-group">
																<label>都道府県</label>
																<?php echo form_dropdown('pref', $CONF['pref'], set_value('pref', ''), 'class="form-control"'); ?>
															</div>
														</div>

														<div class="col-4">
															<div class="form-group">
																<label>住所</label>
																<?php echo form_input(array(
																	'name'	=> 'address',
																	'class'	=> 'form-control',
																	'value'	=> set_value('address', '')
																)); ?>
															</div>
														</div>
													</div> <!-- end of .row -->

													<div class="row">
														<div class="col-12">
															<div class="form-group">
																<label>請求日時</label>
																<div class="container-fluid">
																	<div class="row">
																		<div class="col-2 px-0">
																			<?php echo form_input(array(
																				'name'	=> 'regist_from',
																				'id'	=> 'regist_from',
																				'class'	=> 'form-control',
																				'value'	=> set_value('regist_from', '')
																			)); ?>
																		</div>
																		<div class="col-1 px-0 text-center">～</div>
																		<div class="col-2 px-0">
																			<?php echo form_input(array(
																				'name'	=> 'regist_to',
																				'id'	=> 'regist_to',
																				'class'	=> 'form-control',
																				'value'	=> set_value('regist_to', '')
																			)); ?>
																		</div>
																	</div> <!-- end of .row -->
																</div>
															</div>
														</div>
													</div> <!-- end of .row -->
												</div> <!-- end of .container-fluid -->
											</div> <!-- end of .card-body -->

											<div class="card-footer text-right">
												<?php echo form_submit(array(
													'name'	=> 'btn_submit',
													'value'	=> '　抽出　',
													'class'	=> 'btn btn-primary'
												)); ?>
											</div> <!-- end of .card-footer -->
										</div> <!-- end of #condition-box -->
									<?php echo form_close(); ?>
								</div> <!-- end of .card -->
							</div>
						</div> <!-- end of .row -->

						<?php if( is_null($ADATA) ): ?>
							ご指定の条件では該当する請求が存在しません。
						<?php elseif( !empty($ADATA) ): ?>
							<div class="row">
								<div class="col-12">
									<p id="reload_request" style="display:none;">ページをリロードしてください。</p>
									<div class="card card-success" id="search_result">
										<?php echo form_open('admin/apply/proc', array('id' => 'frm_proc')); ?>
											<div class="card-body">
												<div class="page-box">
													表示件数：
													<?php echo form_dropdown('page_list', array('25' => '25', '50' => '50', '0' => 'All'), $RECORD_NUM, 'id="page_list"'); ?>
													<div class="pagination"><?= $PAGINATION ?><?= $SHOWING ?></div>
												</div>

												<div class="table-responsive">
													<table class="table table-striped table-sm mb-4">
														<thead>
															<tr>
																<th>
																	<?php echo form_checkbox(array(
																		'name'		=> 'all_select',
																		'id'		=> 'all_select',
																		'value'		=> '1',
																		'checked'	=> 'checked'
																	)); ?>
																</th>
																<th>処理</th>
																<th>未/済</th>
																<th>フォーム種別</th>
																<th>塾名</th>
																<th>住所</th>
																<th>電話番号</th>
																<th>請求日時</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach( $ADATA as $val ): ?>
																<tr>
																	<td>
																		<?php if( $val['flg_processed'] == '1' ): ?>
																			<?php echo form_checkbox(array(
																				'name'		=> 'ids[]',
																				'id'		=> 'id_' . $val['apply_id'],
																				'value'		=> $val['apply_id'],
																				'checked'	=> 'checked'
																			)); ?>
																		<?php endif; ?>
																	</td>
																	<td>
																		<a href="<?= site_url('admin/apply/detail') ?>/<?= $val['apply_id'] ?>"><i class="fas fa-info"></i>&nbsp;詳細</a>&nbsp;&nbsp;
																		<a href="<?= site_url('admin/apply/dl') ?>/<?= $val['apply_id'] ?>"><i class="fas fa-download"></i>&nbsp;ダウンロード</a>
																	</td>
																	<td>
																		<?php if( $val['flg_processed'] == '1' ): ?>
																			<span class="text-danger">未処理</span>
																		<?php else: ?>
																			処理済
																		<?php endif; ?>
																	</td>
																	<td><?= $CONF['form_type'][$val['type']] ?></td>
																	<td><?= $val['juku_name'] ?></td>
																	<td><?= $CONF['pref'][$val['pref']] ?><?= $val['addr1'] ?>&nbsp;<?= $val['addr2'] ?></td>
																	<td><?= $val['tel'] ?></td>
																	<td><?= $val['regist_time'] ?></td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
													【処理開始】をクリックするとチェックのついている請求データを対象に処理を行います。<br>
													（表示しているページ内のデータのみが対象ですので複数ページに分かれている場合はご注意ください。）<br><br>
													※処理内容<br>
													　・データのダウンロード<br>
													　・発送案内メールの送信<br>
													　・データを『処理済』に変更<br>
													　（データのダウンロードのみを行う場合、処理欄にある【<i class="fas fa-download"></i>&nbsp;ダウンロード】をクリックしてください。）
												</div> <!-- end of .table-responsive -->
											</div> <!-- end of .card-body -->

											<div class="card-footer text-right">
												<?php echo form_button(array(
													'name'		=> 'btn_proc',
													'content'	=> '　処理開始　',
													'class'		=> 'btn btn-success',
													'onclick'	=> 'do_proc();'
												)); ?>
											</div> <!-- end of .card-footer -->
										<?php echo form_close(); ?>
									</div> <!-- end of .card -->
								</div>
							</div> <!-- end of .row -->
						<?php endif; ?>
					</div> <!-- end of .section-body -->
				</section>
			</div> <!-- end of .main-content -->

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php $this->load->view('inc/admin/_foot'); ?>
	<script src="<?= base_url('js/admin/apply.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
