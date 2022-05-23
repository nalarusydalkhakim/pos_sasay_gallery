<?php

class M_kategori extends CI_Model{
	protected $_table = 'kategori';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_kategori(){
		$this->db->select('nama_kategori');
		$this->db->from($this->_table);
		$this->db->order_by('nama_kategori', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($kode_kategori){
		$query = $this->db->get_where($this->_table, ['kode_kategori' => $kode_kategori]);
		return $query->row();
	}

	public function lihat_nama_kategori($nama_kategori){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_kategori' => $nama_kategori]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}


	public function ubah($data, $kode_kategori){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_kategori' => $kode_kategori]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_kategori){
		return $this->db->delete($this->_table, ['kode_kategori' => $kode_kategori]);
	}
}