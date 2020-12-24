<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consult extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		// モデルロード
		$this->load->model('m_consult');
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

		$consult_data = array();
		$total = 0;
		$pagination = '';
		$showing_record = '';
		if( !empty($post_data) ) {
			$conditions = array(
				'product' 		=> isset($post_data['product']) ? $post_data['product'] : '',
				'substance' 	=> isset($post_data['substance']) ? $post_data['substance'] : '',
				'flg_handle' 	=> isset($post_data['flg_handle']) ? $post_data['flg_handle'] : '',
				'juku_name'		=> isset($post_data['juku_name']) ? $post_data['juku_name'] : '',
				'regist_from'	=> isset($post_data['regist_from']) ? $post_data['regist_from'] : '',
				'regist_to'		=> isset($post_data['regist_to']) ? $post_data['regist_to'] : ''
			);
		}
		else {
			$conditions = array(
				'product'		=> '',
				'substance'		=> '',
				'flg_handle'	=> '',
				'juku_name'		=> '',
				'regist_from'	=> '',
				'regist_to'		=> ''
			);
		}

		list($consult_data, $total) = $this->m_consult->get_list_for_admin($conditions, $page, $record_num);

		if( !empty($consult_data) ) {
			$showing_record = ( ($page - 1) * intval($record_num) + 1 ) . '～' . ( count($consult_data) == intval($record_num) ? ( $page * intval($record_num) ) : ( $total ) ) . '（全' . $total . '件）';
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

		$product_list = array('' => '選択してください');
		foreach( $this->conf['product'] as $type => $products ) {
			if( !empty($products) ) {
				foreach( $products as $code => $name ) {
					if( $code != '' ) {
						if( array_key_exists($this->conf['form_type'][$type], $product_list) ) {
							$product_list[$this->conf['form_type'][$type]][$type . $code] = $name;
						}
						else {
							$product_list[$this->conf['form_type'][$type]] = array($type . $code => $name);
						}
					}
				}
			}
		}

		$view_data = array(
			'CONF'			=> $this->conf,
			'PLIST'			=> $product_list,
			'CDATA'			=> $consult_data,
			'RECORD_NUM'	=> $record_num,
			'PAGINATION'	=> $pagination,
			'SHOWING'		=> $showing_record
		);

		$this->load->view('admin/consult/index', $view_data);
	}

	public function detail($consult_id = '')
	{
		// ログイン済みチェック
		if( !$this->chk_logged_in_admin() ) {
			redirect('admin');
			return;
		}

		$consult_data = $this->m_consult->get_one(array('consult_id' => $consult_id));
		if( !empty($consult_data) ) {
			$apply_data = $this->m_apply->get_one(array('apply_id' => $consult_data['apply_id']));
		}
		else {
			$apply_data = array();
		}

		$view_data = array(
			'CONF'	=> $this->conf,
			'CDATA'	=> $consult_data,
			'ADATA'	=> $apply_data
		);

		$this->load->view('admin/consult/detail', $view_data);
	}



	/*******************************************/
	/*                ajax関数                 */
	/*******************************************/
	public function ajax_change_status()
	{
		$post_data = $this->input->post();
		$consult_id = isset($post_data['consult_id']) ? $post_data['consult_id'] : '';
		$flg_handle = isset($post_data['flg_handle']) ? $post_data['flg_handle'] : '';

		$ret_val = array();

		if( $consult_id != '' && $flg_handle != '' ) {
			$update_data = array(
				'flg_handle'	=> $flg_handle,
				'update_time'	=> date('Y-m-d H:i:s')
			);

			$this->m_consult->update(array('consult_id' => $consult_id), $update_data);
		}

		$this->ajax_out(json_encode($ret_val));
	}
}
