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
			/* padding-bottom: 2px;
			padding-left: 1px;
			padding-right: 1px; */
			align-items: center;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="col text-center">
			<h3 class="h3 text-dark"><?= $title." - ".$keterangan ?></h3>
			<!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead style="font-weight:bold">
				<tr>
					<td>No Penjualan</td>
					<td>Customer</td>
					<td>Kasir</td>
					<td>Tanggal</td>
					<td>Jam</td>
					<td>Sub Total</td>
					<td>Diskon</td>
					<td>Total</td>
				</tr>
			</thead>
			<tbody>
				<?php
					$jumlah_sub_total = 0;
					$jumlah_total = 0;
				?>
				<?php foreach ($all_penjualan as $penjualan): ?>
					<tr>
						<td><?= $penjualan->no_penjualan ?></td>
						<td><?= $penjualan->nama_pelanggan ?></td>
						<td><?= $penjualan->nama_kasir ?></td>
						<td><?= $penjualan->tgl_penjualan ?></td>
						<td><?= $penjualan->jam_penjualan ?></td>
						<td>Rp <?= number_format($penjualan->total, 0, ',', '.') ?></td>
						<td><?= $penjualan->diskon ?>%</td>
						<td>Rp <?= number_format($penjualan->jumlah_total, 0, ',', '.') ?></td>
					</tr>
					<?php
						$jumlah_sub_total += $penjualan->total;
						$jumlah_total += $penjualan->jumlah_total;
					?>
				<?php endforeach ?>
			</tbody>
			<tfoot style="font-weight:bold">
				<tr>
					<td colspan="2" align="center">Jumlah : </td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td >Rp <?= number_format($jumlah_sub_total, 0, ',', '.') ?></td>
					<td>-</td>
					<td >Rp <?= number_format($jumlah_total, 0, ',', '.') ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<script>
		window.print();
	</script>
</body>
</html>