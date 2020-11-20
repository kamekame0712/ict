<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form2 extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('front/form2');
	}
}
