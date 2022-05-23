<?php

use Dompdf\Dompdf;

class Kategori extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'barang';
		$this->load->model('M_kategori', 'm_kategori');
	}

	public function index(){
		$this->data['title'] = 'Data kategori';
		$this->data['all_kategori'] = $this->m_kategori->lihat();
		$this->data['no'] = 1;

		$this->load->view('kategori/lihat', $this->data);
	}

	public function tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$this->data['title'] = 'Tambah kategori';

		$this->load->view('kategori/tambah', $this->data);
	}

	public function proses_tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_kategori' => $this->input->post('kode_kategori'),
			'nama_kategori' => $this->input->post('nama_kategori'),
		];

		if($this->m_kategori->tambah($data)){
			$this->session->set_flashdata('success', 'Data kategori <strong>Berhasil</strong> Ditambahkan!');
			redirect('kategori');
		} else {
			$this->session->set_flashdata('error', 'Data kategori <strong>Gagal</strong> Ditambahkan!');
			redirect('kategori');
		}
	}

	public function ubah($kode_kategori){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }
		$this->data['title'] = 'Ubah kategori';
		$this->data['kategori'] = $this->m_kategori->lihat_id($kode_kategori);

		$this->load->view('kategori/ubah', $this->data);
	}

	public function proses_ubah($kode_kategori){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_kategori' => $this->input->post('kode_kategori'),
			'nama_kategori' => $this->input->post('nama_kategori'),
		];

		if($this->m_kategori->ubah($data, $kode_kategori)){
			$this->session->set_flashdata('success', 'Data kategori <strong>Berhasil</strong> Diubah!');
			redirect('kategori');
		} else {
			$this->session->set_flashdata('error', 'Data kategori <strong>Gagal</strong> Diubah!');
			redirect('kategori');
		}
	}

	public function hapus($kode_kategori){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
		// 	redirect('penjualan');
		// }
		
		if($this->m_kategori->hapus($kode_kategori)){
			$this->session->set_flashdata('success', 'Data kategori <strong>Berhasil</strong> Dihapus!');
			redirect('kategori');
		} else {
			$this->session->set_flashdata('error', 'Data kategori <strong>Gagal</strong> Dihapus!');
			redirect('kategori');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_kategori'] = $this->m_kategori->lihat();
		$this->data['title'] = 'Laporan Data kategori';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('kategori/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data kategori Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}