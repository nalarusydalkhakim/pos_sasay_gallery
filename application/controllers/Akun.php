<?php

use Dompdf\Dompdf;

class Akun extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'pengeluaran';
		$this->load->model('M_akun', 'm_akun');
	}

	public function index(){
		$this->data['title'] = 'Data Akun';
		$this->data['all_akun'] = $this->m_akun->lihat();
		$this->data['no'] = 1;

		$this->load->view('akun/lihat', $this->data);
	}

	public function tambah(){

		$this->data['title'] = 'Tambah akun';

		$this->load->view('akun/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			'kode_akun' => $this->input->post('kode_akun'),
			'nama_akun' => $this->input->post('nama_akun'),
			'no_akun' => $this->input->post('no_akun'),
		];

		if($this->m_akun->tambah($data)){
			$this->session->set_flashdata('success', 'Data Akun <strong>Berhasil</strong> Ditambahkan!');
			redirect('akun');
		} else {
			$this->session->set_flashdata('error', 'Data Akun <strong>Gagal</strong> Ditambahkan!');
			redirect('akun');
		}
	}

	public function ubah($kode_akun){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }
		$this->data['title'] = 'Ubah akun';
		$this->data['akun'] = $this->m_akun->lihat_kode($kode_akun);

		$this->load->view('akun/ubah', $this->data);
	}

	public function proses_ubah($kode_akun){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'nama_akun' => $this->input->post('nama_akun'),
			'no_akun' => $this->input->post('no_akun'),
		];

		if($this->m_akun->ubah($data, $kode_akun)){
			$this->session->set_flashdata('success', 'Data akun <strong>Berhasil</strong> Diubah!');
			redirect('akun');
		} else {
			$this->session->set_flashdata('error', 'Data akun <strong>Gagal</strong> Diubah!');
			redirect('akun');
		}
	}

	public function hapus($kode_akun){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
		// 	redirect('penjualan');
		// }
		
		if($this->m_akun->hapus($kode_akun)){
			$this->session->set_flashdata('success', 'Data akun <strong>Berhasil</strong> Dihapus!');
			redirect('akun');
		} else {
			$this->session->set_flashdata('error', 'Data akun <strong>Gagal</strong> Dihapus!');
			redirect('akun');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_akun'] = $this->m_akun->lihat();
		$this->data['title'] = 'Laporan Data akun';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('akun/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data akun Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}