<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form1 extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');
	}

	public function index()
	{
		$this->set_ref('11');

		$view_data = array(
			'type'	=> '1',
			'CONF'	=> $this->conf
		);

		$this->load->view('front', $view_data);
	}
}
