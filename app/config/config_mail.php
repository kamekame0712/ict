<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//****** メール関連config ******

$config['mail'] = array(

	// システムから管理者へ
	'management_to_admin' => array(
		'from'		=> 'kouhou@chuoh-kyouiku.co.jp',
		'from_name'	=> 'ICTツール資料申込管理',
		'to'		=> 's-kamei@chuoh-kyouiku.co.jp'
	),

	// システムからお客様へ
	'management_to_customer' => array(
		'from'		=> 'kouhou@chuoh-kyouiku.co.jp',
		'from_name'	=> 'ICTツール資料請求フォーム'
	),

);
