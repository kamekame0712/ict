<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME)); ?>

<body>
	<div id="wrapper">
		<div class="container mb-5">
			<div class="row">
				<div class="col-12 px-0 px-md-4">
					<div class="header">
						<img src="<?= base_url('img/top' . $PDATA['type'] . '.png') ?>" alt="TOP">
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
					<div class="question">貴塾名</div>
				</div>

				<div class="col-md-8">
					<?= $PDATA['juku_name'] ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">お名前</div>
				</div>

				<div class="col-md-8">
					<?= $PDATA['contact_name'] ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">役職</div>
				</div>

				<div class="col-md-8">
					<?= $PDATA['position'] ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">郵便番号</div>
				</div>

				<div class="col-md-8">
					<?= $PDATA['zip'] ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">住所</div>
				</div>

				<div class="col-md-8">
					<?= $CONF['pref'][$PDATA['pref']] ?><?= $PDATA['addr1'] ?><?= $PDATA['addr2'] ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">電話番号</div>
				</div>

				<div class="col-md-8">
					<?= $PDATA['tel'] ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">Eメールアドレス</div>
				</div>

				<div class="col-md-8">
					<?= $PDATA['email'] ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">いつ当冊子のことを知りましたか？</div>
				</div>

				<div class="col-md-8">
					<?php if( !empty($PDATA['know']) ): ?>
						<?= $CONF['know'][$PDATA['know']] ?>
						<?php if( $PDATA['know'] == '9' ): ?>
							<br><br><?= nl2br($PDATA['other']) ?>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div> <!-- end of .row -->

			<div class="row form-item">
				<div class="col-md-4">
					<div class="question">自由記述</div>
				</div>

				<div class="col-md-8">
					<?= nl2br($PDATA['note']) ?>
				</div>
			</div> <!-- end of .row -->

			<?php echo form_open('complete', array('id' => 'frm_confirm')); ?>
				<?php echo form_hidden($PDATA); ?>

				<?php echo form_button(array(
					'name'		=> 'btn_submit',
					'content'	=> '戻る',
					'class'		=> 'btn-disagree',
					'onclick'	=> 'do_submit(' . $PDATA['type'] . ');'
				)); ?>

				<?php echo form_button(array(
					'name'		=> 'btn_cancel',
					'content'	=> '送信する',
					'class'		=> 'btn-agree',
					'onclick'	=> 'do_submit(9);'
				)); ?>
			<?php echo form_close(); ?>
		</div> <!-- end of container -->

		<?php $this->load->view('inc/footer'); ?>
	</div> <!-- end of #wrapper -->

	<?php $this->load->view('inc/_foot'); ?>

	<script src="<?= base_url('js/confirm.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
