<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confirm extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

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

		// バリデーションチェック
		if( $this->form_validation->run('apply') == FALSE ) {
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
