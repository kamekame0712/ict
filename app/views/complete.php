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

			<ul class="breadcrumb-list mt-5">
				<li>ご入力</li>
				<li>ご確認</li>
				<li class="current">送信完了</li>
			</ul>

			<h2 class="main-message">資料をご請求いただき、ありがとうございます。</h2>
			<p class="thanks">
				資料の準備が整い次第、送付させていただきます。<br>
				ご請求いただきました資料について担当営業からご連絡させていただくことがございます。<br>
				ご質問、ご要望がございましたら、弊社までお問い合わせください。
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
		</div> <!-- end of container -->

		<?php $this->load->view('inc/footer'); ?>
	</div> <!-- end of #wrapper -->

	<?php $this->load->view('inc/_foot'); ?>
</body>
</html>
