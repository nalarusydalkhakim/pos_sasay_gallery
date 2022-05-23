<?php

class M_member extends CI_Model{
	protected $_table = 'member';

	public function lihat($kode_pelanggan){
		$query = $this->db->get_where($this->_table, ['kode_pelanggan' => $kode_pelanggan]);
		return $query->result();
	}

	public function get_member(){
		$this->db->select('nama_member');
		$this->db->from($this->_table);
		$this->db->order_by('nama_member', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($kode_member){
		$query = $this->db->get_where($this->_table, ['kode_member' => $kode_member]);
		return $query->row();
	}

	public function lihat_nama_member($nama_member){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_member' => $nama_member]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}


	public function ubah($data, $kode_member){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_member' => $kode_member]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_member){
		return $this->db->delete($this->_table, ['kode_member' => $kode_member]);
	}

	public function hapus_by_kode_pelanggan($kode_pelanggan){
		return $this->db->delete($this->_table, ['kode_pelanggan' => $kode_pelanggan]);
	}
}