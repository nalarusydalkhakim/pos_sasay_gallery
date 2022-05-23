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
					<td>Nama</td>
					<td>Kode</td>
                    <td>Level</td>
					<td>Item</td>
					<td>Saldo</td>
					<td>Piutang</td>
                    <td>Pendapatan</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					$jumlah_item= 0;
					$jumlah_pendapatan = 0;
					$jumlah_saldo = 0;
					$jumlah_hutang = 0;
				?>
				<?php foreach ($all_pelanggan as $pelanggan): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $pelanggan->nama_pelanggan ?></td>
						<td><?= $pelanggan->kode_pelanggan ?></td>
						<td><?= $pelanggan->level ?></td>
						<td><?=  number_format($pelanggan->item, 0, ',', '.') ?></td>
						<?php if ($pelanggan->saldo > 0):?>
							<td>Rp <?= number_format($pelanggan->saldo, 0, ',', '.') ?></td>
							<td>Rp <?= number_format(0, 0, ',', '.') ?></td>
						<?php elseif ($pelanggan->saldo < 0): ?>
							<td>Rp <?= number_format(0, 0, ',', '.') ?></td>
							<td>Rp <?= number_format($pelanggan->saldo * -1, 0, ',', '.') ?></td>
						<?php else: ?>
							<td>Rp <?= number_format(0, 0, ',', '.') ?></td>
							<td>Rp <?= number_format(0, 0, ',', '.') ?></td>
						<?php endif; ?>
						<td>Rp <?= number_format($pelanggan->total, 0, ',', '.') ?></td>
					</tr>
					<?php
						if ($pelanggan->saldo > 0) {
							$jumlah_saldo += $pelanggan->saldo;
						}else {
							$jumlah_hutang += $pelanggan->saldo;
						}
						$jumlah_item += $pelanggan->item;
						$jumlah_pendapatan += $pelanggan->total;
					?>
				<?php endforeach ?>
			</tbody>
			<tfoot style="font-weight:bold">
				<tr>
					<td colspan="2" align="center">Jumlah : </td>
					<td>-</td>
					<td>-</td>
					<td><?= number_format($jumlah_item, 0, ',', '.') ?></td>
					<td >Rp. <?= number_format($jumlah_saldo, 0, ',', '.') ?></td>
					<td >Rp. <?= number_format($jumlah_hutang* -1, 0, ',', '.') ?></td>
					<td >Rp. <?= number_format($jumlah_pendapatan, 0, ',', '.') ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>