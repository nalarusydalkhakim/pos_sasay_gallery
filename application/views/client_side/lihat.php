<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('stock') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('client_side/partials/topbar.php') ?>
				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title.' '.$data_toko->nama_toko ?></h1>
					</div>
					
				</div>
				<hr>
				<div class="card shadow">
					<div class="card-header"><strong>Daftar Barang</strong></div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Nama Barang</td>
										<td>Kode Barang</td>
										<td>Nama Kategori</td>
										<td>Harga</td>
										<td>Stok (PCS)</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_barang as $barang): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $barang->nama_barang ?></td>
											<td><?= $barang->kode_barang ?></td>
											<td><?= $barang->nama_kategori ?></td>
											<td>Rp <?= number_format($barang->harga_jual, 0, ',', '.') ?></td>
											<td><?= $barang->stok ?></td>
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
    <!-- <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.responsive.min.js"></script> -->
	<!-- Plugin Controler -->
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
</body>
</html>