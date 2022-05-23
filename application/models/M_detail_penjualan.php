<?php

class M_detail_penjualan extends CI_Model {
	protected $_table = 'detail_penjualan';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function harga_pokok_produksi(){
		$this->db->select(' SUM(b.harga_beli*d.jumlah_barang) as hpp');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('barang as b', ' b.kode_barang = d.kode_barang');
		$query = $this->db->get();
		return $query->row();
	}

	public function get_harga_pokok_produksi_bulan(){
		$this->db->select(' SUM(b.harga_beli*d.jumlah_barang) as hpp, DATE_FORMAT(p.tgl_penjualan, "%M") as periode');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('barang as b', ' b.kode_barang = d.kode_barang');
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->group_by("periode");
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah_item_terjual(){
		$this->db->select('SUM(jumlah_barang) as item');
		$this->db->from($this->_table);
		$query = $this->db->get();
		return $query->row();
	}
	public function harga_pokok_produksi_harian($tahun, $bulan, $tanggal){
		$this->db->select(' SUM(b.harga_beli*d.jumlah_barang) as hpp');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('barang as b', ' b.kode_barang = d.kode_barang');
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%d") ='=> $tanggal]);
		$query = $this->db->get();
		return $query->row();
	}
	public function harga_pokok_produksi_bulanan($tahun, $bulan){
		$this->db->select(' SUM(b.harga_beli*d.jumlah_barang) as hpp');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('barang as b', ' b.kode_barang = d.kode_barang');
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$query = $this->db->get();
		return $query->row();
	}
	public function harga_pokok_produksi_tahunan($tahun=null, $bulan=null){
		$this->db->select(' SUM(b.harga_beli*d.jumlah_barang) as hpp');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('barang as b', ' b.kode_barang = d.kode_barang');
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$query = $this->db->get();
		return $query->row();
	}

	public function jumlah_item_terjual_harian($tahun, $bulan, $tanggal){
		$this->db->select('SUM(d.jumlah_barang) as item');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%d") ='=> $tanggal]);
		$query = $this->db->get();
		return $query->row();
	}
	public function jumlah_item_terjual_bulanan($tahun, $bulan){
		$this->db->select('SUM(d.jumlah_barang) as item');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$query = $this->db->get();
		return $query->row();
	}
	public function jumlah_item_terjual_tahunan($tahun){
		$this->db->select('SUM(d.jumlah_barang) as item');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$query = $this->db->get();
		return $query->row();
	}

	public function item_terlaris_harian($tahun, $bulan, $tanggal){
		$this->db->select('SUM(d.jumlah_barang)as kuantitas');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('barang as b', ' b.kode_barang = d.kode_barang');
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%d") ='=> $tanggal]);
        $this->db->group_by("nama_barang");
		$this->db->order_by('kuantitas', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}

	public function item_terlaris_bulanan($tahun, $bulan){
		$this->db->select('b.nama_barang, SUM(d.jumlah_barang)as kuantitas');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('barang as b', ' b.kode_barang = d.kode_barang');
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
        $this->db->group_by("d.kode_barang");
		$this->db->order_by('kuantitas', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}
	public function item_terlaris_tahunan($tahun){
		$this->db->select('b.nama_barang,  SUM(d.jumlah_barang)as kuantitas');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('barang as b', ' b.kode_barang = d.kode_barang');
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
        $this->db->group_by("d.kode_barang");
		$this->db->order_by('kuantitas', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}

	public function brand_terlaris_harian($tahun, $bulan, $tanggal){
		$this->db->select('nama_brand, SUM(d.sub_total)as kuantitas');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%d") ='=> $tanggal]);
        $this->db->group_by("nama_brand");
		$this->db->order_by('kuantitas', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function brand_terlaris_bulanan($tahun, $bulan){
		$this->db->select('nama_brand, SUM(d.sub_total)as kuantitas');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") ='=> $bulan]);
        $this->db->group_by("nama_brand");
		$this->db->order_by('kuantitas', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function brand_terlaris_tahunan($tahun){
		$this->db->select('nama_brand, SUM(d.sub_total)as kuantitas');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('penjualan as p', ' p.no_penjualan = d.no_penjualan');
		$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") ='=> $tahun]);
        $this->db->group_by("nama_brand");
		$this->db->order_by('kuantitas', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function lihat_no_penjualan($no_penjualan){
		$this->db->select('*');
		$this->db->from("detail_penjualan as d");
		$this->db->JOIN('barang as b', ' b.kode_barang = d.kode_barang');
		$this->db->where('no_penjualan', $no_penjualan);
		$query = $this->db->get();
		return $query->result();
		// return $this->db->get_where($this->_table, ['no_penjualan' => $no_penjualan])->result();
	}

	public function hapus($no_penjualan){
		return $this->db->delete($this->_table, ['no_penjualan' => $no_penjualan]);
	}
}