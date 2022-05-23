<?php

use Dompdf\Dompdf;

class Laporan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'laporan';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_penjualan', 'm_penjualan');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_detail_penjualan', 'm_detail_penjualan');
		$this->load->model('M_pelanggan', 'm_pelanggan');
	}

	public function bulanan(){
		$this->data['title'] = 'Rangkuman Bulanan';

		$strBulan = $this->input->post('bulan');
		$bulan = date('m',  strtotime($strBulan));
		$tahun  = $this->input->post('tahun');

		if (isset($tahun) && !empty($bulan)) {
			//card
			$this->data['omset_bulanan'] = $this->m_penjualan->jumlah_total_omset_bulanan($tahun, $bulan);
			$this->data['pengeluaran_bulanan'] = $this->m_pengeluaran->jumlah_total_pengeluaran($tahun, $bulan);
			$this->data['harga_pokok'] = $this->m_detail_penjualan->harga_pokok_produksi_bulanan($tahun, $bulan);
			$this->data['total_hutang'] = $this->m_pengeluaran->jumlah_hutang($tahun, $bulan);
			//item terlaris
			$this->data['item_terlaris'] = $this->m_detail_penjualan->item_terlaris_bulanan($tahun, $bulan);
			$this->data['jumlah_item_terjual_bulanan'] = $this->m_detail_penjualan->jumlah_item_terjual_bulanan($tahun, $bulan);
			//pendapatan terbanyak
			$this->data['pendapatan_terbanyak'] = $this->m_pelanggan->pendapatan_member_bulan($tahun, $bulan);
			$this->data['jumlah_pendapatan_terbanyak'] = $this->m_pelanggan->jumlah_pendapatan_member_bulan($tahun, $bulan);
			//line chart
			$this->data['get_omset'] = $this->m_penjualan->get_omset_hari($tahun, $bulan);
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			//card
			$this->data['omset_bulanan'] = $this->m_penjualan->jumlah_total_omset_bulanan($tahun, $bulan);
			$this->data['pengeluaran_bulanan'] = $this->m_pengeluaran->jumlah_total_pengeluaran($tahun, $bulan);
			$this->data['harga_pokok'] = $this->m_detail_penjualan->harga_pokok_produksi_bulanan($tahun, $bulan);
			$this->data['total_hutang'] = $this->m_pengeluaran->jumlah_hutang($tahun, $bulan);
			//item terlaris
			$this->data['item_terlaris'] = $this->m_detail_penjualan->item_terlaris_bulanan($tahun, $bulan);
			$this->data['jumlah_item_terjual_bulanan'] = $this->m_detail_penjualan->jumlah_item_terjual_bulanan($tahun, $bulan);
			//pendapatan terbanyak
			$this->data['pendapatan_terbanyak'] = $this->m_pelanggan->pendapatan_member_bulan($tahun, $bulan);
			$this->data['jumlah_pendapatan_terbanyak'] = $this->m_pelanggan->jumlah_pendapatan_member_bulan($tahun, $bulan);
			//line chart
			$this->data['get_omset'] = $this->m_penjualan->get_omset_hari($tahun, $bulan);
		}
		// print_r($this->data['get_omset']);
		$this->data['get_tahun'] = $this->m_penjualan->get_tahun();
		$this->load->view('laporan/bulanan', $this->data);
	}
	public function tahunan(){
		$this->data['title'] = 'Rangkuman Tahunan';
		$tahun  = $this->input->post('tahun');

		if (isset($tahun)) {
			$this->data['omset_tahunan'] = $this->m_penjualan->jumlah_total_omset_tahunan($tahun);
			$this->data['pengeluaran_tahunan'] = $this->m_pengeluaran->jumlah_total_pengeluaran($tahun);
			$this->data['harga_pokok'] = $this->m_detail_penjualan->harga_pokok_produksi_tahunan($tahun);
			$this->data['total_hutang'] = $this->m_pengeluaran->jumlah_hutang($tahun);
			//item terlaris
			$this->data['item_terlaris'] = $this->m_detail_penjualan->item_terlaris_tahunan($tahun);
			$this->data['jumlah_item_terjual_tahunan'] = $this->m_detail_penjualan->jumlah_item_terjual_tahunan($tahun);
			//pendapatan terbanyak
			$this->data['pendapatan_terbanyak'] = $this->m_pelanggan->pendapatan_member_tahun($tahun);
			$this->data['jumlah_pendapatan_terbanyak'] = $this->m_pelanggan->jumlah_pendapatan_member_tahun($tahun);
			//line chart
			$this->data['get_omset'] = $this->m_penjualan->get_omset_bulan($tahun);
		} else {
			$tahun= date('Y');
			$this->data['omset_tahunan'] = $this->m_penjualan->jumlah_total_omset_tahunan($tahun);
			$this->data['pengeluaran_tahunan'] = $this->m_pengeluaran->jumlah_total_pengeluaran($tahun);
			$this->data['harga_pokok'] = $this->m_detail_penjualan->harga_pokok_produksi_tahunan($tahun);
			$this->data['total_hutang'] = $this->m_pengeluaran->jumlah_hutang($tahun);
			//item terlaris
			$this->data['item_terlaris'] = $this->m_detail_penjualan->item_terlaris_tahunan($tahun);
			$this->data['jumlah_item_terjual_tahunan'] = $this->m_detail_penjualan->jumlah_item_terjual_tahunan($tahun);
			//pendapatan terbanyak
			$this->data['pendapatan_terbanyak'] = $this->m_pelanggan->pendapatan_member_tahun($tahun);
			$this->data['jumlah_pendapatan_terbanyak'] = $this->m_pelanggan->jumlah_pendapatan_member_tahun($tahun);
			//line chart
			$this->data['get_omset'] = $this->m_penjualan->get_omset_bulan($tahun);
		}
		$this->data['get_tahun'] = $this->m_penjualan->get_tahun();
		$this->load->view('laporan/tahunan', $this->data);
	}
	public function export_laba_rugi_bulanan()
	{
		$dompdf = new Dompdf();

		$strBulan = $this->input->post('modal_bulan');
		$bulan = date('m',  strtotime($strBulan));
		$tahun  = $this->input->post('modal_tahun');
		$info = $strBulan ." ".$tahun;

		if (isset($bulan) && !empty($tahun)) {
			$this->data['pendapatan'] = $this->m_penjualan->jumlah_total_omset_bulanan($tahun, $bulan);
			$this->data['harga_pokok'] = $this->m_detail_penjualan->harga_pokok_produksi_bulanan($tahun, $bulan);
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->jumlah_pengeluaran_akun_bulan($tahun, $bulan);
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$info = $bulan." ".$tahun;
			$this->data['pendapatan'] = $this->m_penjualan->jumlah_total_omset_bulanan($tahun, $bulan);
			$this->data['harga_pokok'] = $this->m_detail_penjualan->harga_pokok_produksi_bulanan($tahun, $bulan);
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->jumlah_pengeluaran_akun_bulan($tahun, $bulan);
		}
		$this->data['keterangan'] = $info;
		$this->data['title'] = 'Laporan Laba Rugi Bulanan';
		$this->data['no'] = 1;

		// print_r($this->data['all_pengeluaran']);

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('laporan/report_bulanan', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Laba Rugi ' . $info, array("Attachment" => false));
	}
	public function export_laba_rugi_tahunan()
	{
		$dompdf = new Dompdf();

		$tahun  = $this->input->post('modal_tahun');
		$info = $tahun;

		if (isset($tahun)) {
			$this->data['pendapatan'] = $this->m_penjualan->jumlah_total_omset_tahunan($tahun);
			$this->data['harga_pokok'] = $this->m_detail_penjualan->harga_pokok_produksi_tahunan($tahun);
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->jumlah_pengeluaran_akun_tahun($tahun);
		}else{
			$tahun = date('Y');
			$info = $tahun;
			$this->data['pendapatan'] = $this->m_penjualan->jumlah_total_omset_bulanan($tahun);
			$this->data['harga_pokok'] = $this->m_detail_penjualan->harga_pokok_produksi_bulanan($tahun);
			$this->data['all_pengeluaran'] = $this->m_pengeluaran->jumlah_pengeluaran_akun_tahun($tahun);
		}
		$this->data['keterangan'] = $info;
		$this->data['title'] = 'Laporan Laba Rugi Tahunan';
		$this->data['no'] = 1;

		// print_r($this->data['all_pengeluaran']);

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('laporan/report_bulanan', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Laba Rugi ' . $info, array("Attachment" => false));
	}
	public function get_bulan()
	{
		$data = $this->m_penjualan->get_bulan($_POST['tahun']);
		echo json_encode($data);
	}
	public function get_tanggal()
	{
		$data = $this->m_penjualan->get_tanggal($_POST['bulan']);
		echo json_encode($data);
	}
}