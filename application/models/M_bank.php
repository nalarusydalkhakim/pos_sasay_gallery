<?php

class M_bank extends CI_Model{
	protected $_table = 'bank';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_bank(){
		$this->db->select('nama_bank');
		$this->db->from($this->_table);
		$this->db->order_by('nama_bank', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_kode_bank($kode_bank){
		$query = $this->db->get_where($this->_table, ['kode_bank' => $kode_bank]);
		return $query->row();
	}

	public function lihat_nama_bank($nama_bank){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_bank' => $nama_bank]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}


	public function ubah($data, $kode_bank){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_bank' => $kode_bank]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_bank){
		return $this->db->delete($this->_table, ['kode_bank' => $kode_bank]);
	}
}