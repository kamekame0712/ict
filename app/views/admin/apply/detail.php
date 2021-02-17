<?php $this->load->view('inc/admin/_head', array('TITLE' => '資料請求管理 | ' . SITE_NAME)); ?>

<body>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('inc/admin/header'); ?>
			<?php $this->load->view('inc/admin/sidebar', array('current' => 'apply')); ?>

			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>資料請求管理&nbsp;詳細</h1>
					</div>

					<div class="section-body">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="table-responsive">
									<table class="table table-striped">
										<tr>
											<th>フォーム種別</th>
											<td><?= $CONF['form_type'][$ADATA['type']] ?></td>
										</tr>

										<tr>
											<th>塾名</th>
											<td><?= $ADATA['juku_name'] ?></td>
										</tr>

										<tr>
											<th>氏名</th>
											<td><?= $ADATA['contact_name'] ?></td>
										</tr>

										<tr>
											<th>役職</th>
											<td><?= $ADATA['position'] ?></td>
										</tr>

										<tr>
											<th>住所</th>
											<td>
												〒<?= $ADATA['zip'] ?><br>
												<?= $CONF['pref'][$ADATA['pref']] ?><?= $ADATA['addr1'] ?>&nbsp;<?= $ADATA['addr1'] ?>
											</td>
										</tr>

										<tr>
											<th>電話番号</th>
											<td><?= $ADATA['tel'] ?></td>
										</tr>

										<tr>
											<th>メールアドレス</th>
											<td><?= $ADATA['email'] ?></td>
										</tr>

										<tr>
											<th>いつ知ったか</th>
											<td>
												<?php if( !empty($ADATA['know']) ): ?>
													<?= $CONF['know'][$ADATA['know']] ?>
													<?php if( $ADATA['know'] == '9' && !empty($ADATA['other']) ): ?>
														<?= $ADATA['other'] ?>
													<?php endif; ?>
												<?php endif; ?>
											</td>
										</tr>

										<tr>
											<th>自由記述</th>
											<td><?= nl2br($ADATA['note']) ?></td>
										</tr>

										<tr>
											<th>申請日時</th>
											<td><?= $ADATA['regist_time'] ?></td>
										</tr>

										<tr>
											<th>処理状況</th>
											<td>
												<?php echo form_dropdown('flg_processed', $CONF['flg_processed'], $ADATA['flg_processed'], 'id="flg_processed" onchange="change_status(\'' . $ADATA['apply_id'] .'\');"') ?>
												※変更するとそのまま更新されます。
											</td>
										</tr>
									</table>
								</div> <!-- end of .table-responsive -->
							</div>
						</div> <!-- end of .row -->

						<div class="row mt-3">
							<div class="col-12 col-md-6 text-center">
								<?php echo form_button(array(
									'name'		=> 'btn_back',
									'content'	=> '戻る',
									'onclick'	=> 'history.back();',
									'class'		=> 'btn btn-primary'
								)); ?>
							</div>
						</div> <!-- end of .row -->
					</div> <!-- end of .section-body -->
				</section>
			</div> <!-- end of .main-content -->

			<?php $this->load->view('inc/admin/footer'); ?>
		</div> <!-- end of .main-wrapper -->
	</div> <!-- end of #app -->

	<?php $this->load->view('inc/admin/_foot'); ?>
	<script src="<?= base_url('js/admin/apply_detail.js')?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
