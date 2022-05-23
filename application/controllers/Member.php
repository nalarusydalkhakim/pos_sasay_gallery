<?php

use Dompdf\Dompdf;

class Member extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
		$this->data['aktif'] = 'member';
		$this->load->model('M_member', 'm_member');
		$this->load->model('M_pelanggan', 'm_pelanggan');
		$this->kode_pelanggan = "test";
	}

	public function detail($kode_pelanggan){
		$this->data['title'] = 'Data Member';
		$this->data['pelanggan'] = $this->m_pelanggan->lihat_kode_join_level($kode_pelanggan);
		$this->data['all_member'] = $this->m_member->lihat($kode_pelanggan);
		$this->data['no'] = 1;
		$this->session->set_userdata('kode_pelanggan'. $kode_pelanggan);

		$this->load->view('member/lihat', $this->data);
	}

	public function tambah($kode_pelanggan){

		$this->data['title'] = 'Tambah Sub Member';
		$this->data['kode_pelanggan'] = $kode_pelanggan;

		$this->load->view('member/tambah', $this->data);
	}

	public function proses_tambah(){
		// if ($this->session->login['role'] == 'kasir'){
		// 	$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
		// 	redirect('penjualan');
		// }

		$data = [
			'kode_member' => $this->input->post('kode_member'),
			'kode_pelanggan' => $this->input->post('kode_pelanggan'),
			'nama_member' => $this->input->post('nama_member'),
			'level' => $this->input->post('level'),
			'alamat' => $this->input->post('alamat'),
		];

		if($this->m_member->tambah($data)){
			$this->session->set_flashdata('success', 'Data Member <strong>Berhasil</strong> Ditambahkan!');
			redirect('member/detail/'.$this->input->post('kode_pelanggan'));
		} else {
			$this->session->set_flashdata('error', 'Data Member <strong>Gagal</strong> Ditambahkan!');
			redirect('member/detail/'.$this->input->post('kode_pelanggan'));
		}
	}

	public function ubah($kode_member){
		$this->data['title'] = 'Ubah Data Member';
		$this->data['member'] = $this->m_member->lihat_id($kode_member);

		$this->load->view('member/ubah', $this->data);
	}

	public function proses_ubah($kode_member){

		$data = [
			'nama_member' => $this->input->post('nama_member'),
			'alamat' => $this->input->post('alamat'),
			'level' => $this->input->post('level'),
		];

		if($this->m_member->ubah($data, $kode_member)){
			$this->session->set_flashdata('success', 'Data Member strong>Berhasil</strong> Diubah!');
			redirect('member/detail/'.$this->input->post('kode_pelanggan'));
		} else {
			$this->session->set_flashdata('error', 'Data Member <strong>Gagal</strong> Diubah!');
			redirect('member/detail/'.$this->input->post('kode_pelanggan'));
		}
	}

	public function hapus($kode_member){
		
		if($this->m_member->hapus($kode_member)){
			$this->session->set_flashdata('success', 'Data Member <strong>Berhasil</strong> Dihapus!');
			redirect('pelanggan');
		} else {
			$this->session->set_flashdata('error', 'Data Member <strong>Gagal</strong> Dihapus!');
			redirect('pelanggan');
		}
	}

	public function export($kode_pelanggan){
		$dompdf = new Dompdf();
		$this->data['pelanggan'] = $this->m_pelanggan->lihat_kode_join_level($kode_pelanggan);
		$this->data['all_member'] = $this->m_member->lihat($kode_pelanggan);
		$this->data['title'] = 'Data Member '.$this->data['pelanggan']->nama_pelanggan;
		$this->data['no'] = 1;
		
		// $this->load->view('member/report', $this->data);

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('member/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Daftar Member '.$this->data['pelanggan']->nama_pelanggan.' '. date('d F Y'), array("Attachment" => false));
	}
}