<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dl extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		// モデルロード
		$this->load->model('m_apply');
		$this->load->model('m_consult');
		$this->load->model('m_referer');
	}

	public function index()
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$this->load->view('admin/dl/index');
	}

	// 資料請求内容ダウンロード
	public function dl_apply()
	{
		$post_data = $this->input->post();
		$limit_from = isset($post_data['limit_from']) ? $post_data['limit_from'] : '';
		$limit_to = isset($post_data['limit_to']) ? $post_data['limit_to'] : '';

		$apply_data = $this->m_apply->get_list_for_dl($limit_from, $limit_to);

		// タイムアウトさせない
		set_time_limit(0);

		$fp = fopen('php://output', 'w');
		stream_filter_append($fp, 'convert.iconv.UTF-8/CP932', STREAM_FILTER_WRITE);

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . '資料請求一覧' . date('YmdHis') . '.csv');

		if( empty($apply_data) ) {
			fputs($fp, 'no data');
		}
		else {
			$csv_array = array('種別','塾名','申込者名','役職','郵便番号','住所','電話番号','Eメールアドレス','いつ知ったか？','請求日時');
			fputcsv($fp, $csv_array);

			foreach( $apply_data as $val ) {
				$csv_array = array(
					$this->conf['form_type'][$val['type']],
					$val['juku_name'],
					$val['contact_name'],
					$val['position'],
					$val['zip'],
					$this->conf['pref'][$val['pref']] . $val['addr1'] . $val['addr2'],
					$val['tel'],
					$val['email'],
					empty($val['know']) ? '' : $this->conf['know'][$val['know']],
					$val['regist_time']
				);
				fputcsv($fp, $csv_array);
			}
		}

		fclose($fp);
	}

	// 無料相談内容ダウンロード
	public function dl_consult()
	{
		$post_data = $this->input->post();
		$limit_from = isset($post_data['limit_from']) ? $post_data['limit_from'] : '';
		$limit_to = isset($post_data['limit_to']) ? $post_data['limit_to'] : '';

		$consult_data = $this->m_consult->get_list_for_dl($limit_from, $limit_to);

		// タイムアウトさせない
		set_time_limit(0);

		$fp = fopen('php://output', 'w');
		stream_filter_append($fp, 'convert.iconv.UTF-8/CP932', STREAM_FILTER_WRITE);

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . '無料相談一覧' . date('YmdHis') . '.csv');

		if( empty($consult_data) ) {
			fputs($fp, 'no data');
		}
		else {
			$csv_array = array(
				'商品名','相談内容','相談日程','希望時間','相談方法','その他','申請日時',
				'種別','塾名','申込者名','役職','郵便番号','住所',
				'電話番号','Eメールアドレス','資料請求日時'
			);
			fputcsv($fp, $csv_array);

			foreach( $consult_data as $val ) {
				$product = $this->conf['product'][$val['type']][$val['product']];
				if( $val['product'] == '99' && !empty($val['other_product']) ) {
					$product .= '（' . $val['other_product'] . '）';
				}

				$hope_date = '';
				switch( $val['hope_date'] ) {
					case '1':
						$hope_date = '希望日程なし';
						break;
					case '2':
						$hope_date = '至急';
						break;
					case '3':
						$hope_date = $val['other_hope_date'];
						break;
				}

				$csv_array = array(
					$product,
					$this->conf['substance'][$val['substance']],
					$hope_date,
					$val['hope_time'],
					$this->conf['method'][$val['method']],
					preg_replace('/\r\n|\r|\n/', '__', $val['note']),
					$val['regist_time'],
					$this->conf['form_type'][$val['type']],
					$val['juku_name'],
					$val['contact_name'],
					$val['position'],
					$val['zip'],
					$this->conf['pref'][$val['pref']] . $val['addr1'] . $val['addr2'],
					$val['tel'],
					$val['email'],
					$val['apply_time']
				);
				fputcsv($fp, $csv_array);
			}
		}

		fclose($fp);
	}

	// アクセス状況ダウンロード
	public function dl_referer()
	{
		$post_data = $this->input->post();
		$limit_from = isset($post_data['limit_from']) ? $post_data['limit_from'] : '';
		$limit_to = isset($post_data['limit_to']) ? $post_data['limit_to'] : '';

		$referer_data = $this->m_referer->get_list_for_dl($limit_from, $limit_to);

		// タイムアウトさせない
		set_time_limit(0);

		$fp = fopen('php://output', 'w');
		stream_filter_append($fp, 'convert.iconv.UTF-8/CP932', STREAM_FILTER_WRITE);

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . 'アクセス状況' . date('YmdHis') . '.csv');

		if( empty($referer_data) ) {
			fputs($fp, 'no data');
		}
		else {
			$csv_array = array('種別','IPアドレス','ユーザーエージェント','日時');
			fputcsv($fp, $csv_array);

			foreach( $referer_data as $val ) {
				$type = '';
				switch( $val['type'] ) {
					case '11':
						$type = '資料請求フォーム（はじめてのオンライン学習）';
						break;
					case '12':
						$type = '資料請求フォーム（英語4技能のデジタル化）';
						break;
					case '21':
						$type = '無料相談フォーム（はじめてのオンライン学習）';
						break;
					case '22':
						$type = '無料相談フォーム（英語4技能のデジタル化）';
						break;
				}

				$csv_array = array(
					$type,
					$val['remote_addr'],
					$val['user_agent'],
					$val['regist_time']
				);
				fputcsv($fp, $csv_array);
			}
		}

		fclose($fp);
	}
}
