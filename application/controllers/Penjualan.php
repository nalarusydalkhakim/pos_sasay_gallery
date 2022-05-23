<?php

use Dompdf\Dompdf;

class Penjualan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_penjualan', 'm_penjualan');
		$this->load->model('M_detail_penjualan', 'm_detail_penjualan');
		$this->load->model('M_toko', 'm_toko');
		$this->load->model('M_bank', 'm_bank');
		$this->load->model('M_mutasi', 'm_mutasi');
		$this->load->model('M_pelanggan', 'm_pelanggan');
		$this->data['aktif'] = 'penjualan';
	}

	public function index(){
		$this->data['title'] = 'Data Penjualan';

		//pagination
		$this->load->library('pagination');

		//search
		if ($this->input->post('keyword')) {
			$this->data['keyword'] = $this->input->post('keyword');
		}else{
			$this->data['keyword'] = null;
		}

		//congif_pagination
		$config['base_url'] = base_url('penjualan/index');
		$config['total_rows'] = $this->m_penjualan->jumlah();
		$config['per_page'] = 10;

		$this->pagination->initialize($config);

		$this->data['start'] = $this->uri->segment(3);
		$this->data['all_penjualan'] = $this->m_penjualan->lihat_join_pelanggan_pagination($config['per_page'], $this->data['start'], $this->data['keyword']);
		$this->data['get_tahun'] = $this->m_penjualan->get_tahun();

		$this->load->view('penjualan/lihat', $this->data);
	}


	public function tambah(){
		$this->data['title'] = 'Tambah Penjualan';
		$this->data['all_barang'] = $this->m_barang->lihat_stok();
		$this->data['all_pelanggan'] = $this->m_pelanggan->lihat();
		$this->data['all_bank'] = $this->m_bank->lihat();

		$this->load->view('penjualan/tambah', $this->data);
		// print_r($this->data['all_bank'] );
	}

	public function proses_tambah(){
		$jumlah_barang_dibeli = count($this->input->post('kode_barang_hidden'));
		
		$data_penjualan = [
			'no_penjualan' => $this->input->post('no_penjualan'),
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'nama_kasir' => $this->input->post('nama_kasir'),
			'tgl_penjualan' => $this->input->post('tgl_penjualan'),
			'jam_penjualan' => $this->input->post('jam_penjualan'),
			'total' => $this->input->post('total_hidden'),
			'diskon' => $this->input->post('diskon_total'),
			'jumlah_total' => $this->input->post('jumlah_total_hidden'),
			// metode_pembayaran
			'metode_pembayaran' => $this->input->post('metode_pembayaran'),
		];

		$metode_pembayaran = $this->input->post('metode_pembayaran');
		$kredit_payment_validation = $this->input->post('kredit_validation');
		$sistem_pembayaran = $this->input->post('sistem_pembayaran');

		if ($metode_pembayaran == 'kredit') {
			if ($kredit_payment_validation == 'tidak') {
				$data_penjualan_tambahan = [	
					'kredit_validation' => $this->input->post('kredit_validation'),
				];
				$data_penjualan = array_merge($data_penjualan, $data_penjualan_tambahan);
			}elseif ($kredit_payment_validation == 'ya') {
				$data_penjualan_tambahan = [	
					'kredit_validation' => $this->input->post('kredit_validation'),
					'sistem_pembayaran' => $this->input->post('sistem_pembayaran'),
					'pembayaran' => $this->input->post('pembayaran'),
				];
				$data_penjualan = array_merge($data_penjualan, $data_penjualan_tambahan);
				//sistem_pembayaran
				if ($sistem_pembayaran == 'transfer') {
					$data_penjualan_tambahan = [
						'kode_bank' => $this->input->post('kode_bank'),
					];
					$data_penjualan = array_merge($data_penjualan, $data_penjualan_tambahan);
				}
			}
		}elseif ($metode_pembayaran == 'cash') {
			if ($sistem_pembayaran == 'tunai') {
				$data_penjualan_tambahan = [
					'sistem_pembayaran' => $this->input->post('sistem_pembayaran'),
					'pembayaran' => $this->input->post('pembayaran'),
				];
				$data_penjualan = array_merge($data_penjualan, $data_penjualan_tambahan);
			}elseif ($sistem_pembayaran == 'transfer') {
				$data_penjualan_tambahan = [
					'sistem_pembayaran' => $this->input->post('sistem_pembayaran'),
					'kode_bank' => $this->input->post('kode_bank'),
				];
				$data_penjualan = array_merge($data_penjualan, $data_penjualan_tambahan);
			}
		}

		// print_r($data_penjualan);

		$kode_pelanggan = $this->input->post('kode_pelanggan');
		// $saldo_pelanggan = $this->input->post('saldo_hidden');

		$data_detail_penjualan = [];

		for ($i=0; $i < $jumlah_barang_dibeli ; $i++) { 
			array_push($data_detail_penjualan, ['kode_barang' => $this->input->post('kode_barang_hidden')[$i]]);
			$data_detail_penjualan[$i]['no_penjualan'] = $this->input->post('no_penjualan');
			$data_detail_penjualan[$i]['nama_brand'] = $this->input->post('nama_brand_hidden')[$i];
			$data_detail_penjualan[$i]['harga_barang'] = $this->input->post('harga_barang_hidden')[$i];
			$data_detail_penjualan[$i]['jumlah_barang'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_penjualan[$i]['diskon'] = $this->input->post('diskon_hidden')[$i];
			$data_detail_penjualan[$i]['sub_total'] = $this->input->post('sub_total_hidden')[$i];
		}

		if($this->m_penjualan->tambah($data_penjualan) && $this->m_detail_penjualan->tambah($data_detail_penjualan)){
			if($metode_pembayaran == 'kredit'){
				if ($kredit_payment_validation == 'tidak') {
					$jumlah_total = $this->input->post('jumlah_total_hidden');
					$this->m_pelanggan->min_saldo($jumlah_total, $kode_pelanggan);
				}elseif($kredit_payment_validation == 'ya'){
					$pembayaran = $this->input->post('pembayaran');
					$jumlah_total = $this->input->post('jumlah_total_hidden');
					$saldo_pelanggan = $jumlah_total - $pembayaran;
					$this->m_pelanggan->min_saldo($saldo_pelanggan, $kode_pelanggan);
					if ($sistem_pembayaran == 'transfer') {
						$data_mutasi= [
							'kode_bank' => $this->input->post('kode_bank'),
							'tipe' => 'masuk',
							'tanggal' => $this->input->post('tgl_penjualan'),
							'jam' => $this->input->post('jam_penjualan'),
							'jumlah' => $pembayaran,
							'ket' => 'Penjualan',
							'kode' => $this->input->post('no_penjualan'),
							'personal' => $this->input->post('nama_pelanggan'),
						];
						$this->m_mutasi->tambah($data_mutasi);
					}
				}
			}elseif ($metode_pembayaran == 'cash'){
				if ($sistem_pembayaran == 'transfer') {
					$jumlah_total = $this->input->post('jumlah_total_hidden');
					$data_mutasi= [
						'kode_bank' => $this->input->post('kode_bank'),
						'tipe' => 'masuk',
						'tanggal' => $this->input->post('tgl_penjualan'),
						'jam' => $this->input->post('jam_penjualan'),
						'jumlah' => $jumlah_total,
						'ket' => 'Penjualan',
						'kode' => $this->input->post('no_penjualan'),
						'personal' => $this->input->post('nama_pelanggan'),
					];
					$this->m_mutasi->tambah($data_mutasi);
				}
			}
			for ($i=0; $i < $jumlah_barang_dibeli ; $i++) { 
				$this->m_barang->min_stok($data_detail_penjualan[$i]['jumlah_barang'], $data_detail_penjualan[$i]['kode_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penjualan</strong> Berhasil Dibuat!');
			redirect('penjualan');
		} else {
			$this->session->set_flashdata('eror', 'Invoice <strong>Penjualan</strong> Gagal Dibuat!');
			redirect('penjualan');
		}
	}

	public function detail($no_penjualan){
		$this->data['title'] = 'Detail Penjualan';
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan_join_pelanggan($no_penjualan);
		$this->data['bank'] = $this->m_bank->lihat_kode_bank($this->data['penjualan']->kode_bank);
		$this->data['all_detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['no'] = 1;

		$this->load->view('penjualan/detail', $this->data);
		// print_r($this->data);
	}

	public function detail_report($no_penjualan){
		$this->data['title'] = 'Detail Penjualan';
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan_join_pelanggan($no_penjualan);
		$this->data['all_detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['data_toko'] = $this->m_toko->lihat();
		$this->data['no'] = 1;

		$this->load->view('penjualan/detail_report', $this->data);
	}

	public function hapus($no_penjualan){
		$this->data['detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan($no_penjualan);
		//data
		$jumlah_total = $this->data['penjualan']->jumlah_total;
		$kode_pelanggan = $this->data['penjualan']->kode_pelanggan;
		
		// add data
		if($this->m_penjualan->hapus($no_penjualan) && $this->m_detail_penjualan->hapus($no_penjualan)){
			//validation
			if ($this->data['penjualan']->metode_pembayaran == 'kredit') {
				if ($this->data['penjualan']->kredit_validation == 'tidak') {
					$this->m_pelanggan->plus_saldo($jumlah_total, $kode_pelanggan);
				}elseif ($this->data['penjualan']->kredit_validation == 'ya') {
					$pembayaran = $this->data['penjualan']->pembayaran;
					$saldo_pelanggan = $jumlah_total - $pembayaran;
					$this->m_pelanggan->plus_saldo($saldo_pelanggan, $kode_pelanggan);
					if ($this->data['penjualan']->sistem_pembayaran == 'transfer') {
						$this->m_mutasi->hapus_kode($no_penjualan);	
					}
				}
			}elseif ($this->data['penjualan']->metode_pembayaran == 'cash') {
				if ($this->data['penjualan']->sistem_pembayaran == 'transfer') {
					$this->m_mutasi->hapus_kode($no_penjualan);
				}
			}
			foreach ($this->data['detail_penjualan'] as $data_penjualan) {
				$this->m_barang->plus_stok($data_penjualan->jumlah_barang, $data_penjualan->kode_barang);
			}
			$this->session->set_flashdata('success', 'Invoice Penjualan <strong>Berhasil</strong> Dihapus!');
			redirect('penjualan');
		} else {
			$this->session->set_flashdata('error', 'Invoice Penjualan <strong>Gagal</strong> Dihapus!');
			redirect('penjualan');
		}
	}


	public function get_all_barang(){
		$data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function get_all_barang_by_kode(){
		$data = $this->m_barang->lihat_kode($_POST['kode_barang']);
		echo json_encode($data);
	}

	public function get_all_pelanggan(){
		$data = $this->m_pelanggan->lihat_nama_pelanggan($_POST['nama_pelanggan']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('penjualan/keranjang');
	}

	public function get_bulan()
	{
		$data = $this->m_penjualan->get_bulan($_POST['tahun']);
		echo json_encode($data);
	}
	public function get_tanggal()
	{
		$data = $this->m_penjualan->get_tanggal($_POST['tahun'], $_POST['bulan']);
		echo json_encode($data);
	}

	public function export(){
		$dompdf = new Dompdf();

		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');
		$tahun  = $this->input->post('tahun');
		$info = $tanggal." ".$bulan." ".$tahun;

		$this->data['all_penjualan'] = $this->m_penjualan->lihat_join_pelanggan_by_date($tahun, $bulan, $tanggal);
		$this->data['keterangan'] = $info;

		// $this->data['all_penjualan'] = $this->m_penjualan->lihat_join_pelanggan();
		$this->data['title'] = 'Laporan Data Penjualan';
		$this->data['no'] = 1;

		// print_r($this->data['all_penjualan']);
		// $this->load->view('penjualan/report', $this->data);
		
		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penjualan/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penjualan '.$info, array("Attachment" => false));
	}

	public function export_detail_a5($no_penjualan){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan_join_pelanggan($no_penjualan);
		$this->data['all_detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['bank'] = $this->m_bank->lihat_kode_bank($this->data['penjualan']->kode_bank);
		$this->data['data_toko'] = $this->m_toko->lihat();
		$this->data['title'] = 'Struk Transaksi A5';
		$this->data['no'] = 1;

		// print_r($this->data['penjualan'] );

		// $customPaper = array(0,0,120,500);
		$dompdf->setPaper('A5', 'Potrait');
		// $dompdf->set_option('isHtml5ParserEnabled', true);
		$html = $this->load->view('penjualan/detail_report_a5', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Struk Transaksi A5 ' . $no_penjualan, array("Attachment" => false));
	}

	public function export_detail_thermal($no_penjualan){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['penjualan'] = $this->m_penjualan->lihat_no_penjualan_join_pelanggan($no_penjualan);
		$this->data['all_detail_penjualan'] = $this->m_detail_penjualan->lihat_no_penjualan($no_penjualan);
		$this->data['bank'] = $this->m_bank->lihat_kode_bank($this->data['penjualan']->kode_bank);
		$this->data['data_toko'] = $this->m_toko->lihat();
		$this->data['title'] = 'Struk Transaksi Thermal';
		$this->data['no'] = 1;

		// $this->load->view('penjualan/detail_report_thermal', $this->data);

		// print_r($this->data['penjualan'] );

		$customPaper = array(0,0,120,500);
		$dompdf->setPaper($customPaper, 'Potrait');
		$dompdf->set_option('isHtml5ParserEnabled', true);
		$html = $this->load->view('penjualan/detail_report_thermal', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Struk Transaksi Thermal ' . $no_penjualan, array("Attachment" => false));
	}
}