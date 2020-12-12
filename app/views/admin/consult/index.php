<?php $this->load->view('inc/admin/_head', array('TITLE' => '無料相談管理 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'consult')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>無料相談管理</h1>
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

									<?php echo form_open('admin/consult', array('id' => 'frm_consult')); ?>
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
																<label>商品</label>
																<?php echo form_dropdown('product', $PLIST, set_value('product', ''), 'class="form-control"'); ?>
															</div>
														</div>

														<div class="col-4">
															<div class="form-group">
																<label>相談内容</label>
																<?php echo form_dropdown('substance', $CONF['substance'], set_value('substance', ''), 'class="form-control"'); ?>
															</div>
														</div>

														<div class="col-4">
															<div class="form-group">
																<label>対応状況</label>
																<?php echo form_dropdown('flg_handle', $CONF['flg_handle'], set_value('flg_handle', ''), 'class="form-control"'); ?>
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

														<div class="col-8">
															<div class="form-group">
																<label>問合せ日時</label>
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

						<?php if( is_null($CDATA) ): ?>
							ご指定の条件では該当する請求が存在しません。
						<?php elseif( !empty($CDATA) ): ?>
							<div class="row">
								<div class="col-12">
									<p id="reload_request" style="display:none;">ページをリロードしてください。</p>
									<div class="card card-success" id="search_result">
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
															<th>処理</th>
															<th>塾名</th>
															<th>商品</th>
															<th>相談内容</th>
															<th>相談日程</th>
															<th>相談方法</th>
															<th>対応状況</th>
															<th>その他</th>
															<th>問合せ日時</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach( $CDATA as $val ): ?>
															<?php
																$hope_date_str = '';
																switch( $val['hope_date'] ) {
																	case '1': $hope_date_str = '希望日程なし';			break;
																	case '2': $hope_date_str = '至急';					break;
																	case '3': $hope_date_str = $val['other_hope_date'];	break;
																}

																if( !empty($val['hope_time']) ) {
																	$hope_date_str .= '&nbsp;' . $val['hope_time'];
																}
															?>

															<tr>
																<td>
																	<a href="<?= site_url('admin/consult/detail') ?>/<?= $val['consult_id'] ?>"><i class="fas fa-info"></i>&nbsp;詳細</a>
																</td>
																<td><?= $val['juku_name'] ?></td>
																<td><?= $CONF['product'][$val['type']][$val['product']] ?></td>
																<td><?= $CONF['substance'][$val['substance']] ?></td>
																<td><?= $hope_date_str ?></td>
																<td><?= $CONF['method'][$val['method']] ?></td>
																<td><?= $CONF['flg_handle'][$val['flg_handle']] ?></td>
																<td><?= $val['note'] ?></td>
																<td><?= $val['regist_time'] ?></td>
															</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</div> <!-- end of .table-responsive -->
										</div> <!-- end of .card-body -->
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
	<script src="<?= base_url('js/admin/consult.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
