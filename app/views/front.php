<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME)); ?>

<body>
	<div id="wrapper">
		<div class="container mb-5">
			<div class="row">
				<div class="col-12 px-0 px-md-4">
					<div class="header">
						<img src="<?= base_url('img/top' . $type . '.png') ?>" alt="TOP">
					</div>
				</div>
			</div> <!-- end of .row -->

			<h2 class="main-message">資料請求フォームのご利用ありがとうございます。</h2>
			<p class="thanks">
				当社パンフレットをご覧いただき、当フォームへアクセスいただき、ありがとうございます。<br>
				以下の資料請求フォームから、パンフレット掲載商品に関する資料を無料でお取り寄せいただけます。<br>
				貴塾の発展にお役立ていただけますよう、是非ご活用ください。
			</p>

			<hr>

			<ul class="breadcrumb-list">
				<li class="current">ご入力</li>
				<li>ご確認</li>
				<li>送信完了</li>
			</ul>

			<p class="attention-message">必要事項をご入力ください</p>
			<p class="belt-message">以下の項目にご入力のうえ、個人情報の取扱いをご確認いただき、「同意する」ボタンを押してください。</p>

			<?php echo form_open('confirm'); ?>
				<?php echo form_hidden(array('type' => $type)); ?>

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">貴塾名<span>必須</span></div>
					</div>

					<div class="col-md-8">
						※お届け先の教室名をご入力ください。家庭教師の方は、「家庭教師」とご入力ください。<br>
						<?php echo form_input(array(
							'name'			=> 'juku_name',
							'value'			=> set_value('juku_name', ''),
							'placeholder'	=> '例）資料請求塾'
						)); ?>
						<?php echo form_error('juku_name'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">お名前<span>必須</span></div>
					</div>

					<div class="col-md-8">
						<?php echo form_input(array(
							'name'			=> 'contact_name',
							'value'			=> set_value('contact_name', ''),
							'placeholder'	=> '例）中央　太郎'
						)); ?>
						<?php echo form_error('contact_name'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">役職</div>
					</div>

					<div class="col-md-8">
						<?php echo form_input(array(
							'name'			=> 'position',
							'value'			=> set_value('position', ''),
							'placeholder'	=> '例）教室長'
						)); ?>
						<?php echo form_error('position'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">郵便番号<span>必須</span></div>
					</div>

					<div class="col-md-8">
						※半角でご入力ください。<br>
						<?php echo form_input(array(
							'name'			=> 'zip',
							'id'			=> 'zip',
							'value'			=> set_value('zip', ''),
							'placeholder'	=> '例）730-0013',
							'class'			=> 'short'
						)); ?>
						<?php echo form_error('zip'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">都道府県<span>必須</span></div>
					</div>

					<div class="col-md-8">
						<?php echo form_dropdown('pref', $CONF['pref'], set_value('pref', '')); ?>
						<?php echo form_error('pref'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">住所<span>必須</span></div>
					</div>

					<div class="col-md-8">
						市区郡以下、番地まで<br>
						<?php echo form_input(array(
							'name'			=> 'addr1',
							'value'			=> set_value('addr1', ''),
							'placeholder'	=> '例）広島市中区八丁堀15-6'
						)); ?><br>
						<?php echo form_error('addr1'); ?>

						建物名・部屋番号<br>
						<?php echo form_input(array(
							'name'			=> 'addr2',
							'value'			=> set_value('addr2', ''),
							'placeholder'	=> '例）広島ちゅうぎんビル３階'
						)); ?>
						<?php echo form_error('addr2'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">電話番号<span>必須</span></div>
					</div>

					<div class="col-md-8">
						※教室固定電話・携帯電話、いずれかを半角数字でご入力ください。<br>
						<?php echo form_input(array(
							'name'			=> 'tel',
							'value'			=> set_value('tel', ''),
							'placeholder'	=> '例）082-227-3999',
							'class'			=> 'short'
						)); ?>
						<?php echo form_error('tel'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">Eメールアドレス<span>必須</span></div>
					</div>

					<div class="col-md-8">
						<?php echo form_input(array(
							'name'			=> 'email',
							'value'			=> set_value('email', ''),
							'placeholder'	=> '例）info@chuoh-kyouiku.co.jp'
						)); ?>
						<?php echo form_error('email'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">いつ当冊子のことを知りましたか？<span>必須</span></div>
					</div>

					<div class="col-md-8">
						<?php foreach( $CONF['know'] as $key => $val ): ?>
							<?php echo form_radio(array(
								'name'		=> 'know',
								'id'		=> 'know' . $key,
								'checked'	=> set_checkbox('know', $key, FALSE),
								'value'		=> $key
							)); ?>
							<?php echo form_label($val, 'know' . $key); ?><br>
						<?php endforeach; ?>
						<?php echo form_error('know'); ?>

						<div id="other_box" style="display:none;">
							詳細<br>
							<?php echo form_textarea('other', set_value('other', '')); ?>
							<?php echo form_error('other'); ?>
						</div>
					</div>
				</div> <!-- end of .row -->

				<div class="agreement">
					<a href="javascript:void(0);" data-featherlight="#privacy" class="">個人情報の取扱い</a>に同意してお進みください
				</div>

				<?php echo form_submit(array(
					'name'		=> 'btn_submit',
					'value'		=> '同意する',
					'class'		=> 'btn-agree'
				)); ?>

				<?php echo form_button(array(
					'name'		=> 'btn_cancel',
					'id'		=> 'btn_cancel',
					'content'	=> '同意しない',
					'class'		=> 'btn-disagree'
				)); ?>
			<?php echo form_close(); ?>
		</div> <!-- end of container -->

		<?php /* feather lightbox用に個人情報の取扱をロードしておく */ ?>
		<div id="privacy-box" style="display:none;">
			<div id="privacy">
				<?php $this->load->view('inc/privacy'); ?>
			</div>
		</div>
		<?php /* feather lightbox用に個人情報の取扱をロードしておく ここまで */ ?>

		<?php $this->load->view('inc/footer'); ?>
	</div> <!-- end of #wrapper -->

	<?php $this->load->view('inc/_foot'); ?>

	<script src="//ajaxzip3.github.io/ajaxzip3.js"></script>
	<script src="<?= base_url('js/front.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
