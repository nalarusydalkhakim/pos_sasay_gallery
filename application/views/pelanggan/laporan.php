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
						<h1 class="h3 m-0 text-gray-800"><?= $title ?> (<?= $keterangan  ?>)</h1>
						
					</div>
					<div class="float-right">
						<form class="form-inline" action="<?= base_url('pelanggan/laporan') ?>" method="post">
							<select class="form-control" name="brand" id='brand' style="margin-left:3px;margin-top:5px;">
								<option selected="selected" disabled="disabled" value="" selected>Pilih Brand</option>
								<?php foreach ($get_brand as $brand): ?>
									<option value="<?= $brand->nama_brand ?>"><?= $brand->nama_brand ?></option>
								<?php endforeach ?>
							</select>
							<select class="form-control" name="tahun" id='tahun' style="margin-left:3px;margin-top:5px;">
								<option selected="selected" disabled="disabled" value="" selected>Pilih Tahun</option>
								<?php foreach ($get_tahun as $tahun): ?>
									<option value="<?= $tahun->tahun ?>"><?= $tahun->tahun ?></option>
								<?php endforeach ?>
							</select>
							<select class="form-control" name="bulan" id='bulan' style="margin-left:3px;margin-top:5px;">
								<option selected="selected" disabled="disabled" value="" selected>Pilih Bulan</option>
							</select>
							<button type="submit" class="btn btn-primary" style="margin-left:5px;margin-top:5px;"><i class="fa fa-search"></i></button>
							<a href="<?= base_url('pelanggan/laporan') ?>" class="btn btn-success" style="margin-left:3px;margin-top:5px;"><i class="fa fa-reply"></i></a>
							<button type="button" class="btn btn-danger btn-sm" style="margin-left:5px;margin-top:5px;" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</button>
						</form>
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
					<div class="card-header"><strong>Laporan Customer</strong> 
						<div class="float-right">
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No</td>
										<td>Nama</td>
										<td>Kode</td>
                                        <td>Level</td>
										<td>Item</td>
                                        <td>Pendapatan</td>
										<td>Aksi</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($all_pelanggan as $pelanggan): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $pelanggan->nama_pelanggan ?></td>
											<td><?= $pelanggan->kode_pelanggan ?></td>
											<td><?= $pelanggan->level ?></td>
											<td><?= number_format($pelanggan->item, 0, ',', '.') ?></td>
											<td>Rp <?= number_format($pelanggan->total, 0, ',', '.') ?></td>
											<td>
												<a href="<?= base_url('pelanggan/detail_laporan/').$pelanggan->kode_pelanggan ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
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
				<form  action="<?= base_url('pelanggan/export') ?>" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Cetak Laporan Pelanggan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<label for="modal_brand"><strong>Brand</strong></label>
					<select class="form-control" name="modal_brand" id='modal_brand'>
						<option selected="selected" disabled="disabled" value="" selected>Pilih Brand</option>
							<?php foreach ($get_brand as $brand): ?>
								<option value="<?= $brand->nama_brand ?>"><?= $brand->nama_brand ?></option>
							<?php endforeach ?>
					</select>
					<label for="modal_tahun" style="margin-top: 10px;"><strong>Tahun</strong></label>
					<select class="form-control" name="modal_tahun" id='modal_tahun'>
						<option selected="selected" disabled="disabled" value="" selected>Pilih Tahun</option>
							<?php foreach ($get_tahun as $tahun): ?>
								<option value="<?= $tahun->tahun ?>"><?= $tahun->tahun ?></option>
							<?php endforeach ?>
					</select>
					<label for="modal_bulan" style="margin-top: 10px;"><strong>Bulan</strong></label>
					<select class="form-control" name="modal_bulan" id='modal_bulan'>
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

	
	<script>
		// Call the dataTables jQuery plugin
		$(document).ready(function() {
			$('#dataTable').DataTable({
				responsive: true,
				// "order": [[ 4, "desc" ]]
			});
		});
		$('#myModal').on('shown.bs.modal', function () {
			$('#myInput').trigger('focus')
		})
		$("#tahun").change(function(){
			// variabel dari nilai combo box kendaraan
			var tahun = $("#tahun").val();
			// Menggunakan ajax untuk mengirim dan dan menerima data dari server
			$.ajax({
				url : "<?php echo base_url();?>/laporan/get_bulan",
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
		$("#modal_tahun").change(function(){
			// variabel dari nilai combo box kendaraan
			var tahun = $("#modal_tahun").val();
			// Menggunakan ajax untuk mengirim dan dan menerima data dari server
			$.ajax({
				url : "<?php echo base_url();?>/laporan/get_bulan",
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
					$('#modal_bulan').html(html);
				}
			});
		});
	</script>
</body>
</html>