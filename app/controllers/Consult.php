<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Consult extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_apply');
		$this->load->model('m_consult');

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		// バリデーションエラー設定
		$this->form_validation->set_error_delimiters('<p class="error-msg">', '</p>');
	}

	public function index()
	{
		$this->load->view('consult/error');
	}

	public function form($param = '')
	{
		$apply_data = $this->m_apply->get_list(array('param' => $param));
		$view_page = 'form';
		if( empty($apply_data) || count($apply_data) >= 2 ) {
			$view_page = 'error';
		}

		$view_data = array(
			'ADATA'		=> !empty($apply_data) ? $apply_data[0] : array(),
			'CONF'		=> $this->conf
		);

		$this->load->view('consult/' . $view_page, $view_data);
	}

	public function confirm()
	{
		// リロード対策
		if( $this->input->cookie('consult_complete') ) {
			delete_cookie('consult_complete');
		}

		$post_data = $this->input->post();
		$apply_id = isset($post_data['apply_id']) ? $post_data['apply_id'] : '';
		$product = isset($post_data['product']) ? $post_data['product'] : '';
		$hope_date = isset($post_data['hope_date']) ? $post_data['hope_date'] : '';

		// バリデーションチェック
		$this->form_validation->set_rules('product', '商品名', 'required');
		$this->form_validation->set_rules('substance', 'ご相談内容', 'required');
		$this->form_validation->set_rules('hope_date', 'ご相談日程', 'required');
		$this->form_validation->set_rules('method', 'ご相談方法', 'required');

		if( $product == '99' ) {
			$this->form_validation->set_rules('other_product', 'その他の商品名', 'required');
		}

		if( $hope_date == '3' ) {
			$this->form_validation->set_rules('other_hope_date', 'その他の商品名', 'required');
		}

		if( $this->form_validation->run() == FALSE ) {
			$this->form($post_data['param']);
			return;
		}

		$apply_data = $this->m_apply->get_one(array('apply_id' => $apply_id));

		$view_data = array(
			'TYPE'		=> $apply_data['type'],
			'PDATA'		=> $post_data,
			'CONF'		=> $this->conf
		);

		$this->load->view('consult/confirm', $view_data);
	}

	public function complete()
	{
		// リロード対策
		if( $this->input->cookie('consult_complete') ) {
			redirect('');
		}
		else {
			$cookie_data = array(
				'name'	=> 'consult_complete',
				'value'	=> '1',
				'expire'=> '36000'
			);
			$this->input->set_cookie($cookie_data);
		}

		$post_data = $this->input->post();
		$apply_id = isset($post_data['apply_id']) ? $post_data['apply_id'] : '';
		$product = isset($post_data['product']) ? $post_data['product'] : '';
		$other_product = isset($post_data['other_product']) ? $post_data['other_product'] : '';
		$substance = isset($post_data['substance']) ? $post_data['substance'] : '';
		$hope_date = isset($post_data['hope_date']) ? $post_data['hope_date'] : '';
		$other_hope_date = isset($post_data['other_hope_date']) ? $post_data['other_hope_date'] : '';
		$hope_time = isset($post_data['hope_time']) ? $post_data['hope_time'] : '';
		$method = isset($post_data['method']) ? $post_data['method'] : '';
		$note = isset($post_data['note']) ? $post_data['note'] : '';

		$apply_data = $this->m_apply->get_one(array('apply_id' => $apply_id));
		$type = isset($apply_data['type']) ? $apply_data['type'] : '1';

		$now = date('Y-m-d H:i:s');
		$insert_data = array(
			'apply_id'			=> $apply_id,
			'type'				=> $type,
			'juku_name'			=> $apply_data['juku_name'],
			'product'			=> $product,
			'other_product'		=> $other_product,
			'substance'			=> $substance,
			'hope_date'			=> $hope_date,
			'other_hope_date'	=> $other_hope_date,
			'hope_time'			=> $hope_time,
			'method'			=> $method,
			'note'				=> $note,
			'of_link'			=> '1',
			'flg_handle'		=> '1',
			'regist_time'		=> $now,
			'update_time'		=> $now,
			'status'			=> '0'
		);

		if( $product != '99' ) {
			$product_name = $this->conf['product'][$type][$product];
		}
		else {
			$product_name = $other_product;
		}

		$error_flg = FALSE;
		if( $this->m_consult->insert($insert_data) ) {
			// メール送信
			// モデルロード
			$this->load->model('m_mail');

			// 設定ファイルロード
			$this->config->load('config_mail', TRUE, TRUE);
			$this->conf_mail = $this->config->item('mail', 'config_mail');

			$hope_date_str = '';
			switch( $hope_date ) {
				case '1': $hope_date_str = '希望日程なし';		break;
				case '2': $hope_date_str = '至急';				break;
				case '3': $hope_date_str = $other_hope_date;	break;
			}

			$mail_data = array(
				'juku_name'		=> $apply_data['juku_name'],
				'product_name'	=> $product_name,
				'substance'		=> $this->conf['substance'][$substance],
				'hope_date'		=> $hope_date_str,
				'hope_time'		=> !empty($hope_time) ? $hope_time : '指定なし',
				'method'		=> $this->conf['method'][$method],
				'note'			=> $note,
				'email'			=> $apply_data['email'],
				'tel'			=> $apply_data['tel']
			);

			$mail_body = $this->load->view('mail/tmpl_consult_comp_to_admin', $mail_data, TRUE);
			$params = array(
				'from'		=> $this->conf_mail['management_to_admin']['from'],
				'from_name'	=> $this->conf_mail['management_to_admin']['from_name'],
				'to'		=> $this->conf_mail['management_to_admin']['to'],
				'subject'	=> 'ICTツールの無料相談の依頼がありました。',
				'message'	=> $mail_body
			);

			$this->m_mail->send($params);
		}
		else {
			$error_flg = TRUE;
		}

		$message = '';
		switch( $method ) {
			case '1':
				$message = '担当営業よりお電話させていただきます。';
				break;
			case '2':
				$message = '担当営業よりメールさせていただきます。';
				break;
			case '3':
				$message = '担当営業よりZoomのミーティングIDとパスコードをメールさせていただきます。';
				break;
			case '4':
				$message = '営業訪問させていただきます。';
				break;
			default:
				$message = 'ご連絡させていただきます。';
				break;
		}

		$view_data = array(
			'TYPE'		=> $type,
			'ERR_FLG'	=> $error_flg,
			'PRODUCT'	=> $product_name,
			'MESSAGE'	=> $message
		);

		$this->load->view('consult/complete', $view_data);
	}
}
