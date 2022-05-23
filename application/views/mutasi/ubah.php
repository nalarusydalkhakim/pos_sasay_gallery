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
			<div id="content" data-url="<?= base_url('kategori') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('member/detail/',$member->kode_pelanggan) ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('member/proses_ubah/' . $member->kode_member) ?>" id="form-tambah" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="kode_member"><strong>Kode Member</strong></label>
											<input type="text" name="kode_member" placeholder="Masukkan Kode Member" autocomplete="off"  class="form-control" required value="<?= $member->kode_member ?>" maxlength="8" readonly>
										</div>
										<div class="form-group col-md-6">
											<label for="kode_pelanggan"><strong>Kode Pelanggan</strong></label>
											<input type="text" name="kode_pelanggan" placeholder="Masukkan Kode pelanggan" autocomplete="off"  class="form-control" required value="<?= $member->kode_pelanggan ?>" maxlength="8" readonly>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="nama_member"><strong>Nama Member</strong></label>
											<input type="text" name="nama_member" placeholder="Masukkan Nama Member" autocomplete="off"  class="form-control" required value="<?= $member->nama_member ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="level"><strong>Level</strong></label>
											<select name="level" id="level" class="form-control" required>
												<option value="">-- Silahkan Pilih --</option>
												<option value="agen" <?= 'agen' == $member->level? 'selected' : '' ?>>Agen</option>
												<option value="sub agen" <?= 'sub agen' == $member->level? 'selected' : '' ?>>Sub Agen</option>
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
</body>
</html>