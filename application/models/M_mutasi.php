<?php

class M_mutasi extends CI_Model{
	protected $_table = 'mutasi_bank';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function get_mutasi(){
		$this->db->select('nama_mutasi');
		$this->db->from($this->_table);
		$this->db->order_by('nama_mutasi', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_kode_bank($kode_bank){
		$query = $this->db->order_by('tanggal', 'DESC');
		$query = $this->db->order_by('jam', 'DESC');
		$query = $this->db->get_where($this->_table, ['kode_bank' => $kode_bank]);
		return $query->result();
	}

	public function lihat_nama_mutasi($nama_mutasi){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_mutasi' => $nama_mutasi]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}


	public function ubah($data, $kode_mutasi){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_mutasi' => $kode_mutasi]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus_kode($kode){
		return $this->db->delete($this->_table, ['kode' => $kode]);
	}

	public function hapus_kode_bank($kode_bank){
		return $this->db->delete($this->_table, ['kode_bank' => $kode_bank]);
	}
}