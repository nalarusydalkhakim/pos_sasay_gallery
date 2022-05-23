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
	<table style="border:none;" width="100%">
		<tr>
			<td><strong>Kode Pelanggan</strong></td>
			<td>:</td>
			<td><?= $pelanggan->kode_pelanggan ?></td>
			<td><strong>Nama Customer</strong></td>
			<td>:</td>
			<td><?= $pelanggan->nama_pelanggan ?></td>
		</tr>
		<tr>
			<td><strong>Level</strong></td>
			<td>:</td>
			<td><?= $pelanggan->nama_level ?></td>
			<?php if ($pelanggan->saldo >= 0) : ?>
				<td><strong>Saldo</strong></td>
				<td>:</td>
				<td>Rp <?= number_format($pelanggan->saldo, 0, ',', '.') ?></td>
			<?php else: ?>
				<td><strong>Hutang</strong></td>
				<td>:</td>
				<td>Rp <?= number_format($pelanggan->saldo * -1, 0, ',', '.') ?></td>
			<?php endif ?>
		</tr>
	</table>
	<hr>
	<div class="row">
		<table class="table table-bordered" id="dataTable" width="100%">
			<thead style="font-weight:bold">
				<tr>
					<td>No</td>
					<td>Kode member</td>
					<td>Nama member</td>
					<td>Level</td>
				</tr>
			</thead>
			<tbody>
				<?php $jumlah = 0;?>
				<?php foreach ($all_member as $member): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $member->kode_member ?></td>
						<td><?= $member->nama_member ?></td>
						<td><?= $member->level ?></td>
					</tr>
					<?php $jumlah += 1; ?>
				<?php endforeach ?>
			</tbody>
			<tfoot style="font-weight:bold">
				<tr>
					<td colspan="3" align="center">Jumlah Member</td>
					<td ><?= $jumlah ?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>