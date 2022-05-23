<?php

class Bantuan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'bantuan';
	}
	public function index(){
		$this->data['title'] = 'Tutorial Penggunaan';
		$this->load->view('bantuan/tutorial', $this->data);
	}
}