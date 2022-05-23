<?php

use Dompdf\Dompdf;

class Level extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'level';
		$this->load->model('M_level_pelanggan', 'm_level_pelanggan');
	}

	public function index(){
		$this->data['title'] = 'Data Level Pelanggan';
		$this->data['all_level'] = $this->m_level_pelanggan->lihat();
		$this->data['no'] = 1;

		$this->load->view('level/lihat', $this->data);
	}

	public function tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$this->data['title'] = 'Tambah Level';

		$this->load->view('level/tambah', $this->data);
	}

	public function proses_tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_level' => $this->input->post('kode_level'),
			'nama_level' => $this->input->post('nama_level'),
			'diskon' => $this->input->post('diskon'),
			'target' => $this->input->post('target'),
		];

		if($this->m_level_pelanggan->tambah($data)){
			$this->session->set_flashdata('success', 'Data Level <strong>Berhasil</strong> Ditambahkan!');
			redirect('level');
		} else {
			$this->session->set_flashdata('error', 'Data Level <strong>Gagal</strong> Ditambahkan!');
			redirect('level');
		}
	}

	public function ubah($kode_level){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }
		$this->data['title'] = 'Ubah Level';
		$this->data['level'] = $this->m_level_pelanggan->lihat_id($kode_level);

		$this->load->view('level/ubah', $this->data);
	}

	public function proses_ubah($kode_level){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_level' => $this->input->post('kode_level'),
			'nama_level' => $this->input->post('nama_level'),
			'diskon' => $this->input->post('diskon'),
			'target' => $this->input->post('target'),
		];

		if($this->m_level_pelanggan->ubah($data, $kode_level)){
			$this->session->set_flashdata('success', 'Data Level <strong>Berhasil</strong> Diubah!');
			redirect('level');
		} else {
			$this->session->set_flashdata('error', 'Data Level <strong>Gagal</strong> Diubah!');
			redirect('level');
		}
	}

	public function hapus($kode_level){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
		// 	redirect('penjualan');
		// }
		
		if($this->m_level_pelanggan->hapus($kode_level)){
			$this->session->set_flashdata('success', 'Data Level <strong>Berhasil</strong> Dihapus!');
			redirect('level');
		} else {
			$this->session->set_flashdata('error', 'Data Level <strong>Gagal</strong> Dihapus!');
			redirect('level');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_level'] = $this->m_level_pelanggan->lihat();
		$this->data['title'] = 'Laporan Data level';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('level/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data level Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}