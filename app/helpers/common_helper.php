<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  サービス共通ユーティリティ関数
 */

/**
 * ワンタイムURL用のパラメータを返す
 *
 */
function get_url_param($num = 32)
{
	// パスワードに使う文字列
	$pass_str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';
	$param = '';

	for( $i = 0; $i < $num; $i++ ) {
		$s = mt_rand(0, 63);
		$param .= substr($pass_str, $s, 1);
	}

	return $param;
}
