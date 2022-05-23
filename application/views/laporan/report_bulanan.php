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
			padding: 5px;
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
					<td colspan="2" align="center">Rincian : </td>
				</tr>
			</thead>
			<tbody>
				<tr style="font-weight:bold">
					<td width="70%" >Pendapatan Kotor: </td>
					<td>Rp. <?= number_format($pendapatan->omset, 0, ',', '.') ?></td>
				</tr>
				<tr style="font-weight:bold">
					<td width="70%">Harga Pokok Produksi : </td>
					<td>Rp. <?= number_format($harga_pokok->hpp, 0, ',', '.') ?></td>
				</tr>
				<tr style="font-weight:bold">
					<td colspan="2">Pengeluaran : </td>
				</tr>
				<?php $jumlah_pengeluaran=0; ?>
				<?php foreach ($all_pengeluaran as $pengeluaran): ?>
					<tr>
						<td width="70%"><?= $pengeluaran->nama_akun ?> </td>
						<td>Rp. <?= number_format($pengeluaran->pengeluaran, 0, ',', '.') ?></td>
					</tr>
					<?php $jumlah_pengeluaran += $pengeluaran->pengeluaran; ?>
				<?php endforeach ?>
				<tr style="font-weight:bold">
					<td width="70%">Jumlah Pengeluaran: </td>
					<td>Rp. <?= number_format($jumlah_pengeluaran, 0, ',', '.') ?></td>
				</tr>
			</tbody>
			<tfoot style="font-weight:bold">
				<tr style="font-weight:bold">
					<td colspan="2">- </td>
				</tr>
				<tr>
					<?php $laba_bersih = $pendapatan->omset - $harga_pokok->hpp - $jumlah_pengeluaran; ?>
					<td width="70%">LABA BERSIH: </td>
					<td>Rp. <?= number_format($laba_bersih, 0, ',', '.') ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>