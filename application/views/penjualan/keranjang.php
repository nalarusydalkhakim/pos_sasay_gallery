<tr class="row-keranjang">
	<td class="nama_barang">
		<?= $this->input->post('nama_barang') ?>
		<input type="hidden" name="nama_barang_hidden[]" value="<?= $this->input->post('nama_barang') ?>">
		<input type="hidden" name="kode_barang_hidden[]" value="<?= $this->input->post('kode_barang') ?>">
	</td>
	<td class="nama_brand">
		<?= $this->input->post('nama_brand') ?>
		<input type="hidden" name="nama_brand_hidden[]" value="<?= $this->input->post('nama_brand') ?>">
	</td>
	<td class="harga_barang">
		<?= $this->input->post('harga_barang') ?>
		<input type="hidden" name="harga_barang_hidden[]" value="<?= $this->input->post('harga_barang') ?>">
	</td>
	<td class="jumlah">
		<?= $this->input->post('jumlah') ?>
		<input type="hidden" name="jumlah_hidden[]" value="<?= $this->input->post('jumlah') ?>">
	</td>
	<td class="diskon">
		<?= $this->input->post('diskon') ?>
		<input type="hidden" name="diskon_hidden[]" value="<?= $this->input->post('diskon') ?>">
	</td>
	<!-- <td class="satuan">
		<?= strtoupper($this->input->post('satuan')) ?>
		<input type="hidden" name="satuan_hidden[]" value="<?= $this->input->post('satuan') ?>">
	</td> -->
	<td class="sub_total">
		<?= $this->input->post('sub_total') ?>
		<input type="hidden" name="sub_total_hidden[]" value="<?= $this->input->post('sub_total') ?>">
	</td>
	<td class="aksi">
		<button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-nama-barang="<?= $this->input->post('nama_barang') ?>"><i class="fa fa-trash"></i></button>
	</td>
</tr>