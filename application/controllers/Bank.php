<?php

use Dompdf\Dompdf;

class Bank extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'bank';
		$this->load->model('M_bank', 'm_bank');
		$this->load->model('M_mutasi', 'm_mutasi');
	}

	public function index(){
		$this->data['title'] = 'Data bank';
		$this->data['all_bank'] = $this->m_bank->lihat();
		$this->data['no'] = 1;

		$this->load->view('bank/lihat', $this->data);
	}

	public function tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$this->data['title'] = 'Tambah Bank';

		$this->load->view('bank/tambah', $this->data);
	}

	public function proses_tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_bank' => $this->input->post('kode_bank'),
			'nama_bank' => $this->input->post('nama_bank'),
			'nama_pemilik' => $this->input->post('nama_pemilik'),
			'no_rekening' => $this->input->post('no_rekening'),
		];

		if($this->m_bank->tambah($data)){
			$this->session->set_flashdata('success', 'Data Bank <strong>Berhasil</strong> Ditambahkan!');
			redirect('bank');
		} else {
			$this->session->set_flashdata('error', 'Data Bank <strong>Gagal</strong> Ditambahkan!');
			redirect('bank');
		}
	}

	public function ubah($kode_bank){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }
		$this->data['title'] = 'Ubah Bank';
		$this->data['bank'] = $this->m_bank->lihat_id($kode_bank);

		$this->load->view('bank/ubah', $this->data);
	}

	public function proses_ubah($kode_bank){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_bank' => $this->input->post('kode_bank'),
			'nama_bank' => $this->input->post('nama_bank'),
			'nama_pemilik' => $this->input->post('nama_pemilik'),
			'no_rekening' => $this->input->post('no_rekening'),
		];

		if($this->m_bank->ubah($data, $kode_bank)){
			$this->session->set_flashdata('success', 'Data Bank <strong>Berhasil</strong> Diubah!');
			redirect('bank');
		} else {
			$this->session->set_flashdata('error', 'Data Bank <strong>Gagal</strong> Diubah!');
			redirect('bank');
		}
	}

	public function hapus($kode_bank){
		
		if($this->m_bank->hapus($kode_bank) && $this->m_mutasi->hapus_kode_bank($kode_bank)){
			$this->session->set_flashdata('success', 'Data bank <strong>Berhasil</strong> Dihapus!');
			redirect('bank');
		} else {
			$this->session->set_flashdata('error', 'Data bank <strong>Gagal</strong> Dihapus!');
			redirect('bank');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_bank'] = $this->m_bank->lihat();
		$this->data['title'] = 'Laporan Data bank';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('bank/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data bank Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}