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
			<div id="content" data-url="<?= base_url('penjualan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</button>
						<!-- <a href="<?= base_url('penjualan/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
						<a href="<?= base_url('penjualan/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
					<div class="card-header"><strong>Daftar Penjualan</strong></div>
					<div class="card-body">
						<form action="<?= base_url('penjualan') ?>" method="post">
							<div class="input-group mb-3">
								<input type="text" class="form-control" placeholder="Search" id="keyword" name="keyword" autocomplete="off">
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
									<button class="btn btn-success" type="button"><i class="fa fa-reply"></i></button>
								</div>
							</div>
						</form>
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No Penjualan</th>
										<th>Nama Kasir</th>
										<th>Nama Customer</th>
										<th>Tanggal Penjualan</th>
										<th>Total</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_penjualan as $penjualan): ?>
										<tr>
											<td><?= $penjualan->no_penjualan ?></td>
											<td><?= $penjualan->nama_kasir ?></td>
											<td><?= $penjualan->nama_pelanggan ?></td>
											<td><?= $penjualan->tgl_penjualan ?> Pukul <?= $penjualan->jam_penjualan ?></td>
											<td>Rp <?= number_format($penjualan->jumlah_total, 0, ',', '.') ?></td>
											<td>
												<a href="<?= base_url('penjualan/detail/' . $penjualan->no_penjualan) ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
												<a href="<?= base_url('penjualan/export_detail_a5/' . $penjualan->no_penjualan) ?>" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-print"></i></a>
												<a href="<?= base_url('penjualan/export_detail_thermal/' . $penjualan->no_penjualan) ?>" class="btn btn-secondary btn-sm" target="_blank"><i class="fa fa-print"></i></a>
												<a onclick="return confirm('apakah anda yakin?')" href="<?= base_url('penjualan/hapus/' . $penjualan->no_penjualan) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						<?= $this->pagination->create_links(); ?>
					</div>				
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form  action="<?= base_url('penjualan/export') ?>" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Cetak Laporan Penjualan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<label for="tahun"><strong>Tahun</strong></label>
					<select class="form-control" name="tahun" id='tahun'>
						<option selected="selected" disabled="disabled" value="" selected>Pilih Tahun</option>
							<?php foreach ($get_tahun as $tahun): ?>
								<option value="<?= $tahun->tahun ?>"><?= $tahun->tahun ?></option>
							<?php endforeach ?>
					</select>
					<label for="bulan" style="margin-top: 10px;"><strong>Bulan</strong></label>
					<select class="form-control" name="bulan" id='bulan'>
						<option selected="selected" disabled="disabled" value="" selected>Pilih Bulan</option>
					</select>
					<label for="tanggal" style="margin-top: 10px;"><strong>Tanggal</strong></label>
					<select class="form-control" name="tanggal" id='tanggal'>
						<option selected="selected" disabled="disabled" value="" selected>Pilih Tanggal</option>
					</select>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Cetak</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<!-- Optional JavaScript -->
	
    <!-- extension responsive -->
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.responsive.min.js"></script>
	<!-- Plugin Controler -->
	<script src="<?= base_url('sb-admin/js/demo/datatables-no-pagination.js') ?>"></script>
	<script>
		$('#myModal').on('shown.bs.modal', function () {
			$('#myInput').trigger('focus')
		})
		$("#tahun").change(function(){
			// variabel dari nilai combo box kendaraan
			var tahun = $("#tahun").val();
			// Menggunakan ajax untuk mengirim dan dan menerima data dari server
			$.ajax({
				url : "<?=base_url('penjualan')?>/get_bulan",
				method : "POST",
				data : {tahun:tahun},
				async : false,
				dataType : 'json',
				success: function(data){
					var html = '<option selected="selected" disabled="disabled" value="" selected>Pilih Bulan</option>';
					var i;

					for(i=0; i<data.length; i++){
						html += '<option value='+data[i].bulan+'>'+data[i].bulan+'</option>';
					}
					$('#bulan').html(html);
				}
			});
		});
		$("#bulan").change(function(){
			// variabel dari nilai combo box kendaraan
			var tahun = $("#tahun").val();
			var bulan = $("#bulan").val();
			// Menggunakan ajax untuk mengirim dan dan menerima data dari server
			$.ajax({
				url : "<?=base_url('penjualan')?>/get_tanggal",
				method : "POST",
				data : {tahun:tahun, bulan:bulan},
				async : false,
				dataType : 'json',
				success: function(data){
					var html = '<option selected="selected" disabled="disabled" value="" selected>Pilih Tanggal</option>';
					var i;

					for(i=0; i<data.length; i++){
						html += '<option value='+data[i].tanggal+'>'+data[i].tanggal+'</option>';
					}
					$('#tanggal').html(html);
				}
			});
		});
	</script>
</body>
</html>