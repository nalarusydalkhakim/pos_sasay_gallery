<?php

use Dompdf\Dompdf;

class Mutasi extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'mutasi';
		$this->load->model('M_mutasi', 'm_mutasi');
		$this->load->model('M_bank', 'm_bank');
	}

	public function detail($kode_bank){
		$this->data['title'] = 'Data Mutasi';
		$this->data['bank'] = $this->m_bank->lihat_kode_bank($kode_bank);
		$this->data['all_mutasi'] = $this->m_mutasi->lihat_kode_bank($kode_bank);
		$this->data['no'] = 1;

		// print_r($this->data);

		$this->load->view('mutasi/lihat', $this->data);
	}

	// public function tambah($kode_bank){

	// 	$this->data['title'] = 'Tambah Sub mutasi';
	// 	$this->data['kode_bank'] = $kode_bank;

	// 	$this->load->view('mutasi/tambah', $this->data);
	// }

	// public function proses_tambah(){
	// 	// if ($this->session->login['role'] == 'kasir'){
	// 	// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
	// 	// 	redirect('penjualan');
	// 	// }

	// 	$data = [
	// 		'kode_mutasi' => $this->input->post('kode_mutasi'),
	// 		'kode_pelanggan' => $this->input->post('kode_pelanggan'),
	// 		'nama_mutasi' => $this->input->post('nama_mutasi'),
	// 		'level' => $this->input->post('level'),
	// 	];

	// 	if($this->m_mutasi->tambah($data)){
	// 		$this->session->set_flashdata('success', 'Data mutasi <strong>Berhasil</strong> Ditambahkan!');
	// 		redirect('mutasi/detail/'.$this->input->post('kode_pelanggan'));
	// 	} else {
	// 		$this->session->set_flashdata('error', 'Data mutasi <strong>Gagal</strong> Ditambahkan!');
	// 		redirect('mutasi/detail/'.$this->input->post('kode_pelanggan'));
	// 	}
	// }

	// public function ubah($kode_mutasi){
	// 	$this->data['title'] = 'Ubah Data mutasi';
	// 	$this->data['mutasi'] = $this->m_mutasi->lihat_id($kode_mutasi);

	// 	$this->load->view('mutasi/ubah', $this->data);
	// }

	// public function proses_ubah($kode_mutasi){

	// 	$data = [
	// 		'nama_mutasi' => $this->input->post('nama_mutasi'),
	// 		'level' => $this->input->post('level'),
	// 	];

	// 	if($this->m_mutasi->ubah($data, $kode_mutasi)){
	// 		$this->session->set_flashdata('success', 'Data mutasi strong>Berhasil</strong> Diubah!');
	// 		redirect('mutasi/detail/'.$this->input->post('kode_pelanggan'));
	// 	} else {
	// 		$this->session->set_flashdata('error', 'Data mutasi <strong>Gagal</strong> Diubah!');
	// 		redirect('mutasi/detail/'.$this->input->post('kode_pelanggan'));
	// 	}
	// }

	// public function hapus($kode_mutasi){
		
	// 	if($this->m_mutasi->hapus($kode_mutasi)){
	// 		$this->session->set_flashdata('success', 'Data mutasi <strong>Berhasil</strong> Dihapus!');
	// 		redirect('pelanggan');
	// 	} else {
	// 		$this->session->set_flashdata('error', 'Data mutasi <strong>Gagal</strong> Dihapus!');
	// 		redirect('pelanggan');
	// 	}
	// }

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_kategori'] = $this->m_mutasi->lihat();
		$this->data['title'] = 'Laporan Data Mutasi';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('kategori/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data kategori Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}