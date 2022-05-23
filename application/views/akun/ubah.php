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
			<div id="content" data-url="<?= base_url('akun') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('akun') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('akun/proses_ubah/' . $akun->kode_akun) ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_akun"><strong>Kode Akun</strong></label>
											<input type="text" name="kode_akun" placeholder="Masukkan Kode akun" autocomplete="off"  class="form-control" required value="<?= $akun->kode_akun ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_akun"><strong>Nama Akun</strong></label>
											<input type="text" name="nama_akun" placeholder="Masukkan Nama akun" autocomplete="off"  class="form-control" required value="<?= $akun->nama_akun ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="no_akun"><strong>Nomor Akun</strong></label>
											<input type="text" name="no_akun" placeholder="Masukkan Nomor akun" autocomplete="off"  class="form-control" required value="<?= $akun->no_akun ?>">
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