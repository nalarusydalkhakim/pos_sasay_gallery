<?php

class M_brand extends CI_Model{
	protected $_table = 'brand';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_brand(){
		$this->db->select('*');
		$this->db->from($this->_table);
		$this->db->order_by('nama_brand', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($kode_brand){
		$query = $this->db->get_where($this->_table, ['kode_brand' => $kode_brand]);
		return $query->row();
	}

	public function lihat_nama_brand($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_brand' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}


	public function ubah($data, $kode_barang){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_brand' => $kode_barang]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_barang){
		return $this->db->delete($this->_table, ['kode_brand' => $kode_barang]);
	}
}