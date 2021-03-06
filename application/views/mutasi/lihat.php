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
			<div id="content" data-url="<?= base_url('mutasi') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title." <b>". $bank->nama_bank."</b>" ?></h1>
					</div>
					<div class="float-right">	
						<a href="<?= base_url('mutasi/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a>
						<a href="<?= base_url('bank') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
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
					<div class="card-header"><strong>Data Mutasi Bank</strong></div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-10">
								<div class="table-responsive">
									<table class="table table-borderless">
										<tr>
											<td><strong>Kode Bank</strong></td>
											<td>:</td>
											<td><?= $bank->kode_bank ?></td>
											<td><strong>Nama Bank</strong></td>
											<td>:</td>
											<td><?= $bank->nama_bank ?></td>
										</tr>
										<tr>
											<td><strong>Nama Pemilik</strong></td>
											<td>:</td>
											<td><?= $bank->nama_pemilik?></td>
											<td><strong>No Rekening</strong></td>
											<td>:</td>
											<td><?= $bank->no_rekening?></td>
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
										<td>Tipe</td>
										<td>Waktu</td>
										<td>Jumlah</td>
										<td>Keterangan</td>
										<td>Personal</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_mutasi as $mutasi): ?>
										<tr>
											<td><?= $no++ ?></td>
											<?php if ($mutasi->tipe == 'MASUK'): ?>
												<td style="color: #0da32d;font-weight: bold;"><?= $mutasi->tipe ?></td>
											<?php else: ?>
												<td style="color: #ff1414;font-weight: bold;"><?= $mutasi->tipe ?></td>
											<?php endif ?>
											<td><?= $mutasi->tanggal ?>/<?= $mutasi->jam ?></td>
											<td>Rp. <?= number_format($mutasi->jumlah) ?></td>
											<td><?= $mutasi->ket.'-'.$mutasi->kode ?></td>
											<td><?= $mutasi->personal ?></td>
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