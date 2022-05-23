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
						<h1 class="h3 m-0 text-gray-800"><?= $title." <b>". $pelanggan->nama_pelanggan."</b>" ?></h1>
					</div>
					<div class="float-right">	
						<a href="<?= base_url('member/export/').$pelanggan->kode_pelanggan ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
						<a href="<?= base_url('member/tambah/'.$pelanggan->kode_pelanggan) ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
						<a href="<?= base_url('pelanggan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php elseif($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
				<div class="card shadow">
					<div class="card-header"><strong>Daftar Member</strong></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-10">
								<div class="table-responsive">
									<table class="table table-borderless">
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
										<tr>
											<td><strong>Alamat</strong></td>
											<td>:</td>
											<td><?= $pelanggan->alamat ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
						<hr>
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Kode member</td>
										<td>Nama member</td>
										<td>Alamat</td>
										<td>Level</td>
										<td>Aksi</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_member as $member): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $member->kode_member ?></td>
											<td><?= $member->nama_member ?></td>
											<td><?= $member->alamat ?></td>
											<td><?= $member->level ?></td>
											<td>
												<a href="<?= base_url('member/ubah/' . $member->kode_member) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
												<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('member/hapus/' . $member->kode_member) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
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
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<!-- extension responsive -->
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.responsive.min.js"></script>
	<!-- Plugin Controler -->
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	
</body>
</html> 