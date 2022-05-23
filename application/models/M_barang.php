<?php

class M_barang extends CI_Model{
	protected $_table = 'barang';

	// public function lihat(){
	// 	$query = $this->db->get($this->_table);
	// 	return $query->result();
	// }

	public function lihat(){
		$this->db->select('b.id, b.kode_barang, c.nama_brand, b.nama_barang, b.harga_beli, b.harga_jual, b.stok, b.satuan');
		$this->db->from('barang as b');
        $this->db->join('brand as c', 'c.kode_brand = b.kode_brand');
		$query = $this->db->get();
		return $query->result();
    }

	public function lihat_pagination($limit, $start){
		$this->db->select('b.id, b.kode_barang, c.nama_brand, b.nama_barang, b.harga_beli, b.harga_jual, b.stok, b.satuan');
		$this->db->from('barang as b');
        $this->db->join('brand as c', 'c.kode_brand = b.kode_brand');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result();
    }

	public function lihat_public(){
		$this->db->select('b.id, b.kode_barang, c.nama_brand, b.nama_barang, b.harga_jual, b.stok, b.satuan');
		$this->db->from('barang as b');
        $this->db->join('brand as c', 'c.kode_brand = b.kode_brand');
		$this->db->where(['b.stok >' => 0]);
		$this->db->order_by('b.nama_barang', 'ASC');
		$query = $this->db->get();
		return $query->result();
    }

	public function lihat_public_brand($brand){
		$this->db->select('b.id, b.kode_barang, c.nama_brand, b.nama_barang, b.harga_jual, b.stok, b.satuan');
		$this->db->from('barang as b');
        $this->db->join('brand as c', 'c.kode_brand = b.kode_brand');
		$this->db->where(['c.nama_brand' => $brand]);
		$this->db->order_by('b.stok', 'ASC');
		$query = $this->db->get();
		return $query->result();
    }

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function modal_ditoko(){
		$this->db->select('SUM(harga_beli*stok) as modal, SUM(stok) as stok');
		$this->db->from($this->_table);
		$query = $this->db->get();
		return $query->row();
    }

	public function lihat_stok(){
		$query = $this->db->get_where($this->_table, 'stok > 0');
		return $query->result();
	}

	public function lihat_kode($kode_barang){
		$query = $this->db->select('b.id, b.kode_barang, b.kode_brand, c.nama_brand, b.nama_barang, b.harga_beli, b.harga_jual, b.stok, b.satuan');
		$this->db->from('barang as b');
        $this->db->join('brand as c', 'c.kode_brand = b.kode_brand');
		$query = $this->db->where(['kode_barang' => $kode_barang]);
		$query = $this->db->get();
		return $query->row();
	}

	public function lihat_nama_barang($nama_barang){
		$query = $this->db->select('b.id, b.kode_barang, c.nama_brand, b.nama_barang, b.harga_beli, b.harga_jual, b.stok, b.satuan');
		$this->db->from('barang as b');
        $this->db->join('brand as c', 'c.kode_brand = b.kode_brand');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get();
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function min_stok($stok, $kode_barang){
		$query = $this->db->set('stok', 'stok-' . $stok, false);
		$query = $this->db->where('kode_barang', $kode_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function plus_stok($stok, $kode_barang){
		$query = $this->db->set('stok', 'stok+' . $stok, false);
		$query = $this->db->where('kode_barang', $kode_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $kode_barang){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_barang' => $kode_barang]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_barang){
		return $this->db->delete($this->_table, ['kode_barang' => $kode_barang]);
	}
}