<?php $this->load->view('inc/_head', array('TITLE' => SITE_NAME)); ?>

<body>
	<div id="wrapper">
		<div class="container">
			<img src="<?= base_url('img/message3.png') ?>" alt="無料相談フォームのご利用ありがとうございます" class="main-message">
			<p class="thanks">
				アクセスいただいたURLに間違いがあるようです。URLの確認をお願いします。<br>
				URLをご確認いただいてもこのページが表示される場合、お知らせしたURLが間違っている可能性がございます。<br>
				その場合はお手数をおかけして申し訳ございませんが、弊社までご連絡いただきますよう、よろしくお願いします。
			</p>

			<div class="contact-box">
				<h2>お問い合わせ先</h2>

				<div class="row justify-content-center">
					<div class="col-6 col-md-3 mt-4">
						広島本社・中四国オフィス<br>
						　TEL:082-227-3999<br>
						　FAX:082-227-4000
					</div>

					<div class="col-6 col-md-3 mt-4">
						東京オフィス<br>
						　TEL:03-5283-5677<br>
						　FAX:03-5283-5685
					</div>

					<div class="col-6 col-md-3 mt-4">
						関西オフィス<br>
						　TEL:06-6399-1400<br>
						　FAX:06-6399-1415
					</div>

					<div class="col-6 col-md-3 mt-4">
						九州オフィス<br>
						　TEL:092-471-7188<br>
						　FAX:092-471-7189
					</div>
				</div> <!-- end of .row -->
			</div>
		</div> <!-- end of .container -->

		<?php $this->load->view('inc/footer'); ?>
	</div> <!-- end of #wrapper -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
