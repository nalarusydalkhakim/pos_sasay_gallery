<?php

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'dashboard';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_brand', 'm_brand');
		$this->load->model('M_kasir', 'm_kasir');
		$this->load->model('M_penjualan', 'm_penjualan');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_detail_penjualan', 'm_detail_penjualan');
		$this->load->model('M_pengguna', 'm_pengguna');
		$this->load->model('M_pelanggan', 'm_pelanggan');
		$this->load->model('M_toko', 'm_toko');
	}
	public function index(){
		$this->data['title'] = 'Halaman Dashboard';

		// $tahun = date("Y");
		// // $this->data['harga_barang'] = $this->m_detail_penjualan->total_harga_barang();
		
		// $this->data['jumlah_kasir'] = $this->m_kasir->jumlah();
		// // $this->data['jumlah_penjualan'] = $this->m_penjualan->jumlah();
		// $this->data['jumlah_pelanggan'] = $this->m_pelanggan->jumlah();
		
		//card info
		$this->data['total_pengeluaran'] = $this->m_pengeluaran->jumlah_total_pengeluaran();
		$this->data['omset_penjualan'] = $this->m_penjualan->jumlah_total_omset();
		$this->data['harga_pokok'] = $this->m_detail_penjualan->harga_pokok_produksi();
		$this->data['total_hutang'] = $this->m_pengeluaran->jumlah_hutang();
		$this->data['jumlah_penjualan'] = $this->m_penjualan->jumlah();
		$this->data['jumlah_barang'] = $this->m_barang->jumlah();
		$this->data['jumlah_item_terjual'] = $this->m_detail_penjualan->jumlah_item_terjual();
		$this->data['jumlah_pelanggan'] = $this->m_pelanggan->jumlah();
		$this->data['modal_ditoko'] = $this->m_barang->modal_ditoko();
		$this->data['total_piutang'] = $this->m_pelanggan->jumlah_total_hutang();
		$this->data['total_deposit'] = $this->m_pelanggan->jumlah_total_deposit();
		//chart
		$this->data['get_omset'] = $this->m_penjualan->get_omset_bulan();
		$this->data['get_pengeluaran'] = $this->m_pengeluaran->get_pengeluaran_bulan();
		$this->data['get_hpp'] = $this->m_detail_penjualan->get_harga_pokok_produksi_bulan();
		// $data_laba = [];
		// foreach ($this->data['get_omset'] as $data) {
		// 	$laba = $data->omset - $this->data['get_pengeluaran']->pengeluaran - $this->data['get_hpp']->hpp;
		// 	array_push($data_laba, $laba);
		// }

		// print_r($data_laba );

		$this->data['toko'] = $this->m_toko->lihat();
		$this->load->view('dashboard', $this->data);
	}
	public function getOmsetBulan()
	{
		$data = $this->m_penjualan->get_omset_bulan();
		echo json_encode($data);
	}
}