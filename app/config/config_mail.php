<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//****** メール関連config ******

$config['mail'] = array(

	// 管理画面から管理者へ
	'management_to_admin' => array(
		'from'		=> 'info@chuoh-kyouiku.co.jp',
		'from_name'	=> 'ICT資料請求フォーム 管理画面',
		'to'		=> 's-kamei@chuoh-kyouiku.co.jp;kamekame0712@gmail.com'
	),

);
