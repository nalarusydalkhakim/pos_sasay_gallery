<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
			padding: 3px;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title ?></h3>
			<!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead style="font-weight:bold">
				<tr>
					<td width="5%">No</td>
					<td>Kode Barang</td>
					<td>Nama Barang</td>
					<td>Harga Beli</td>
					<td>Harga Jual</td>
					<td width="20%">Stok</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$jumlah_stock = 0;
					$jumlah_harga_beli = 0;
					$jumlah_harga_jual = 0;
				?>
				<?php foreach ($all_barang as $barang): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $barang->kode_barang ?></td>
						<td><?= $barang->nama_barang ?></td>
						<td>Rp <?= number_format($barang->harga_beli, 0, ',', '.') ?></td>
						<td>Rp <?= number_format($barang->harga_jual, 0, ',', '.') ?></td>
						<td><?= $barang->stok ?> <?= strtoupper($barang->satuan) ?></td>
					</tr>
					<?php 
						$jumlah_stock +=  $barang->stok;
						$jumlah_harga_beli += $barang->harga_beli * $barang->stok ;
						$jumlah_harga_jual += $barang->harga_jual * $barang->stok;
					?>
				<?php endforeach ?>
			</tbody>
			<tfoot style="font-weight:bold">
				<tr>
					<td colspan="5">Semua Stok : </td>
					<td ><?= $jumlah_stock ?> <?= strtoupper($barang->satuan) ?></td>
				</tr>
				<tr>
					<td colspan="5">Modal Item (Harga Beli x Stok) : </td>
					<td >Rp. <?= number_format($jumlah_harga_beli, 0, ',', '.') ?></td>
				</tr>
				<tr>
					<td colspan="5">Prediksi Omset (Harga Jual x Stok) : </td>
					<td >Rp. <?=  number_format($jumlah_harga_jual, 0, ',', '.') ?></td>
				</tr>
				<tr>
					<td colspan="5">Prediksi Laba Kotor (Prediksi Omset - Modal Item) : </td>
					<td >Rp. <?=  number_format($jumlah_harga_jual - $jumlah_harga_beli, 0, ',', '.') ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>