<?php
/**
 * 共通コントローラ
 */
class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// 言語ヘルパー
		$this->load->helper(array('language'));

		date_default_timezone_set('Asia/Tokyo');
	}



	/*****************************************/
	/*                                       */
	/*    各コントローラー共通の関数         */
	/*                                       */
	/*****************************************/
	// ログイン済みチェック（管理画面）
	protected function chk_logged_in_admin()
	{
		if( $this->session->userdata('admin_id') == FALSE ) {
			return FALSE;
		}
		else {
			return TRUE;
		}
	}

	// Ajax出力
	protected function ajax_out($data)
	{
		$this->output
			->set_content_type('json','utf-8')
			->set_header('Cache-Control: no-cache, must-revalidate')
			->set_header('Pragma: no-cache')
			->set_output($data);
	}



	/*****************************************/
	/*                                       */
	/*    バリデーション コールバック関数    */
	/*                                       */
	/*****************************************/
	// ログイン（管理画面）
	public function possible_admin_login()
	{
		// モデルロード
		$this->load->model('m_admin');

		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';

		$login_flg = $this->m_admin->possible_login($email, $password);
		if( $login_flg == FALSE ) {
			$this->form_validation->set_message('possible_admin_login', '入力内容に誤りがあります。');
			return FALSE;
		}

		return TRUE;
	}
}
