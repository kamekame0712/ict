<?php
	$active_apply = $active_consult = $active_dl = $active_manage = '';

	switch( $current ) {
		case 'apply':		$active_apply	= 'class="active"';	break;
		case 'consult':		$active_consult	= 'class="active"';	break;
		case 'dl':			$active_dl		= 'class="active"';	break;
		case 'manage':		$active_manage	= 'class="active"';	break;
	}
?>

<div class="main-sidebar sidebar-style-2">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			<a href="<?= site_url('admin') ?>"><?= SITE_NAME ?></a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?= site_url('admin') ?>">ICT</a>
		</div>

		<ul class="sidebar-menu">
			<li <?= $active_apply ?>><a class="nav-link" href="<?= site_url('admin/apply') ?>"><i class="fas fa-book-open"></i><span>資料請求管理</span></a></li>
			<li <?= $active_consult ?>><a class="nav-link" href="<?= site_url('admin/consult') ?>"><i class="fas fa-comments"></i><span>無料相談管理</span></a></li>
			<li <?= $active_dl ?>><a class="nav-link" href="<?= site_url('admin/dl') ?>"><i class="fas fa-download"></i><span>ダウンロード</span></a></li>
			<li <?= $active_manage ?>><a class="nav-link" href="<?= site_url('admin/manage') ?>"><i class="fas fa-user-tie"></i><span>管理者管理</span></a></li>
		</ul>
	</aside>
</div>
