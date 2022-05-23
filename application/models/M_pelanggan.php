<?php

class M_pelanggan extends CI_Model{
	protected $_table = 'pelanggan';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
    }

	public function lihat_kode($kode_pelanggan){
		$this->db->select('p.id, p.kode_pelanggan, p.nama_pelanggan, p.alamat, p.saldo, p.level');
		$this->db->from('pelanggan as p');
		$this->db->where('kode_pelanggan', $kode_pelanggan);
		$query = $this->db->get();
		return $query->row();
	}

	//fix
    public function lihat_total(){
		$this->db->select('c.id, c.kode_pelanggan, c.nama_pelanggan, c.saldo, c.level, SUM(d.jumlah_barang) as item, SUM(CAST(d.sub_total-(d.sub_total*(p.diskon/100)) as SIGNED)) as total');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
		$this->db->join('detail_penjualan as d', 'd.no_penjualan = p.no_penjualan');
        $this->db->group_by("c.kode_pelanggan");
		$this->db->order_by('total', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }

	public function lihat_total_brand($brand){
		$this->db->select('c.id, c.kode_pelanggan, c.nama_pelanggan, c.saldo, c.level, SUM(d.jumlah_barang) as item, SUM(CAST(d.sub_total-(d.sub_total*(p.diskon/100)) as SIGNED)) as total');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
		$this->db->join('detail_penjualan as d', 'd.no_penjualan = p.no_penjualan');
		$this->db->where(['d.nama_brand ='=>$brand]);
        $this->db->group_by("c.kode_pelanggan");
		$this->db->order_by('total', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }

	public function lihat_total_brand_waktu($brand, $tahun, $bulan){
		$this->db->select('c.id, c.kode_pelanggan, c.nama_pelanggan, c.saldo, c.level, SUM(d.jumlah_barang) as item, SUM(CAST(d.sub_total-(d.sub_total*(p.diskon/100)) as SIGNED)) as total');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
		$this->db->join('detail_penjualan as d', 'd.no_penjualan = p.no_penjualan');
		$this->db->where(['d.nama_brand ='=>$brand]);
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%M") = '=>$bulan]);
        $this->db->group_by("kode_pelanggan");
		$this->db->order_by('total', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }

    public function lihat_total_waktu($tahun, $bulan){
		$this->db->select('c.id, c.kode_pelanggan, c.nama_pelanggan, c.saldo, c.level, SUM(d.jumlah_barang) as item, SUM(CAST(d.sub_total-(d.sub_total*(p.diskon/100)) as SIGNED)) as total');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
		$this->db->join('detail_penjualan as d', 'd.no_penjualan = p.no_penjualan');
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%M") = '=>$bulan]);
        $this->db->group_by("kode_pelanggan");
		$this->db->order_by('total', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }

	public function lihat_total_brand_tahun($brand, $tahun){
		$this->db->select('c.id, c.kode_pelanggan, c.nama_pelanggan, c.saldo, c.level, SUM(d.jumlah_barang) as item, SUM(CAST(d.sub_total-(d.sub_total*(p.diskon/100)) as SIGNED)) as total');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
		$this->db->join('detail_penjualan as d', 'd.no_penjualan = p.no_penjualan');
		$this->db->where(['d.nama_brand ='=>$brand]);
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
        $this->db->group_by("kode_pelanggan");
		$this->db->order_by('total', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }
    
    public function lihat_total_tahun($tahun){
		$this->db->select('c.id, c.kode_pelanggan, c.nama_pelanggan, c.saldo, c.level, SUM(d.jumlah_barang) as item, SUM(CAST(d.sub_total-(d.sub_total*(p.diskon/100)) as SIGNED)) as total');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
		$this->db->join('detail_penjualan as d', 'd.no_penjualan = p.no_penjualan');
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
        $this->db->group_by("kode_pelanggan");
		$this->db->order_by('total', 'DESC');
		$query = $this->db->get();
		return $query->result();
    }

	//for rangkuman
	public function pendapatan_member_bulan($tahun, $bulan){
		$this->db->select('SUM(p.jumlah_total) as pendapatan, c.nama_pelanggan');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") = '=>$bulan]);
        $this->db->group_by("c.kode_pelanggan");
		$this->db->order_by('pendapatan', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
    }
	public function pendapatan_member_tahun($tahun){
		$this->db->select('SUM(p.jumlah_total) as pendapatan, c.nama_pelanggan');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
        $this->db->group_by("c.kode_pelanggan");
		$this->db->order_by('pendapatan', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
    }

	public function jumlah_pendapatan_member_bulan($tahun, $bulan){
		$this->db->select('SUM(p.jumlah_total) as pendapatan');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%m") = '=>$bulan]);
		$this->db->order_by('pendapatan', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->row();
    }
	public function jumlah_pendapatan_member_tahun($tahun){
		$this->db->select('SUM(p.jumlah_total) as pendapatan');
		$this->db->from('pelanggan as c');
        $this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
        $this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
		$this->db->order_by('pendapatan', 'DESC');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->row();
    }

    // public function lihat_total_brand($brand){
	// 	$this->db->select('c.id, c.kode_pelanggan, c.nama_pelanggan, level, SUM(d.jumlah_barang) as item, SUM(CAST(d.sub_total-(d.sub_total*(p.diskon/100)) as SIGNED)) as total');
	// 	$this->db->from('pelanggan as c');
	// 	$this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
	// 	$this->db->join('detail_penjualan as d', 'd.no_penjualan = p.no_penjualan');
    //     $this->db->where(['d.nama_brand ='=>$brand]);
    //     $this->db->group_by("kode_pelanggan");
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	
	// public function lihat_total_brand_tahun($brand, $tahun){
	// 	$this->db->select('c.id, c.kode_pelanggan, c.nama_pelanggan, level, SUM(d.jumlah_barang) as item, SUM(CAST(d.sub_total-(d.sub_total*(p.diskon/100)) as SIGNED)) as total');
	// 	$this->db->from('pelanggan as c');
	// 	$this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
	// 	$this->db->join('detail_penjualan as d', 'd.no_penjualan = p.no_penjualan');
	// 	$this->db->where(['d.nama_brand ='=>$brand]);
	// 	$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
    //     $this->db->group_by("kode_pelanggan");
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	
	// public function lihat_total_brand_waktu($brand, $tahun, $bulan){
	// 	$this->db->select('c.id, c.kode_pelanggan, c.nama_pelanggan, level, SUM(d.jumlah_barang) as item, SUM(CAST(d.sub_total-(d.sub_total*(p.diskon/100)) as SIGNED)) as total');
	// 	$this->db->from('pelanggan as c');
	// 	$this->db->join('penjualan as p', 'p.kode_pelanggan = c.kode_pelanggan');
	// 	$this->db->join('detail_penjualan as d', 'd.no_penjualan = p.no_penjualan');
	// 	$this->db->where(['d.nama_brand ='=>$brand]);
	// 	$this->db->where(['DATE_FORMAT(tgl_penjualan, "%Y") = '=>$tahun]);
	// 	$this->db->where(['DATE_FORMAT(tgl_penjualan, "%M") = '=>$bulan]);
    //     $this->db->group_by("kode_pelanggan");
	// 	$query = $this->db->get();
	// 	return $query->result();
    // }
	
	public function jumlah_total_hutang(){
		$query = $this->db->select('SUM(saldo) as hutang');
		$query = $this->db->where(['saldo <'=> 0]);
		$query = $this->db->get($this->_table);
		return $query->row();
    }
	public function jumlah_total_deposit(){
		$query = $this->db->select('SUM(saldo) as deposit');
		$query = $this->db->where(['saldo >'=> 0]);
		$query = $this->db->get($this->_table);
		return $query->row();
    }

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['id' => $id]);
		return $query->row();
	}
    
    public function lihat_nama_pelanggan($nama_pelanggan){
		$this->db->select('p.id, p.kode_pelanggan, p.nama_pelanggan, p.saldo, p.level');
		$this->db->from('pelanggan as p');
		$this->db->where(['nama_pelanggan' => $nama_pelanggan]);
		$query = $this->db->get();
		return $query->row();
    }
    
    public function lihat_kode_pelanggan($kode_pelanggan){
		$query = $this->db->select('*');
		$query = $this->db->where(['kode_pelanggan' => $kode_pelanggan]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id){
		$query = $this->db->set($data);
		$query = $this->db->where(['id' => $id]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function min_saldo($saldo, $kode_pelanggan){
		$query = $this->db->set('saldo', 'saldo-' . $saldo, false);
		$query = $this->db->where('kode_pelanggan', $kode_pelanggan);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function plus_saldo($saldo, $kode_pelanggan){
		$query = $this->db->set('saldo', 'saldo+' . $saldo, false);
		$query = $this->db->where('kode_pelanggan', $kode_pelanggan);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_pelanggan){
		return $this->db->delete($this->_table, ['kode_pelanggan' => $kode_pelanggan]);
	}
}