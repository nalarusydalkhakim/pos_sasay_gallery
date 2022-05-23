<?php

class M_akun extends CI_Model{
	protected $_table = 'akun';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_akun(){
		$this->db->select('nama_akun');
		$this->db->from($this->_table);
		$this->db->order_by('nama_akun', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_kode($kode_akun){
		$query = $this->db->get_where($this->_table, ['kode_akun' => $kode_akun]);
		return $query->row();
	}

	public function lihat_nama_akun($nama_akun){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_akun' => $nama_akun]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}


	public function ubah($data, $kode_akun){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_akun' => $kode_akun]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_akun){
		return $this->db->delete($this->_table, ['kode_akun' => $kode_akun]);
	}
}