<?php

class M_pengeluaran extends CI_Model{
	protected $_table = 'pengeluaran';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_join_akun_kode($kode_pengeluaran){
		$this->db->select('*');
		$this->db->from('pengeluaran as p');
		$this->db->join('akun as a', 'a.kode_akun = p.kode_akun');
		$this->db->where(['kode_pengeluaran' => $kode_pengeluaran]);
		$query = $this->db->get();
		return $query->row();
	}

	//get for laba rugi
	public function jumlah_pengeluaran_akun_bulan($tahun, $bulan){
		$this->db->select('SUM(p.jumlah) as pengeluaran, a.nama_akun');
		$this->db->from('pengeluaran as p');
		$this->db->join('akun as a', 'a.kode_akun = p.kode_akun');
		$this->db->where(['DATE_FORMAT(p.tanggal, "%Y") = '=>$tahun]);
        $this->db->where(['DATE_FORMAT(p.tanggal, "%m") = '=>$bulan]);
		$this->db->group_by("p.kode_akun");
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah_pengeluaran_akun_tahun($tahun){
		$this->db->select('SUM(p.jumlah) as pengeluaran, a.nama_akun');
		$this->db->from('pengeluaran as p');
		$this->db->join('akun as a', 'a.kode_akun = p.kode_akun');
		$this->db->where(['DATE_FORMAT(p.tanggal, "%Y") = '=>$tahun]);
		$this->db->group_by("p.kode_akun");
		$query = $this->db->get();
		return $query->result();
	}

	public function lihat_join_bank(){
		$this->db->select('*');
		$this->db->from('pengeluaran as p');
        $this->db->join('bank as b', 'b.kode_bank = p.kode_bank', 'left');
		$this->db->join('akun as a', 'a.kode_akun = p.kode_akun');
		$query = $this->db->get();
		return $query->result();
	}

	public function lihat_join_bank_by_bulan($tahun, $bulan){
		$this->db->select('*');
		$this->db->from('pengeluaran as p');
        $this->db->join('bank as b', 'b.kode_bank = p.kode_bank', 'left');
		$this->db->join('akun as a', 'a.kode_akun = p.kode_akun');
		$this->db->where(['DATE_FORMAT(p.tanggal, "%Y") = '=>$tahun]);
        $this->db->where(['DATE_FORMAT(p.tanggal, "%M") = '=>$bulan]);
		$query = $this->db->get();
		return $query->result();
	}

	public function lihat_join_bank_by_tahun($tahun){
		$this->db->select('*');
		$this->db->from('pengeluaran as p');
        $this->db->join('bank as b', 'b.kode_bank = p.kode_bank', 'left');
		$this->db->join('akun as a', 'a.kode_akun = p.kode_akun');
		$this->db->where(['DATE_FORMAT(p.tanggal, "%Y") = '=>$tahun]);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_pengeluaran_bulan(){
		$sql = 'SELECT SUM(jumlah) as pengeluaran, DATE_FORMAT(tanggal, "%M") as periode FROM `pengeluaran` 
				WHERE DATE_FORMAT(tanggal, "%Y") = YEAR(CURDATE()) GROUP BY DATE_FORMAT(tanggal, "%M") 
				ORDER BY tanggal';
		return $this->db->query($sql)->result();
	}

	public function jumlah_total_pengeluaran($tahun = null, $bulan = null){
		$this->db->select('SUM(jumlah) as total, DATE_FORMAT(tanggal, "%Y") as tahun,  DATE_FORMAT(tanggal, "%M") as bulan');
		$this->db->from('pengeluaran');
		if ($tahun && $bulan) {
			$this->db->where(['DATE_FORMAT(tanggal, "%Y") ='=> $tahun]);
			$this->db->where(['DATE_FORMAT(tanggal, "%m") ='=> $bulan]);
		}elseif ($tahun && !$bulan) {
			$this->db->where(['DATE_FORMAT(tanggal, "%Y") ='=> $tahun]);
		}
		$query = $this->db->get();
		return $query->row();
	}

	//hitung hutang
	public function jumlah_hutang($tahun = null, $bulan = null){
		$this->db->select('SUM(jumlah) as hutang, DATE_FORMAT(tanggal, "%Y") as tanggal');
		$this->db->from('pengeluaran');
		$this->db->where(['hutang' => 'YA']);
		if ($tahun && $bulan) {
			$this->db->where(['DATE_FORMAT(tanggal, "%Y") ='=> $tahun]);
			$this->db->where(['DATE_FORMAT(tanggal, "%m") ='=> $bulan]);
		}elseif ($tahun && !$bulan) {
			$this->db->where(['DATE_FORMAT(tanggal, "%Y") ='=> $tahun]);
		}
		$query = $this->db->get();
		return $query->row();
	}
	
	public function get_pengeluaran(){
		$this->db->select('nama_pengeluaran');
		$this->db->from($this->_table);
		$this->db->order_by('nama_pengeluaran', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_kode($kode_pengeluaran){
		$query = $this->db->order_by('tanggal', 'DESC');
		$query = $this->db->order_by('jam', 'DESC');
		$query = $this->db->get_where($this->_table, ['kode_pengeluaran' => $kode_pengeluaran]);
		return $query->row();
	}

	public function lihat_nama_pengeluaran($nama_pengeluaran){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_pengeluaran' => $nama_pengeluaran]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function get_bulan($tahun = null){
		$this->db->select('DATE_FORMAT(tanggal, "%M") as bulan');
		$this->db->from($this->_table);
		if ($tahun) {
			$this->db->where(['DATE_FORMAT(tanggal, "%Y") ='=> $tahun]);
		}
		$this->db->group_by("bulan");
		$this->db->order_by('tanggal', 'DSC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_tahun(){
		$this->db->select('DATE_FORMAT(tanggal, "%Y") as tahun');
		$this->db->from($this->_table);
		$this->db->group_by("tahun");
		$this->db->order_by('tanggal', 'DSC');
		$query = $this->db->get();
		return $query->result();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}


	public function ubah($data, $kode_pengeluaran){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_pengeluaran' => $kode_pengeluaran]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_pengeluaran){
		return $this->db->delete($this->_table, ['kode_pengeluaran' => $kode_pengeluaran]);
	}
}