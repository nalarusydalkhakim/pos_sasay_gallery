<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<style>
		table, th, td {
			border: none;
			border-collapse: collapse;
			padding: 10px;
			text-align: center;
		}
		img{
			width: 250px;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title.' '.$barang->nama_barang  ?></h3>
			<!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
		</div>
	</div>
	<hr>
	<table style="border:none;" width="100%">
		<tr>
			<td><strong>Kode Barang</strong></td>
			<td>:</td>
			<td><?= $barang->kode_barang ?></td>
			<td><strong>Nama Barang</strong></td>
			<td>:</td>
			<td><?= $barang->nama_barang ?></td>
		</tr>
		<tr>
			<td><strong>Harga Beli</strong></td>
			<td>:</td>
			<td><?= $barang->harga_beli?></td>
			<td><strong>Harga Jual</strong></td>
			<td>:</td>
			<td><?= $barang->harga_jual ?></td>
			</tr>
	</table>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%">
			<?php for ($i=0; $i < 10 ; $i++) : ?>
			<tr>
				<td><img src="<?= base_url('barang/set_barcode/').$barang->kode_barang ?>" alt=""></td>
				<td><img src="<?= base_url('barang/set_barcode/').$barang->kode_barang ?>" alt=""></td>
				<td><img src="<?= base_url('barang/set_barcode/').$barang->kode_barang ?>" alt=""></td>
				<td><img src="<?= base_url('barang/set_barcode/').$barang->kode_barang ?>" alt=""></td>
			</tr>
			<?php endfor ?>
		</table>
	</div>
	<script>
		window.print();
	</script>
</body>
</html>