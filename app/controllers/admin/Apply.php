<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apply extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		// モデルロード
		$this->load->model('m_apply');
	}

	public function index($page = 1)
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$post_data = $this->input->post();
		$record_num = isset($post_data['record_num']) ? intval($post_data['record_num']) : intval(RECORD_PER_PAGE);

		$apply_data = array();
		$total = 0;
		$pagination = '';
		$showing_record = '';
		if( !empty($post_data) ) {
			$conditions = array(
				'type' 			=> isset($post_data['type']) ? $post_data['type'] : array(),
				'flg_processed'	=> isset($post_data['flg_processed']) ? $post_data['flg_processed'] : '',
				'juku_name'		=> isset($post_data['juku_name']) ? $post_data['juku_name'] : '',
				'pref'			=> isset($post_data['pref']) ? $post_data['pref'] : '',
				'address'		=> isset($post_data['address']) ? $post_data['address'] : '',
				'regist_from'	=> isset($post_data['regist_from']) ? $post_data['regist_from'] : '',
				'regist_to'		=> isset($post_data['regist_to']) ? $post_data['regist_to'] : ''
			);
		}
		else {
			$conditions = array(
				'type' 			=> array('1', '2', '3'),
				'flg_processed'	=> '',
				'juku_name'		=> '',
				'pref'			=> '',
				'address'		=> '',
				'regist_from'	=> '',
				'regist_to'		=> ''
			);
		}

		list($apply_data, $total) = $this->m_apply->get_list_for_admin($conditions, $page, $record_num);

		if( !empty($apply_data) ) {
			$showing_record = ( ($page - 1) * intval($record_num) + 1 ) . '～' . ( count($apply_data) == intval($record_num) ? ( $page * intval($record_num) ) : ( $total ) ) . '（全' . $total . '件）';
			$page_block_num = $record_num != 0 ? ceil($total / $record_num) : 1; // ページブロック数

			$pagination .= '<ul>';
			if( $page != 1 ) {
				$pagination .= '	<li onclick="search_link(' . ($page - 1) . ')">' . '&lt;' . '</li>';
			}
			else {
				$pagination .= '	<li class="not-anchor">' . '&lt;' . '</li>';
			}

			// ページブロックの数が最大数より小さい
			if( (MAX_BEFORE_CURRENT + MAX_AFTER_CURRENT + 1) >= $page_block_num ) {
				for( $i = 1; $i <= $page_block_num; $i++ ) {
					if( $page == $i ) {
						$pagination .= '	<li class="current-page">' . ($i) . '</li>';
					}
					else {
						$pagination .= '	<li onclick="search_link(' . ($i) . ')">' . ($i) . '</li>';
					}
				}
			}
			else {
				if( $page <= MAX_BEFORE_CURRENT + 1 ) {
					for( $i = 1; $i < MAX_BEFORE_CURRENT + MAX_AFTER_CURRENT + 1; $i++ ) {
						if( $page == $i ) {
							$pagination .= '	<li class="current-page">' . ($i) . '</li>';
						}
						else {
							$pagination .= '	<li onclick="search_link(' . ($i) . ')">' . ($i) . '</li>';
						}
					}
					$pagination .= '	<li onclick="search_link(' . ($page_block_num) . ')">...</li>';
				}
				else if( $page >= $page_block_num - MAX_AFTER_CURRENT ) {
					$pagination .= '	<li onclick="search_link(1)">...</li>';
					for( $i = $page_block_num - (MAX_BEFORE_CURRENT + MAX_AFTER_CURRENT + 1) + 1; $i <= $page_block_num; $i++ ) {
						if( $page == $i ) {
							$pagination .= '	<li class="current-page">' . ($i) . '</li>';
						}
						else {
							$pagination .= '	<li onclick="search_link(' . ($i) . ')">' . ($i) . '</li>';
						}
					}
				}
				else {
					$pagination .= '	<li onclick="search_link(1)">...</li>';
					for( $i = $page - MAX_BEFORE_CURRENT; $i <= MAX_AFTER_CURRENT + $page; $i++ ) {
						if( $page == $i ) {
							$pagination .= '	<li class="current-page">' . ($i) . '</li>';
						}
						else {
							$pagination .= '	<li onclick="search_link(' . ($i) . ')">' . ($i) . '</li>';
						}
					}
					$pagination .= '	<li onclick="search_link(' . ($page_block_num) . ')">...</li>';
				}
			}

			if( $page != $page_block_num ) {
				$pagination .= '	<li onclick="search_link(' . ($page + 1) . ')">' . '&gt;' . '</li>';
			}
			else {
				$pagination .= '	<li class="not-anchor">' . '&gt;' . '</li>';
			}
			$pagination .= '</ul>';
		}

		$view_data = array(
			'CONF'			=> $this->conf,
			'ADATA'			=> $apply_data,
			'RECORD_NUM'	=> $record_num,
			'PAGINATION'	=> $pagination,
			'SHOWING'		=> $showing_record
		);

		$this->load->view('admin/apply/index', $view_data);
	}

	public function detail($apply_id = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$apply_data = $this->m_apply->get_one(array('apply_id' => $apply_id));

		$view_data = array(
			'CONF'			=> $this->conf,
			'ADATA'			=> $apply_data
		);

		$this->load->view('admin/apply/detail', $view_data);
	}

	public function dl($apply_id = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$apply_data = $this->m_apply->get_one(array('apply_id' => $apply_id));

		// タイムアウトさせない
		set_time_limit(0);

		$fp = fopen('php://output', 'w');
		stream_filter_append($fp, 'convert.iconv.UTF-8/CP932', STREAM_FILTER_WRITE);

		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . '資料請求' . date('YmdHis') . '.csv');

		if( empty($apply_data) ) {
			fputs($fp, 'no data');
		}
		else {
			$other = $apply_data['other'];
			$other = str_replace("\r\n", "__", $other);
			$other = str_replace("\r", "__", $other);
			$other = str_replace("\n", "__", $other);
			$know = !empty($apply_data['know']) ? $this->conf['know'][$apply_data['know']] : '';

			$csv_array = array(
				$apply_data['apply_id'],
				$apply_data['type'],
				$this->conf['form_type'][$apply_data['type']],
				$apply_data['juku_name'],
				$apply_data['contact_name'],
				$apply_data['position'],
				$apply_data['zip'],
				$this->conf['pref'][$apply_data['pref']] . $apply_data['addr1'],
				$apply_data['addr2'],
				$apply_data['tel'],
				$apply_data['email'],
				$know,
				$other,
				$apply_data['regist_time']
			);
			fputcsv($fp, $csv_array);
		}

		fclose($fp);
	}



	/*******************************************/
	/*                ajax関数                 */
	/*******************************************/
	public function ajax_proc()
	{
		$post_data = $this->input->post();
		$apply_ids = isset($post_data['ids']) ? $post_data['ids'] : array();

		// タイムアウトさせない
		set_time_limit(0);

		$ret_val = array(
			'status'	=> FALSE,
			'err_msg'	=> '',
			'file_url'	=> ''
		);

		if( empty($apply_ids) ) {
			$ret_val['err_msg'] = 'パラメーターエラーが発生しました。';
		}
		else {
			$dl_apply = array();
			$now = date('Y-m-d H:i:s');

			// 自作のヘルパーロード
			$this->load->helper('common');

			// モデルロード
			$this->load->model('m_mail');

			// 設定ファイルロード
			$this->config->load('config_mail', TRUE, TRUE);
			$this->conf_mail = $this->config->item('mail', 'config_mail');

			foreach( $apply_ids as $apply_id ) {
				$apply_data = $this->m_apply->get_one(array('apply_id' => $apply_id));
				if( !empty($apply_data) && $apply_data['flg_processed'] == '1' ) {
					$dl_apply[] = $apply_data;
					$param = get_url_param();

					// メール送信
					$url = site_url('consult/form') . '/' . $param;
					$mail_data = array(
						'juku_name'		=> $apply_data['juku_name'],
						'position'		=> $apply_data['position'],
						'contact_name'	=> $apply_data['contact_name'],
						'url'			=> $url
					);

					$mail_body = $this->load->view('mail/tmpl_send_comp_to_customer', $mail_data, TRUE);
					$params = array(
						'from'		=> $this->conf_mail['management_to_customer']['from'],
						'from_name'	=> $this->conf_mail['management_to_customer']['from_name'],
						'to'		=> $apply_data['email'],
						'subject'	=> '資料送付・無料相談のご案内/中央教育研究所株式会社',
						'message'	=> $mail_body
					);

					$this->m_mail->send($params);

					// データベース更新
					$update_data = array(
						'flg_processed'	=> '9',
						'param'			=> $param,
						'update_time'	=> $now
					);
					$this->m_apply->update(array('apply_id' => $apply_id), $update_data);
				}
			}

			if( !empty($dl_apply) ) {
				// データのダウンロード
				$file_name = '資料請求' . date('YmdHis') . '.csv';
				$file_fullname = WK_FOLDER_PATH . $file_name;
				$fp = fopen('php://temp/maxmemory:5242880', 'w');

				foreach( $dl_apply as $apply_data ) {
					$other = $apply_data['other'];
					$other = str_replace("\r\n", "__", $other);
					$other = str_replace("\r", "__", $other);
					$other = str_replace("\n", "__", $other);
					$know = !empty($apply_data['know']) ? $this->conf['know'][$apply_data['know']] : '';

					$csv_str = '"' .
						$apply_data['apply_id'] . '","' .
						$apply_data['type'] . '","' .
						$this->conf['form_type'][$apply_data['type']] . '","' .
						$apply_data['juku_name'] . '","' .
						$apply_data['contact_name'] . '","' .
						$apply_data['position'] . '","' .
						$apply_data['zip'] . '","' .
						$this->conf['pref'][$apply_data['pref']] . $apply_data['addr1'] . '","' .
						$apply_data['addr2'] . '","' .
						$apply_data['tel'] . '","' .
						$apply_data['email'] . '","' .
						$know . '","' .
						$other . '","' .
						$apply_data['regist_time'] . '"';

					fwrite($fp, mb_convert_encoding($csv_str, 'SJIS', 'UTF-8') . "\r\n");
				}

				rewind($fp);
				file_put_contents($file_fullname, stream_get_contents($fp));
				fclose($fp);
				$ret_val['file_url'] = base_url() . 'wk/' . $file_name;
				$ret_val['status'] = TRUE;
			}
			else {
				$ret_val['err_msg'] = 'ダウンロードする請求データが存在しません。';
			}
		}

		$this->ajax_out(json_encode($ret_val));
	}


}
