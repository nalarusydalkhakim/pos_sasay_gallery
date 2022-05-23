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
			<div id="content" data-url="<?= base_url('bank') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('bank') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('bank/proses_tambah') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_bank"><strong>Kode Bank</strong></label>
											<!-- value="<?= mt_rand(10000000, 99999999) ?>" -->
											<input type="text" name="kode_bank" placeholder="Masukkan Kode Bank" autocomplete="off"  value="BANK-<?= mt_rand(1000000, 9999999) ?>" class="form-control" required  maxlength="15" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_bank"><strong>Nama Bank</strong></label>
											<input type="text" name="nama_bank" placeholder="Masukkan Nama Bank" autocomplete="off"  class="form-control" required>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="no_rekening"><strong>No Rekening</strong></label>
											<input type="text" name="no_rekening" placeholder="Masukkan No Rekening" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_pemilik"><strong>Nama Pemilik</strong></label>
											<input type="text" name="nama_pemilik" placeholder="Masukkan Nama Pemilik" autocomplete="off"  class="form-control" required>
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
</body>
</html>