<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME)); ?>

<body>
	<div id="wrapper">
		<div class="container mb-5">
			<div class="row">
				<div class="col-12 px-0 px-md-4">
					<div class="header">
						<img src="<?= base_url('img/top' . $TYPE . '.png') ?>" alt="TOP">
					</div>
				</div>
			</div> <!-- end of .row -->

			<ul class="breadcrumb-list mt-5">
				<li>ご入力</li>
				<li class="current">ご確認</li>
				<li>送信完了</li>
			</ul>

			<p class="attention-message">入力内容をご確認ください</p>
			<p class="belt-message">お間違えなければ「送信」ボタンを押してください。</p>

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">商品名</div>
				</div>

				<div class="col-md-8">
					<?= $CONF['product'][$TYPE][$PDATA['product']] ?>
					<?php if($PDATA['product'] == '99'): ?>
						（<?= $PDATA['other_product'] ?>）
					<?php endif; ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">ご相談内容</div>
				</div>

				<div class="col-md-8">
					<?= $CONF['substance'][$PDATA['substance']] ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">ご相談日程</div>
				</div>

				<div class="col-md-8">
					<?php
						switch( $PDATA['hope_date'] ) {
							case '1': $hope_date = '希望日程なし';				break;
							case '2': $hope_date = '至急';						break;
							case '3': $hope_date = $PDATA['other_hope_date'];	break;
						}
					?>
					<?= $hope_date ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">ご希望時間</div>
				</div>

				<div class="col-md-8">
					<?= !empty($PDATA['hope_time']) ? $PDATA['hope_time'] : 'ご指定なし' ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">ご相談方法</div>
				</div>

				<div class="col-md-8">
					<?= $CONF['method'][$PDATA['method']] ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">その他</div>
				</div>

				<div class="col-md-8">
					<?= nl2br($PDATA['note']) ?>
				</div>
			</div> <!-- end of .row -->

			<?php echo form_open('consult/complete', array('id' => 'frm_consult_confirm')); ?>
				<?php echo form_hidden($PDATA); ?>

				<?php echo form_button(array(
					'name'		=> 'btn_submit',
					'content'	=> '戻る',
					'class'		=> 'btn-disagree',
					'onclick'	=> 'do_submit(1, \'' . $PDATA['param'] . '\');'
				)); ?>

				<?php echo form_button(array(
					'name'		=> 'btn_cancel',
					'content'	=> '送信する',
					'class'		=> 'btn-agree',
					'onclick'	=> 'do_submit(2, \'\');'
				)); ?>
			<?php echo form_close(); ?>
		</div> <!-- end of container -->

		<?php $this->load->view('inc/footer'); ?>
	</div> <!-- end of #wrapper -->

	<?php $this->load->view('inc/_foot'); ?>

	<script src="<?= base_url('js/consult_confirm.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
