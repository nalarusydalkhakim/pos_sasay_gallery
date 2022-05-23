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
			<div id="content" data-url="<?= base_url('pelanggan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('pelanggan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('pelanggan/proses_ubah/' . $pelanggan->id) ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_pelanggan"><strong>Kode Customer</strong></label>
											<input type="text" name="kode_pelanggan" placeholder="Masukkan Kode pelanggan" autocomplete="off"  class="form-control" required value="<?= $pelanggan->kode_pelanggan ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="nama_pelanggan"><strong>Nama Customer</strong></label>
											<input type="text" name="nama_pelanggan" placeholder="Masukkan Nama pelanggan" autocomplete="off"  class="form-control" required value="<?= $pelanggan->nama_pelanggan ?>">
										</div>
									</div>
									<div class="form-row">
									<div class="form-group col-md-6">
											<label for="level"><strong>Level</strong></label>
											<input type="text" name="level" placeholder="Level" autocomplete="off"  class="form-control" required value="<?= $pelanggan->level ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="saldo"><strong>Saldo</strong></label>
											<input type="number" name="saldo" placeholder="Isi saldo.." autocomplete="off"  class="form-control" required value="<?= $pelanggan->saldo ?>">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="alamat"><strong>Alamat</strong></label>
											<input type="text" name="alamat" placeholder="Masukkan Nama pelanggan" autocomplete="off"  class="form-control" required value="<?= $pelanggan->alamat ?>">
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
		function myFunction() {
		var x = document.getElementById("myPassword");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
		}
	</script>
</body>
</html>