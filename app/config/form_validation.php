<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(

	// ログイン（管理画面）
	'login_admin' => array(
		array(
			'field' => 'email',
			'label' => 'メールアドレス',
			'rules' => 'required'
		),

		array(
			'field' => 'password',
			'label' => 'パスワード',
			'rules' => 'required|callback_possible_admin_login'
		)
	),

	// 申込
	'apply' => array(
		array(
			'field' => 'juku_name',
			'label' => '貴塾名',
			'rules' => 'required'
		),

		array(
			'field' => 'contact_name',
			'label' => 'お名前',
			'rules' => 'required'
		),

		array(
			'field' => 'zip',
			'label' => '郵便番号',
			'rules' => 'required'
		),

		array(
			'field' => 'pref',
			'label' => '都道府県',
			'rules' => 'required'
		),

		array(
			'field' => 'addr1',
			'label' => '住所（市区郡以下、番地まで）',
			'rules' => 'required'
		),

		array(
			'field' => 'addr2',
			'label' => '住所（建物名・部屋番号）',
			'rules' => 'required'
		),

		array(
			'field' => 'tel',
			'label' => '電話番号',
			'rules' => 'required'
		),

		array(
			'field' => 'email',
			'label' => 'Eメールアドレス',
			'rules' => 'required|valid_email'
		)
	),

);
