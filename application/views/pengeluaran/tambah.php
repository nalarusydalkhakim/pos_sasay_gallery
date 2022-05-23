<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('pengeluaran') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('pengeluaran') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('pengeluaran/proses_tambah') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_pengeluaran"><strong>Kode Pengeluaran</strong></label>
											<!-- value="<?= mt_rand(10000000, 99999999) ?>" -->
											<input type="text" name="kode_pengeluaran" autocomplete="off"  value="PL<?= mt_rand(10000000, 99999999) ?>" class="form-control" required  maxlength="15" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="waktu"><strong>Waktu</strong></label>
											<input type="text" name="waktu" value="<?= date('Y-m-d').'/'.date('H:i:s') ?>" placeholder="Masukkan Nama pengeluaran" autocomplete="off"  class="form-control" required readonly>
										</div>
										<input type="hidden" name="tanggal" value="<?= date('Y-m-d') ?>" placeholder="Masukkan Nama pengeluaran" autocomplete="off"  class="form-control" required readonly>
										<input type="hidden" name="jam" value="<?= date('H:i:s') ?>" placeholder="Masukkan Nama pengeluaran" autocomplete="off"  class="form-control" required readonly>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="jumlah"><strong>Jumlah</strong></label>
											<input type="text" name="jumlah" placeholder="Rp. 0" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="kepada"><strong>Kepada</strong></label>
											<input type="text" name="kepada" placeholder="Nama Tujuan Pembayaran" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_akun"><strong>Nama Akun</strong></label>
											<select name="kode_akun" id="kode_akun" class="form-control" required>
												<option value="" selected>--Pilih --</option>
												<?php foreach ($all_akun as $akun): ?>
													<option value="<?= $akun->kode_akun ?>"><?= $akun->nama_akun ?></option>
												<?php endforeach ?>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="hutang"><strong>Hutang</strong></label>
											<select name="hutang" id="hutang" class="form-control" required>
												<option value="" selected>--Pilih --</option>
												<option value="YA">Ya</option>
												<option value="TIDAK">Tidak</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6" id="sistem_group">
											<label for="sistem_pembayaran"><strong>Sistem Pembayaran</strong></label>
											<select name="sistem_pembayaran" id="sistem_pembayaran" class="form-control">
												<option value="" selected>--Pilih --</option>
												<option value="tunai">Tunai</option>
												<option value="transfer">Transfer</option>
											</select>
										</div>
										<div class="form-group col-md-6" id="bank_group">
											<label for="kode_bank"><strong>Bank</strong></label>
											<select name="kode_bank" id="kode_bank" class="form-control">
												<option value="" selected>--Pilih --</option>
												<?php foreach ($all_bank as $bank): ?>
													<option value="<?= $bank->kode_bank ?>"><?= $bank->nama_bank ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
									</div>
								</form>
							</div>				
						</div>
					</div>
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script>
		$(document).ready(function(){
			$('#bank_group').hide();
			$('#sistem_group').hide();
			$('#sistem_pembayaran').on('change', function(){
				if ($(this).val() == 'transfer') {
					$('#bank_group').show();
					$('select#kode_bank').prop('required', true);
				}else{
					$('#bank_group').hide();
					$('select#kode_bank').prop('required', false);
				}
			})
			$('#hutang').on('change', function(){
				if ($(this).val() == 'TIDAK') {
					$('#sistem_group').show();
					$('select#sistem_pembayaran').prop('required', true);
				}else{
					$('#sistem_group').hide();
					$('select#sistem_pembayaran').prop('required', false);
				}
			})
		})
	</script>
</body>
</html>