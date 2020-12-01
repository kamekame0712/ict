<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confirm extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		// ヘルパーロード
		$this->load->helper('cookie');

		// バリデーションエラー設定
		$this->form_validation->set_error_delimiters('<p class="error-msg">', '</p>');
	}

	public function index()
	{
		// リロード対策
		if( $this->input->cookie('apply_complete') ) {
			delete_cookie('apply_complete');
		}

		$post_data = $this->input->post();
		$type = isset($post_data['type']) ? $post_data['type'] : '1';
		$know = isset($post_data['know']) ? $post_data['know'] : '';

		$this->form_validation->set_rules('juku_name', '貴塾名', 'required');
		$this->form_validation->set_rules('contact_name', 'お名前', 'required');
		$this->form_validation->set_rules('zip', '郵便番号', 'required');
		$this->form_validation->set_rules('pref', '都道府県', 'required');
		$this->form_validation->set_rules('addr1', '住所（市区郡以下、番地まで）', 'required');
		$this->form_validation->set_rules('addr2', '住所（建物名・部屋番号）', 'required');
		$this->form_validation->set_rules('tel', '電話番号', 'required');
		$this->form_validation->set_rules('email', 'Eメールアドレス', 'required|valid_email');
		$this->form_validation->set_rules('know', 'アンケート', 'required');

		if( $know == '9' ) {
			$this->form_validation->set_rules('other', '詳細', 'required');
		}

		// バリデーションチェック
		if( $this->form_validation->run() == FALSE ) {
			$view_data = array(
				'type'	=> $type,
				'CONF'	=> $this->conf,
			);

			$this->load->view('front', $view_data);
			return;
		}

		$view_data = array(
			'CONF'	=> $this->conf,
			'PDATA'	=> $post_data
		);

		$this->load->view('confirm', $view_data);
	}
}
