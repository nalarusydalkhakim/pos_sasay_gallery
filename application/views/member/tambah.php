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
			<div id="content" data-url="<?= base_url('member') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('member/detail/'.$kode_pelanggan) ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('member/proses_tambah') ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_member"><strong>Kode Member</strong></label>
											<input type="text" name="kode_member" placeholder="Masukkan Kode member" autocomplete="off"  value="M-<?= mt_rand(1000000, 9999999) ?>" class="form-control" required  maxlength="15" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="kode_pelanggan"><strong>Kode Customer</strong></label>
											<input type="text" name="kode_pelanggan" placeholder="Masukkan Kode member" autocomplete="off"  value="<?= $kode_pelanggan?>" class="form-control" required  maxlength="15" readonly>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="nama_member"><strong>Nama Member</strong></label>
											<input type="text" name="nama_member" placeholder="Masukkan Nama Member" autocomplete="off"  class="form-control" required>
										</div>
										<div class="form-group col-md-6">
											<label for="level"><strong>Level</strong></label>
											<select name="level" id="level" class="form-control" required>
												<option value="">-- Silahkan Pilih --</option>
												<option value="agen" selected>Agen</option>
												<option value="sub agen">Sub Agen</option>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="alamat"><strong>alamat</strong></label>
											<input type="text" name="alamat" placeholder="Masukkan Nama Member" autocomplete="off"  class="form-control" required>
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