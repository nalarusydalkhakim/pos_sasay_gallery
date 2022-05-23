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
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</button>
						<a href="<?= base_url('pengeluaran/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
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
					<div class="card-header"><strong>Data Pengeluaran</strong> 
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Tanggal</td>
										<td>Jumlah</td>
										<td>Nama Akun</td>
										<td>Kepada</td>
										<td>Hutang</td>
										<td>Sistem Pembayaran</td>
										<td>Bank</td>
										<td>Aksi</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pengeluaran as $pengeluaran): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $pengeluaran->tanggal?></td>
											<td>Rp. <?= number_format($pengeluaran->jumlah, 0, ',', '.') ?></td>
											<td><?= $pengeluaran->nama_akun ?></td>
											<td><?= $pengeluaran->kepada ?></td>
											<td><?= $pengeluaran->hutang ?></td>
											<td><?= strtoupper(($pengeluaran->sistem_pembayaran ? $pengeluaran->sistem_pembayaran : '-'))?></td>
											<td><?= strtoupper(($pengeluaran->nama_bank ? $pengeluaran->nama_bank : '-'))?></td>
											<!-- <?php if ($pengeluaran->nama_bank): ?>
												<td><?= $pengeluaran->nama_bank?></td>
											<?php else: ?>
												<td> - </td>
											<?php endif ?> -->
											<td>
												<!-- <a href="<?= base_url('pengeluaran/ubah/' . $pengeluaran->kode_pengeluaran) ?>" class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a> -->
												<?php if ($pengeluaran->hutang == 'YA') : ?>
													<a href="<?= base_url('pengeluaran/ubah/' . $pengeluaran->kode_pengeluaran) ?>" class="btn btn-primary btn-sm"><i class="fa fa-credit-card"></i></a>
												<?php endif ?>
												<a onclick="return confirm('apakah anda yakin untuk menghapus data ini?')" href="<?= base_url('pengeluaran/hapus/' . $pengeluaran->kode_pengeluaran) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form  action="<?= base_url('pengeluaran/export') ?>" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Cetak Pengeluaran</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<label for="tahun"><strong>Tahun</strong></label>
					<select class="form-control" name="tahun" id='tahun'>
						<option selected="selected" disabled="disabled" value="" selected>Pilih Tahun</option>
							<?php foreach ($all_tahun as $tahun): ?>
								<option value="<?= $tahun->tahun ?>"><?= $tahun->tahun ?></option>
							<?php endforeach ?>
					</select>
					<label for="bulan" style="margin-top: 10px;"><strong>Bulan</strong></label>
					<select class="form-control" name="bulan" id='bulan'>
						<option selected="selected" disabled="disabled" value="" selected>Pilih Bulan</option>
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
	<!-- extension responsive -->
    <script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.responsive.min.js"></script>
	<!-- Plugin Controler -->
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script>
		$('#myModal').on('shown.bs.modal', function () {
			$('#myInput').trigger('focus')
		})
		$("#tahun").change(function(){
			// variabel dari nilai combo box kendaraan
			var tahun = $("#tahun").val();
			// Menggunakan ajax untuk mengirim dan dan menerima data dari server
			$.ajax({
				url : "<?=base_url('pengeluaran')?>/get_bulan",
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
	</script>
</body>
</html>