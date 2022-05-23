<?php

use Dompdf\Dompdf;

class Brand extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'brand';
		$this->load->model('M_brand', 'm_brand');
	}

	public function index(){
		$this->data['title'] = 'Data Brand';
		$this->data['all_brand'] = $this->m_brand->lihat();
		$this->data['no'] = 1;

		$this->load->view('brand/lihat', $this->data);
	}

	public function tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$this->data['title'] = 'Tambah brand';

		$this->load->view('brand/tambah', $this->data);
	}

	public function proses_tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_brand' => $this->input->post('kode_brand'),
			'nama_brand' => $this->input->post('nama_brand'),
		];

		if($this->m_brand->tambah($data)){
			$this->session->set_flashdata('success', 'Data brand <strong>Berhasil</strong> Ditambahkan!');
			redirect('brand');
		} else {
			$this->session->set_flashdata('error', 'Data brand <strong>Gagal</strong> Ditambahkan!');
			redirect('brand');
		}
	}

	public function ubah($kode_brand){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }
		$this->data['title'] = 'Ubah Brand';
		$this->data['brand'] = $this->m_brand->lihat_id($kode_brand);

		$this->load->view('brand/ubah', $this->data);
	}

	public function proses_ubah($kode_brand){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_brand' => $this->input->post('kode_brand'),
			'nama_brand' => $this->input->post('nama_brand'),
		];

		if($this->m_brand->ubah($data, $kode_brand)){
			$this->session->set_flashdata('success', 'Data brand <strong>Berhasil</strong> Diubah!');
			redirect('brand');
		} else {
			$this->session->set_flashdata('error', 'Data brand <strong>Gagal</strong> Diubah!');
			redirect('brand');
		}
	}

	public function hapus($kode_brand){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
		// 	redirect('penjualan');
		// }
		
		if($this->m_brand->hapus($kode_brand)){
			$this->session->set_flashdata('success', 'Data brand <strong>Berhasil</strong> Dihapus!');
			redirect('brand');
		} else {
			$this->session->set_flashdata('error', 'Data brand <strong>Gagal</strong> Dihapus!');
			redirect('brand');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_brand'] = $this->m_brand->lihat();
		$this->data['title'] = 'Laporan Data brand';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('brand/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data brand Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}