<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<style>
		@page {
			margin: 0px;
		}
		body { 
			font-size: 0.7rem;
			margin: 2px; 
		}
  </style>
</head>
<body style="margin: 0px;">
	<div class="row" style="text-align: center; margin: 0px;">
		<div class="col text-center">
			<h2 class="h4 text-dark "><?= $data_toko->nama_toko ?></h2>
			<p><?= $data_toko->alamat?> Telp: <?= $data_toko->no_telepon?></p>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<table class="table table-borderless">
				<tr>
					<td>No Penjualan</td>
					
					<td align="right"><?= $penjualan->no_penjualan ?></td>
				</tr>
				<tr>
					<td>Nama Kasir</td>
					
					<td align="right"><?= $penjualan->nama_kasir ?></td>
				</tr>
				<tr>
					<td>Nama Customer</td>
					
					<td align="right"><?= $penjualan->nama_pelanggan ?></td>
				</tr>
				<tr>
					<td>Waktu Penjualan</td>
					
					<td align="right"><?= $penjualan->tgl_penjualan ?> - <?= $penjualan->jam_penjualan ?></td>
				</tr>
			</table>
		</div>
	</div>
	<hr>
	<div class="row">
			<table class="table table-bordered" style="width:100%">
				<tbody>
					<?php $jumlah_item = 0; ?>
					<?php foreach ($all_detail_penjualan as $detail_penjualan): ?>
						<tr>
							<td><?= $detail_penjualan->nama_barang ?></td>
							<td align="right">Rp.<?= number_format($detail_penjualan->sub_total, 0, ',', '.') ?></td>
						</tr>
						<tr>
							<td><small><?= $detail_penjualan->jumlah_barang ?> <?= strtoupper($detail_penjualan->satuan) ?> X Rp.<?= number_format($detail_penjualan->harga_barang, 0, ',', '.')?> (<?= $detail_penjualan->diskon?>%)</small></td>
							<td align="right"></td>
						</tr>
						<?php $jumlah_item += $detail_penjualan->jumlah_barang; ?>
					<?php endforeach ?>
				</tbody>	
			</table>
			<hr>
			<table class="table table-bordered" style="width:100%">
				<tbody>
					<tr>
						<td>Total : </td>
						<td align="right">Rp.<?= number_format($penjualan->total, 0, ',', '.') ?></td>
					</tr>
					<tr>
						<td>Item : </td>
						<td align="right"><?= $jumlah_item ?> <?= strtoupper($detail_penjualan->satuan) ?></td>
					</tr>
					<tr>
						<td>Diskon(%) : </td>
						<td align="right"><?= $penjualan->diskon ?>%</td>
					</tr>
					<tr>
						<td>Jumlah Total : </td>
						<td align="right">Rp.<?= number_format($penjualan->jumlah_total, 0, ',', '.') ?></td>
					</tr>
					<tr>
						<td>Metode Pembayaran: </td>
						<td align="right"><?= strtoupper($penjualan->metode_pembayaran) ?></td>
					</tr>
					<?php if ($penjualan->metode_pembayaran == "kredit"):  ?>
						<?php if ($penjualan->kredit_validation == "tidak"):  ?>
							<tr>
								<td>Bayar Kredit/Saldo: </td>
								<td align="right"><?= strtoupper($penjualan->kredit_validation) ?></td>
							</tr>
							<tr>
								<?php if ($penjualan->saldo < 0): ?>
									<td>Hutang: </td>
									<td align="right">Rp.<?= number_format($penjualan->saldo * -1, 0, ',', '.')  ?></td>
								<?php elseif ($penjualan->saldo >= 0): ?>
									<td>Saldo: </td>
									<td align="right">Rp.<?= number_format($penjualan->saldo, 0, ',', '.')  ?></td>
								<?php endif ?>
							</tr>
						<?php elseif ($penjualan->kredit_validation == "ya"):?>
							<tr>
								<td>Bayar Kredit/Saldo: </td>
								<td align="right"><?= strtoupper($penjualan->kredit_validation) ?></td>
							</tr>
							<tr>
								<td>Sistem Pembayaran: </td>
								<td align="right"><?= strtoupper($penjualan->sistem_pembayaran) ?></td>
							</tr>
							<?php if ($penjualan->sistem_pembayaran == "transfer"): ?>
								<tr>
									<td>Bank: </td>
									<td align="right"><?= $bank->nama_bank  ?></td>
								</tr>
								<tr>
									<td>Deposit: </td>
									<td align="right">Rp.<?= number_format($penjualan->pembayaran, 0, ',', '.') ?></td>
								</tr>
								<tr>
									<?php if ($penjualan->saldo < 0): ?>
										<td>Hutang: </td>
										<td align="right">Rp.<?= number_format($penjualan->saldo * -1, 0, ',', '.')  ?></td>
									<?php elseif ($penjualan->saldo >= 0): ?>
										<td>Saldo: </td>
										<td align="right">Rp.<?= number_format($penjualan->saldo, 0, ',', '.')  ?></td>
									<?php endif ?>
								</tr>
							<?php elseif ($penjualan->sistem_pembayaran == "tunai"): ?>
								<tr>
									<td>Pembayaran Deposit: </td>
									<td align="right">Rp.<?= number_format($penjualan->pembayaran, 0, ',', '.') ?></td>
								</tr>
								<tr>
									<?php if ($penjualan->saldo < 0): ?>
										<td>Hutang: </td>
										<td align="right">Rp.<?= number_format($penjualan->saldo * -1, 0, ',', '.')  ?></td>
									<?php elseif ($penjualan->saldo >= 0): ?>
										<td>Saldo: </td>
										<td align="right">Rp.<?= number_format($penjualan->saldo, 0, ',', '.')  ?></td>
									<?php endif ?>
								</tr>
							<?php endif ?>
						<?php endif ?>
					<?php elseif ($penjualan->metode_pembayaran == "cash"):  ?>
						<tr>
							<td>Sistem Pembayaran: </td>
							<td align="right"><?= strtoupper($penjualan->sistem_pembayaran) ?></td>
						</tr>
						<?php if ($penjualan->sistem_pembayaran == "transfer"): ?>
							<tr>
								<td>Bank: </td>
								<td align="right"><?= $bank->nama_bank ?></td>
							</tr>
						<?php elseif ($penjualan->sistem_pembayaran == "tunai"): ?>
							<tr>
								<td>Pembayaran </td>
								<td align="right">Rp.<?= number_format($penjualan->pembayaran, 0, ',', '.') ?></td>
							</tr>
							<tr>
								<td>Kembalian: </td>
								<td align="right">Rp.<?= number_format($penjualan->pembayaran - $penjualan->jumlah_total, 0, ',', '.') ?></td>
							</tr>
						<?php endif ?>
					<?php endif ?>
				</tbody>
			</table>
			<div class="row" style="text-align: center; margin: 0px;">
				<div class="col text-center">
					<br>
					<br>
					<h3>Happy Shoping :)</h3>
				</div>
			</div>
	</div>
	<script>
		window.onload = window.print;
	</script>
</body>
</html>