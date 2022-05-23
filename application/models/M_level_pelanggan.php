<?php

class M_level_pelanggan extends CI_Model{
	protected $_table = 'level_pelanggan';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_level(){
		$this->db->select('nama_level');
		$this->db->from($this->_table);
		$this->db->order_by('nama_level', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($kode_level){
		$query = $this->db->get_where($this->_table, ['kode_level' => $kode_level]);
		return $query->row();
	}

	public function lihat_nama_level($nama_level){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_level' => $nama_level]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}


	public function ubah($data, $kode_level){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_level' => $kode_level]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_level){
		return $this->db->delete($this->_table, ['kode_level' => $kode_level]);
	}
}