<?php

use Dompdf\Dompdf;

class Pengeluaran extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'pengeluaran';
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_bank', 'm_bank');
		$this->load->model('M_akun', 'm_akun');
		$this->load->model('M_mutasi', 'm_mutasi');
	}

	public function index(){
		$this->data['title'] = 'Data Pengeluaran';
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat_join_bank();
		$this->data['all_tahun'] = $this->m_pengeluaran->get_tahun();
		$this->data['no'] = 1;

		$this->load->view('pengeluaran/lihat', $this->data);
	}

	public function tambah(){

		$this->data['title'] = 'Tambah pengeluaran';
		$this->data['all_bank'] = $this->m_bank->lihat();
		$this->data['all_akun'] = $this->m_akun->lihat();

		$this->load->view('pengeluaran/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			'kode_pengeluaran' => $this->input->post('kode_pengeluaran'),
			'kode_akun' => $this->input->post('kode_akun'),
			'tanggal' => $this->input->post('tanggal'),
			'jam' => $this->input->post('jam'),
			'jumlah' => $this->input->post('jumlah'),
			'sistem_pembayaran' => $this->input->post('sistem_pembayaran'),
			'kepada' => $this->input->post('kepada'),
			'hutang' => $this->input->post('hutang'),
		];

		$sistem_pembayaran =$this->input->post('sistem_pembayaran');
		if ($sistem_pembayaran == 'transfer') {
			//add data kode_bank to data array
			$data_tambahan = [
				'kode_bank' => $this->input->post('kode_bank'),
			];
			$data = array_merge($data, $data_tambahan);

			if ($this->input->post('hutang') == 'TIDAK') {
				$this->data['akun'] = $this->m_akun->lihat_kode($this->input->post('kode_akun'));

				//add mutasi
				$data_mutasi= [
					'kode_bank' => $this->input->post('kode_bank'),
					'tipe' => 'keluar',
					'tanggal' => $this->input->post('tanggal'),
					'jam' => $this->input->post('jam'),
					'jumlah' => $this->input->post('jumlah'),
					'ket' => $this->data['akun']->nama_akun,
					'kode' => $this->input->post('kode_pengeluaran'),
					'personal' => $this->input->post('kepada'),
				];
				$this->m_mutasi->tambah($data_mutasi);
			}
			
		}

		if($this->m_pengeluaran->tambah($data)){
			$this->session->set_flashdata('success', 'Data pengeluaran <strong>Berhasil</strong> Ditambahkan!');
			redirect('pengeluaran');
		} else {
			$this->session->set_flashdata('error', 'Data pengeluaran <strong>Gagal</strong> Ditambahkan!');
			redirect('pengeluaran');
		}
	}

	public function ubah($kode_pengeluaran){
		$this->data['title'] = 'Bayar Hutang Pengeluaran';
		$this->data['all_bank'] = $this->m_bank->lihat();
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_join_akun_kode($kode_pengeluaran);

		$this->load->view('pengeluaran/ubah', $this->data);
	}

	public function bayar_hutang($kode_pengeluaran){
		// $this->data['pengeluaran'] = $this->m_pengeluaran->lihat_kode($kode_pengeluaran);

		$data = [
			'hutang' => 'TIDAK',
			'sistem_pembayaran' => $this->input->post('sistem_pembayaran'),
		];

		$sistem_pembayaran =$this->input->post('sistem_pembayaran');
		if ($sistem_pembayaran == 'transfer') {
			//add data kode_bank to data array
			$data_tambahan = [
				'kode_bank' => $this->input->post('kode_bank'),
			];
			$data = array_merge($data, $data_tambahan);

			//add data mutasi
			$data_mutasi= [
				'kode_bank' => $this->input->post('kode_bank'),
				'tipe' => 'keluar',
				'tanggal' => date('Y-m-d'),
				'jam' => date('H:i:s'),
				'jumlah' => $this->input->post('jumlah'),
				'ket' => $this->input->post('kode_akun'),
				'kode' => $kode_pengeluaran,
				'personal' => $this->input->post('kepada'),
			];
			$this->m_mutasi->tambah($data_mutasi);
			
		}

		if($this->m_pengeluaran->ubah($data, $kode_pengeluaran)){
			$this->session->set_flashdata('success', 'Hutang <strong>Berhasil</strong> Dibayar!');
			redirect('pengeluaran');
		} else {
			$this->session->set_flashdata('error', 'Hutang <strong>Gagal</strong> Dibayar!');
			redirect('pengeluaran');
		}
	}

	public function hapus($kode_pengeluaran){
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_kode($kode_pengeluaran);
		
		if($this->m_pengeluaran->hapus($kode_pengeluaran)){
			if ($this->data['pengeluaran']->sistem_pembayaran == 'transfer') {
				if ($this->data['pengeluaran']->hutang == 'TIDAK') {
					$this->m_mutasi->hapus_kode($kode_pengeluaran);
				}
			}
			$this->session->set_flashdata('success', 'Data pengeluaran <strong>Berhasil</strong> Dihapus!');
			redirect('pengeluaran');
		} else {
			$this->session->set_flashdata('error', 'Data pengeluaran <strong>Gagal</strong> Dihapus!');
			redirect('pengeluaran');
		}
	}

	public function get_bulan()
	{
		$data = $this->m_pengeluaran->get_bulan($_POST['tahun']);
		echo json_encode($data);
	}

	public function export(){
		$dompdf = new Dompdf();
		
		$bulan = $this->input->post('bulan');
		$tahun  = $this->input->post('tahun');
		$info = $bulan." ".$tahun;

		if (isset($bulan) && !empty($tahun)) {
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat_join_bank_by_bulan($tahun, $bulan);
			$this->data['keterangan'] = $info;
		}elseif (empty($bulan) & isset($tahun)) {
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat_join_bank_by_tahun($tahun);
			$this->data['keterangan'] = $info;
		}else{
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat_join_bank();
			$this->data['keterangan'] = "General";
		}

		// print_r($this->data['all_pengeluaran']);

		$this->data['title'] = 'Laporan Data pengeluaran';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pengeluaran/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengeluaran '.$info."_download at (". date('d F Y').")", array("Attachment" => false));
	}
}