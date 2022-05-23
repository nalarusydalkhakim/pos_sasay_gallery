<?php

class Stock extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['aktif'] = 'stock';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_brand', 'm_brand');
		$this->load->model('M_toko', 'm_toko');
	}

	public function index(){
		$this->data['title'] = 'Stok Barang';
		$this->data['all_brand'] = $this->m_brand->lihat();
		$this->data['no'] = 1;

		$this->data['all_barang'] = $this->m_barang->lihat_public();
		$this->data['data_toko'] = $this->m_toko->lihat();

		$this->load->view('client_side/lihat', $this->data);
	}
}