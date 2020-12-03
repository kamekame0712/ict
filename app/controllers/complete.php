<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Complete extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		// モデルロード
		$this->load->model('m_apply');
		$this->load->model('m_mail');

		// 設定ファイルロード
		$this->config->load('config_disp', TRUE, TRUE);
		$this->conf = $this->config->item('disp', 'config_disp');

		$this->config->load('config_mail', TRUE, TRUE);
		$this->conf_mail = $this->config->item('mail', 'config_mail');

		// ヘルパーロード
		$this->load->helper('cookie');
	}

	public function index()
	{
		// リロード対策
		if( $this->input->cookie('apply_complete') ) {
			redirect('');
		}
		else {
			$cookie_data = array(
				'name'	=> 'apply_complete',
				'value'	=> '1',
				'expire'=> '36000'
			);
			$this->input->set_cookie($cookie_data);
		}

		$post_data = $this->input->post();
		$type = isset($post_data['type']) ? $post_data['type'] : '1';
		$juku_name = isset($post_data['juku_name']) ? $post_data['juku_name'] : '';
		$contact_name = isset($post_data['contact_name']) ? $post_data['contact_name'] : '';
		$position = isset($post_data['position']) ? $post_data['position'] : '';
		$zip = isset($post_data['zip']) ? $post_data['zip'] : '';
		$pref = isset($post_data['pref']) ? $post_data['pref'] : '';
		$addr1 = isset($post_data['addr1']) ? $post_data['addr1'] : '';
		$addr2 = isset($post_data['addr2']) ? $post_data['addr2'] : '';
		$tel = isset($post_data['tel']) ? $post_data['tel'] : '';
		$email = isset($post_data['email']) ? $post_data['email'] : '';
		$know = isset($post_data['know']) ? $post_data['know'] : '';
		$other = isset($post_data['other']) ? $post_data['other'] : '';

		$now = date('Y-m-d H:i:s');
		$insert_data = array(
			'type'			=> $type,
			'juku_name'		=> $juku_name,
			'contact_name'	=> $contact_name,
			'position'		=> $position,
			'zip'			=> $zip,
			'pref'			=> $pref,
			'addr1'			=> $addr1,
			'addr2'			=> $addr2,
			'tel'			=> $tel,
			'email'			=> $email,
			'know'			=> $know,
			'other'			=> $other,
			'regist_time'	=> $now,
			'update_time'	=> $now,
			'status'		=> '0'
		);

		$error_flg = FALSE;
		if( $this->m_apply->insert($insert_data) ) {
			// メール送信
			$questionnaire = $know == '' ? '' : $this->conf['know'][$know] . ( $know == '9' ? ( '（' . $other . '）' ) : '' );

			$mail_data = array(
				'type'			=> $this->conf['form_type'][$type],
				'juku_name'		=> $juku_name,
				'contact_name'	=> $contact_name,
				'position'		=> $position,
				'zip'			=> '〒' . $zip,
				'address'		=> $this->conf['pref'][$pref] . $addr1 . $addr2,
				'tel'			=> $tel,
				'email'			=> $email,
				'know'			=> $questionnaire
			);

			// お客様宛
			$mail_body = $this->load->view('mail/tmpl_apply_comp_to_customer', $mail_data, TRUE);
			$params = array(
				'from'		=> $this->conf_mail['management_to_customer']['from'],
				'from_name'	=> $this->conf_mail['management_to_customer']['from_name'],
				'to'		=> $email,
				'subject'	=> 'ICTツールの資料をご請求いただき、ありがとうございます。',
				'message'	=> $mail_body
			);

			$this->m_mail->send($params);

			// 社内宛
			$mail_body = $this->load->view('mail/tmpl_apply_comp_to_admin', $mail_data, TRUE);
			$params = array(
				'from'		=> $this->conf_mail['management_to_admin']['from'],
				'from_name'	=> $this->conf_mail['management_to_admin']['from_name'],
				'to'		=> $this->conf_mail['management_to_admin']['to'],
				'subject'	=> 'ICTツールの資料請求がありました。',
				'message'	=> $mail_body
			);

			$this->m_mail->send($params);
		}
		else {
			$error_flg = TRUE;
		}

		$view_data = array(
			'type'		=> $type,
			'ERR_FLG'	=> $error_flg
		);

		$this->load->view('complete', $view_data);
	}
}
