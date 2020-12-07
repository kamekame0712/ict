<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME)); ?>

<body>
	<div id="wrapper">
		<div class="container mb-5">
			<div class="row">
				<div class="col-12 px-0 px-md-4">
					<div class="header">
						<img src="<?= base_url('img/top' . $ADATA['type'] . '.png') ?>" alt="TOP">
					</div>
				</div>
			</div> <!-- end of .row -->

			<img src="<?= base_url('img/message3.png') ?>" alt="無料相談フォームのご利用ありがとうございます" class="main-message">
			<p class="thanks">
				以下の入力フォームから、送付いたしました資料に関するご相談等を承っております。<br>
				貴塾の発展にお役立ていただけますよう、お気軽にお問い合わせください。
			</p>

			<hr>

			<div class="customer-info">
				<p class="attention-message-black">お客様情報の確認</p>

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">貴塾名</div>
					</div>

					<div class="col-md-8">
						<?= $ADATA['juku_name'] ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">お名前</div>
					</div>

					<div class="col-md-8">
						<?= $ADATA['contact_name'] ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">電話番号</div>
					</div>

					<div class="col-md-8">
						<?= $ADATA['tel'] ?>
					</div>
				</div> <!-- end of .row -->
			</div>

			<ul class="breadcrumb-list">
				<li class="current">ご入力</li>
				<li>ご確認</li>
				<li>送信完了</li>
			</ul>

			<p class="attention-message">必要事項をご入力ください</p>
			<p class="belt-message">以下の項目にご入力のうえ、個人情報の取扱いをご確認いただき、「同意する」ボタンを押してください。</p>

			<?php echo form_open('consult/confirm'); ?>
				<?php echo form_hidden('apply_id', $ADATA['apply_id']); ?>
				<?php echo form_hidden('param', $ADATA['param']); ?>

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">商品名<span>必須</span></div>
					</div>

					<div class="col-md-8">
						<?php echo form_dropdown('product', $CONF['product'][$ADATA['type']], set_value('product', ''), 'id="product"'); ?>
						<?php echo form_error('product'); ?>

						<div id="product_box" style="display:none">
							その他を選択した場合のみ、商品名をご入力ください。
							<?php echo form_input(array(
								'name'	=> 'other_product',
								'value'	=> set_value('other_product', '')
							)); ?>
							<?php echo form_error('other_product'); ?>
						</div>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">ご相談内容<span>必須</span></div>
					</div>

					<div class="col-md-8">
						<?php echo form_dropdown('substance', $CONF['substance']); ?>
						<?php echo form_error('substance'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">ご相談日程<span>必須</span></div>
					</div>

					<div class="col-md-8">
						<?php echo form_radio(array(
							'name'		=> 'hope_date',
							'id'		=> 'hope_date1',
							'checked'	=> set_checkbox('hope_date', 1, FALSE),
							'value'		=> 1
						)); ?>
						<?php echo form_label('希望日程なし', 'hope_date1'); ?><br>

						<?php echo form_radio(array(
							'name'		=> 'hope_date',
							'id'		=> 'hope_date2',
							'checked'	=> set_checkbox('hope_date', 2, FALSE),
							'value'		=> 2
						)); ?>
						<?php echo form_label('至急', 'hope_date2'); ?><br>

						<?php echo form_radio(array(
							'name'		=> 'hope_date',
							'id'		=> 'hope_date3',
							'checked'	=> set_checkbox('hope_date', 3, FALSE),
							'value'		=> 3
						)); ?>
						<?php echo form_label('希望日程あり', 'hope_date3'); ?><br>

						<?php echo form_error('hope_date'); ?>

						<div id="hope_date_box" style="display:none">
							ご希望の日程をご入力ください。<br>
							<?php echo form_input(array(
								'name'	=> 'other_hope_date',
								'id'	=> 'other_hope_date',
								'value'	=> set_value('other_hope_date', ''),
								'placeholder'	=> '例）☓☓月☓☓日',
								'class'			=> 'short'
							)); ?>
							<?php echo form_error('other_hope_date'); ?>
						</div>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">ご希望時間</div>
					</div>

					<div class="col-md-8">
						当社からの連絡に際し、ご希望の時間帯があればご入力ください。<br>
						<?php echo form_input(array(
							'name'			=> 'hope_time',
							'value'			=> set_value('hope_time', ''),
							'placeholder'	=> '例）１０時～１１時',
							'class'			=> 'short'
						)); ?>
						<?php echo form_error('hope_time'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">ご相談方法<span>必須</span></div>
					</div>

					<div class="col-md-8">
						<?php echo form_dropdown('method', $CONF['method'], set_value('method', '')); ?>
						<?php echo form_error('method'); ?>
					</div>
				</div> <!-- end of .row -->

				<div class="row form-item">
					<div class="col-md-4">
						<div class="question">その他</div>
					</div>

					<div class="col-md-8">
						上記項目に加えて、お問い合わせ・ご希望の内容がございましたらご入力ください。<br>
						<?php echo form_textarea(array(
							'name'	=> 'note',
							'value'	=> set_value('note', '')
						)); ?>
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

	<script src="<?= base_url('js/consult_form.js') ?>?var=<?= CACHES_CLEAR_VERSION ?>"></script>
</body>
</html>
