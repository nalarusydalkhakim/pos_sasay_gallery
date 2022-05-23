<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?></title>
	<link href="<?= base_url('sb-admin') ?>/css/sb-admin-2.min.css" rel="stylesheet">
	<style>
		@page {
			margin: 10px;
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
		<img  class="fas" src="<?php echo base_url('/sb-admin/img/logo_ghina_white_2.png'); ?>" />
			<h2 class="h4 text-dark "><?= $data_toko->nama_toko ?></h2>
			<p><?= $data_toko->alamat?> Telp: <?= $data_toko->no_telepon?></p>
		</div>
	</div>
	<hr>
	<table style="border:none;" width="100%">
		<tr>
			<td><strong>No Penjualan</strong></td>
			<td>:</td>
			<td><?= $penjualan->no_penjualan ?></td>
			<td><strong>Nama Kasir</strong></td>
			<td>:</td>
			<td><?= $penjualan->nama_kasir ?></td>
		</tr>
		<tr>
			<td><strong>Nama Customer</strong></td>
			<td>:</td>
			<td><?= $penjualan->nama_pelanggan  ?></td>
			<td><strong>Waktu Penjualan</strong></td>
			<td>:</td>
			<td><?= $penjualan->tgl_penjualan ?> - <?= $penjualan->jam_penjualan ?></td>
		</tr>
	</table>
	<hr>
	<div class="row">
			<table class="table table-bordered" style="width:100%;" >
				<thead style="font-weight:bold">
					<tr>
						<td width="5%">No</td>
						<td width="15%">Kode Item</td>
						<td width="20%">Nama Item</td>
						<td width="12%">Jumlah</td>
						<td width="18%">Harga</td>
						<td width="10%">Diskon</td>
						<td width="20%">Total</td>
					</tr>
				</thead>
				<tbody>
					<?php $jumlah_item = 0; ?>
					<?php foreach ($all_detail_penjualan as $detail_penjualan): ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $detail_penjualan->kode_barang ?></td>
							<td><?= $detail_penjualan->nama_barang ?></td>
							<td><?= $detail_penjualan->jumlah_barang ?> <?= strtoupper($detail_penjualan->satuan) ?></td>
							<td><?= $detail_penjualan->harga_barang ?></td>
							<td><?= $detail_penjualan->diskon ?> %</td>
							<td>Rp. <?= number_format($detail_penjualan->sub_total, 0, ',', '.') ?></td>
						</tr>
						<?php $jumlah_item += $detail_penjualan->jumlah_barang; ?>
					<?php endforeach ?>
				</tbody>
				<tfoot>
				</tfoot>
			</table>
			<hr>
			<table class="table table-bordered" style="width:100%">
				<tbody>
					<tr style="visibility: collapse;line-height: 0;">
						<td width="5%">No</td>
						<td width="15%">Kode Item</td>
						<td width="20%">Nama Item</td>
						<td width="12%">Jumlah</td>
						<td width="18%">Harga</td>
						<td width="10%">Diskon</td>
						<td width="20%">Total</td>
					</tr>
					<tr hidden="hidden">
						<td colspan="6">Total : </td>
						<td>Rp. <?= number_format($penjualan->total, 0, ',', '.') ?></td>
					</tr>
					<tr hidden>
						<td colspan="6">Item : </td>
						<td><?= $jumlah_item ?> <?= strtoupper($detail_penjualan->satuan) ?></td>
					</tr>
					<tr>
						<td colspan="6">Diskon (%) : </td>
						<td><?= $penjualan->diskon ?>%</td>
					</tr>	
					<tr>
						<td colspan="6">Jumlah Total : </td>
						<td>Rp. <?= number_format($penjualan->jumlah_total, 0, ',', '.') ?></td>
					</tr>
					<tr>
						<td colspan="6">Metode Pembayaran: </td>
						<td><?= strtoupper($penjualan->metode_pembayaran) ?></td>
					</tr>
					<?php if ($penjualan->metode_pembayaran == "kredit"):  ?>
						<?php if ($penjualan->kredit_validation == "tidak"):  ?>
							<tr>
								<td colspan="6">Bayar Kredit/Saldo: </td>
								<td><?= strtoupper($penjualan->kredit_validation) ?></td>
							</tr>
						<?php elseif ($penjualan->kredit_validation == "ya"):?>
							<tr>
								<td colspan="6">Bayar Kredit/Saldo: </td>
								<td><?= strtoupper($penjualan->kredit_validation) ?></td>
							</tr>
							<tr>
								<td colspan="6">Sistem Pembayaran: </td>
								<td><?= strtoupper($penjualan->sistem_pembayaran) ?></td>
							</tr>
							<?php if ($penjualan->sistem_pembayaran == "transfer"): ?>
								<tr>
									<td colspan="6">Bank: </td>
									<td><?= $bank->nama_bank  ?></td>
								</tr>
								<tr>
									<td colspan="6">Deposit: </td>
									<td>Rp. <?= number_format($penjualan->pembayaran, 0, ',', '.') ?></td>
								</tr>
								<tr>
									<td colspan="6">Simpan Saldo: </td>
									<td>Rp. <?= number_format($penjualan->pembayaran - $penjualan->jumlah_total, 0, ',', '.')  ?></td>
								</tr>
							<?php elseif ($penjualan->sistem_pembayaran == "tunai"): ?>
								<tr>
									<td colspan="6">Pembayaran Deposit: </td>
									<td>Rp. <?= number_format($penjualan->pembayaran, 0, ',', '.') ?></td>
								</tr>
								<tr>
									<td colspan="6">Simpan Saldo: </td>
									<td>Rp. <?= number_format($penjualan->pembayaran - $penjualan->jumlah_total, 0, ',', '.') ?></td>
								</tr>
							<?php endif ?>
						<?php endif ?>
					<?php elseif ($penjualan->metode_pembayaran == "cash"):  ?>
						<tr>
							<td colspan="6">Sistem Pembayaran: </td>
							<td><?= strtoupper($penjualan->sistem_pembayaran) ?></td>
						</tr>
						<?php if ($penjualan->sistem_pembayaran == "transfer"): ?>
							<tr>
								<td colspan="6">Bank: </td>
								<td><?= $bank->nama_bank ?></td>
							</tr>
						<?php elseif ($penjualan->sistem_pembayaran == "tunai"): ?>
							<tr>
								<td colspan="6"> Pembayaran </td>
								<td>Rp. <?= number_format($penjualan->pembayaran, 0, ',', '.') ?></td>
							</tr>
							<tr>
								<td colspan="6">Kembalian: </td>
								<td>Rp. <?= number_format($penjualan->pembayaran - $penjualan->jumlah_total, 0, ',', '.') ?></td>
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
</body>
</html>