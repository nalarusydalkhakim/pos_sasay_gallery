<?php

use Dompdf\Dompdf;

class Pelanggan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'pelanggan';
		$this->load->model('M_pelanggan', 'm_pelanggan');
		$this->load->model('M_member', 'm_member');
		$this->load->model('M_brand', 'm_brand');
		$this->load->model('M_penjualan', 'm_penjualan');
		$this->load->model('M_brand', 'm_brand');
	}

	public function index(){
		$this->data['title'] = 'Data Customer';
		$this->data['all_pelanggan'] = $this->m_pelanggan->lihat();
		$this->data['no'] = 1;

		$this->load->view('pelanggan/lihat', $this->data);
	}

	// Start Laporan Side
	public function laporan(){
		
		$brand = $this->input->post('brand');
		$bulan = $this->input->post('bulan');
		$tahun  = $this->input->post('tahun');
		$info = $bulan." ".$tahun;

		if (isset($brand)) {
			if(isset($bulan) && !empty($tahun)) {
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_brand_waktu($brand, $tahun, $bulan);
				$this->data['keterangan'] = $info;
			}elseif (empty($bulan) & isset($tahun)) {
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_brand_tahun($brand, $tahun);
				$this->data['keterangan'] = $info;
			}else{
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_brand($brand);
				$this->data['keterangan'] = "General";
			}
		}else{
			if(isset($bulan) && !empty($tahun)) {
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_waktu($tahun, $bulan);
				$this->data['keterangan'] = $info;
			}elseif (empty($bulan) & isset($tahun)) {
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_tahun($tahun);
				$this->data['keterangan'] = $info;
			}else{
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total();
				$this->data['keterangan'] = "General";
			}
		}

		$this->data['title'] = 'Laporan Customer';
		$this->data['get_bulan'] = $this->m_penjualan->get_bulan();
		$this->data['get_tahun'] = $this->m_penjualan->get_tahun();
		$this->data['get_brand'] = $this->m_brand->get_brand();
		$this->data['no'] = 1;

		$this->load->view('pelanggan/laporan', $this->data);
	}

	public function detail_laporan($kode_pelanggan)
	{
		$this->data['title'] = 'Detail Laporan Customer';
		$this->data['pelanggan'] = $this->m_pelanggan->lihat_kode($kode_pelanggan);
		$this->data['all_transaksi'] = $this->m_penjualan->lihat_join_pelanggan_by_kode_pelanggan($kode_pelanggan);
		$this->data['no'] = 1;

		$this->load->view('pelanggan/detail_laporan', $this->data);
	}
	// end of laporan side

	public function tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$this->data['title'] = 'Tambah Customer';

		$this->load->view('pelanggan/tambah', $this->data);
	}

	public function proses_tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),
			'level' => $this->input->post('level'),
			'alamat' => $this->input->post('alamat'),
			'saldo' => $this->input->post('saldo'),
		];

		if($this->m_pelanggan->tambah($data)){
			$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Ditambahkan!');
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Ditambahkan!');
			redirect('pelanggan');
		}
	}

	public function ubah($id){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$this->data['title'] = 'Ubah Customer';
		$this->data['pelanggan'] = $this->m_pelanggan->lihat_id($id);

		$this->load->view('pelanggan/ubah', $this->data);
	}

	public function proses_ubah($id){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'nama_pelanggan' => $this->input->post('nama_pelanggan'),
			'level' => $this->input->post('level'),
			'alamat' => $this->input->post('alamat'),
			'saldo' => $this->input->post('saldo'),
		];

		if($this->m_pelanggan->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Diubah!');
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Diubah!');
			redirect('pelanggan');
		}
	}

	public function hapus($kode_pelanggan){

		if($this->m_pelanggan->hapus($kode_pelanggan) && $this->m_member->hapus_by_kode_pelanggan($kode_pelanggan) ){
			$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Dihapus!');
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Dihapus!');
			redirect('pelanggan');
		}
	}

	public function export(){
		$dompdf = new Dompdf();

		$brand = $this->input->post('modal_brand');
		$bulan = $this->input->post('modal_bulan');
		$tahun  = $this->input->post('modal_tahun');
		$info = $brand." ".$bulan." ".$tahun;

		if (isset($brand)) {
			if(isset($bulan) && !empty($tahun)) {
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_brand_waktu($brand, $tahun, $bulan);
				$this->data['keterangan'] = $info;
			}elseif (empty($bulan) & isset($tahun)) {
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_brand_tahun($brand, $tahun);
				$this->data['keterangan'] = $info;
			}else{
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_brand($brand);
				$this->data['keterangan'] = "General";
			}
		}else{
			if(isset($bulan) && !empty($tahun)) {
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_waktu($tahun, $bulan);
				$this->data['keterangan'] = $info;
			}elseif (empty($bulan) & isset($tahun)) {
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total_tahun($tahun);
				$this->data['keterangan'] = $info;
			}else{
				$this->data['all_pelanggan'] = $this->m_pelanggan->lihat_total();
				$this->data['keterangan'] = "General";
			}
		}
		$this->data['title'] = 'Laporan Penjualan Member';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pelanggan/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Member ' . $info, array("Attachment" => false));
	}
}