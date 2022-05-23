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
			<h4 class="h3 text-dark"><?= $keterangan ?></h4>
			<!-- <h4 class="h4 text-dark "><strong><?= $perusahaan->nama_perusahaan ?></strong></h4> -->
		</div>
	</div>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%">
			<thead style="font-weight:bold">
				<tr>
					<td>No</td>
					<td>Tanggal</td>
					<td>Nama Akun</td>
					<td>Kepada</td>
					<td>Hutang</td>
					<td>Sistem Pembayaran</td>
					<td>Bank</td>
					<td>Jumlah</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$jumlah = 0;
					$jumlah_dibayar = 0;
					$jumlah_hutang = 0;
				?>
				<?php foreach ($all_pengeluaran as $pengeluaran): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $pengeluaran->tanggal ?></td>
						<td><?= $pengeluaran->nama_akun ?></td>
						<td><?= $pengeluaran->hutang ?></td>
						<td><?= strtoupper(($pengeluaran->sistem_pembayaran ? $pengeluaran->sistem_pembayaran : '-'))?></td>
						<td><?= strtoupper(($pengeluaran->nama_bank ? $pengeluaran->nama_bank : '-'))?></td>
						<td><?= $pengeluaran->kepada ?></td>
						<td>Rp <?= number_format($pengeluaran->jumlah, 0, ',', '.') ?></td>
					</tr>
					<?php 
						$jumlah += $pengeluaran->jumlah;
						if ($pengeluaran->hutang == 'YA') {
							$jumlah_hutang += $pengeluaran->jumlah;
						}elseif ($pengeluaran->hutang == 'TIDAK') {
							$jumlah_dibayar += $pengeluaran->jumlah;
						}
					?>
				<?php endforeach ?>
			</tbody>
			<tfoot style="font-weight:bold">
				<tr>
					<td colspan="7">Jumlah Pengeluaran : </td>
					<td >Rp <?= number_format($jumlah, 0, ',', '.') ?></td>
				</tr>
				<tr>
					<td colspan="7">Jumlah Pengeluaran Yang Sudah Dibayar :</td>
					<td >Rp <?= number_format($jumlah_dibayar, 0, ',', '.') ?></td>
				</tr>
				<tr>
					<td colspan="7">Jumlah Pengeluaran Yang Belum Dibayar (Hutang) :</td>
					<td >Rp <?= number_format($jumlah_hutang, 0, ',', '.') ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>