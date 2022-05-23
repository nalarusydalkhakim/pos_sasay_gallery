<?php

class M_penjualan extends CI_Model {
	protected $_table = 'penjualan';

	public function lihat(){
		return $this->db->get($this->_table)->result();
	}
	
	public function lihat_join_pelanggan(){
		$this->db->select('*');
		$this->db->from('penjualan as p');
		$this->db->join('pelanggan as c', 'c.kode_pelanggan = p.kode_pelanggan', 'left');
		$this->db->order_by('tgl_penjualan', 'DESC');
		$this->db->order_by('jam_penjualan', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function lihat_join_pelanggan_by_kode_pelanggan($kode_pelanggan){
		$this->db->select('*');
		$this->db->from('penjualan as p');
		$this->db->join('pelanggan as c', 'c.kode_pelanggan = p.kode_pelanggan');
		$this->db->where(['c.kode_pelanggan ='=> $kode_pelanggan]);
		$this->db->order_by('tgl_penjualan', 'DESC');
		$this->db->order_by('jam_penjualan', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function lihat_join_pelanggan_by_date($tahun = null, $bulan = null, $tanggal = null){
		$this->db->select('*');
		$this->db->from('penjualan as p');
		$this->db->join('pelanggan as c', 'c.kode_pelanggan = p.kode_pelanggan', 'left');
		$this->db->order_by('tgl_penjualan', 'DESC');
		$this->db->order_by('jam_penjualan', 'DESC');
		if ($tahun && $bulan && $tanggal) {
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%M") ='=> $bulan]);
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%d") ='=> $tanggal]);
		}elseif ($tahun && $bulan && !$tanggal) {
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%M") ='=> $bulan]);
		}elseif ($tahun && !$bulan && !$tanggal) {
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function lihat_join_pelanggan_pagination($limit, $start, $keyword = null){
		$this->db->select('*');
		$this->db->from('penjualan as p');
		$this->db->join('pelanggan as c', 'c.kode_pelanggan = p.kode_pelanggan', 'left');
		$this->db->order_by('tgl_penjualan', 'DESC');
		$this->db->order_by('jam_penjualan', 'DESC');
		if ($keyword) {
			$this->db->like('nama_pelanggan', $keyword);
			$this->db->or_like('tgl_penjualan', $keyword);
			$this->db->or_like('jam_penjualan', $keyword);
		}
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
	}

	public function lihat_no_penjualan_join_pelanggan($no_penjualan){
		$this->db->select('*');
		$this->db->from('penjualan as p');
		$this->db->join('pelanggan as c', 'c.kode_pelanggan = p.kode_pelanggan');
		$this->db->where(['no_penjualan ='=> $no_penjualan]);
		$query = $this->db->get();
		return $query->row();
	}

	

	public function get_omset_bulan(){
		$sql = 'SELECT SUM(jumlah_total) as omset, DATE_FORMAT(tgl_penjualan, "%M") as periode FROM `penjualan` 
				WHERE DATE_FORMAT(tgl_penjualan, "%Y") = YEAR(CURDATE()) GROUP BY DATE_FORMAT(tgl_penjualan, "%M") 
				ORDER BY tgl_penjualan';
		return $this->db->query($sql)->result();
	}
	public function get_omset_bulanan($tahun){
		$this->db->select('SUM(jumlah_total) as omset, DATE_FORMAT(tgl_penjualan, "%M") as periode');
		$this->db->from($this->_table);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->group_by('DATE_FORMAT(tgl_penjualan, "%m")');
		$this->db->order_by('tgl_penjualan', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_omset_hari($tahun, $bulan){
		$this->db->select('SUM(jumlah_total) as omset, DATE_FORMAT(tgl_penjualan, "%d") as periode');
		$this->db->from($this->_table);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$this->db->group_by('DATE_FORMAT(tgl_penjualan, "%d")');
		$this->db->order_by('tgl_penjualan', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_tanggal($tahun = null, $bulan = null){
		$this->db->select('DATE_FORMAT(tgl_penjualan, "%d") as tanggal');
		$this->db->from($this->_table);
		if ($bulan && $tahun) {
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%M") ='=> $bulan]);
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		}
		$this->db->group_by("tanggal");
		$this->db->order_by('tgl_penjualan', 'DSC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_bulan($tahun = null){
		$this->db->select('DATE_FORMAT(tgl_penjualan, "%M") as bulan');
		$this->db->from($this->_table);
		if ($tahun) {
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		}
		$this->db->group_by("bulan");
		$this->db->order_by('tgl_penjualan', 'DSC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_tahun(){
		$this->db->select('DATE_FORMAT(tgl_penjualan, "%Y") as tahun');
		$this->db->from($this->_table);
		$this->db->group_by("tahun");
		$this->db->order_by('tgl_penjualan', 'DSC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}
	public function jumlah_transaksi_harian($tahun, $bulan, $tanggal){
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%d") ='=> $tanggal]);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function jumlah_transaksi_bulanan($tahun, $bulan){
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function jumlah_transaksi_tahunan($tahun){
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function jumlah_total_omset(){
		$this->db->select('SUM(jumlah_total) as omset');
		$this->db->from('penjualan');
		$query = $this->db->get();
		return $query->row();
	}
	public function jumlah_total_omset_harian($tahun, $bulan, $tanggal){
		$this->db->select('SUM(jumlah_total) as omset, DATE_FORMAT(tgl_penjualan, "%d %M %Y") as tanggal');
		$this->db->from('penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%d") ='=> $tanggal]);
		$query = $this->db->get();
		return $query->row();
	}
	public function jumlah_total_omset_bulanan($tahun, $bulan){
		$this->db->select('SUM(jumlah_total) as omset, DATE_FORMAT(tgl_penjualan, "%M %Y") as tanggal');
		$this->db->from('penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$query = $this->db->get();
		return $query->row();
	}
	public function jumlah_total_omset_tahunan($tahun = null){
		$this->db->select('SUM(jumlah_total) as omset, DATE_FORMAT(tgl_penjualan, "%Y") as tanggal');
		$this->db->from('penjualan');
		if ($tahun) {
			$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		}
		$query = $this->db->get();
		return $query->row();
	}

	public function lihat_no_penjualan($no_penjualan){
		return $this->db->get_where($this->_table, ['no_penjualan' => $no_penjualan])->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($no_penjualan){
		return $this->db->delete($this->_table, ['no_penjualan' => $no_penjualan]);
	}
}