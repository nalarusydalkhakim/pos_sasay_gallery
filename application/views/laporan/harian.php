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
			<div id="content" data-url="<?= base_url('laporan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?> (<?=''.($omset_harian->tanggal ? $omset_harian->tanggal : 'Belum ada transaksi') ?>)</h1>
					</div>
					<div class="float-right">
						<form class="form-inline" action="<?= base_url('laporan') ?>" method="post">
						<!-- <p id='demo'>pp</p> -->
							<select class="form-control" name="tahun" id='tahun'>
								<option selected="selected" disabled="disabled" value="" selected>Pilih Tahun</option>
								<?php foreach ($get_tahun as $tahun): ?>
									<option value="<?= $tahun->tahun ?>"><?= $tahun->tahun ?></option>
								<?php endforeach ?>
							</select>
							<select class="form-control" name="bulan" id='bulan' style="margin-left:3px">
								<option selected="selected" disabled="disabled" value="" selected>Pilih Bulan</option>
							</select>
							<select class="form-control" name="tanggal" id='tanggal'  style="margin-left:3px">
								<option selected="selected" disabled="disabled" value="" selected>Pilih Tanggal</option>
							</select>
							<button type="submit" class="btn btn-primary" style="margin-left:5px"><i class="fa fa-search"></i></button>
							<a href="<?= base_url('laporan') ?>" class="btn btn-success" style="margin-left:3px"><i class="fa fa-reply"></i></a>
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
				<div class="row">

		            <!-- Earnings (total) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-primary shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
							<?php if ($this->session->login['role'] == 'admin'): ?>
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Omset Penjualan</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($omset_harian->omset, 0, ',', '.') ?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-coins fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
							<?php if ($this->session->login['role'] == 'kasir'): ?>
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Barang</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_barang ?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-box fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
		                  </div>
		                </div>
		              </div>
		            </div>

		            <!-- Earnings (Monthly) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-success shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
						  	<?php if ($this->session->login['role'] == 'admin'): ?>
								<div class="col mr-2">
									<?php $laba =  $omset_harian->omset - $modal_harian->modal?>
									<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Laba Penjualan</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($laba, 0, ',', '.') ?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
							<?php if ($this->session->login['role'] == 'kasir'): ?>
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kasir</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_kasir ?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-cash-register fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
		                  </div>
		                </div>
		              </div>
		            </div>

		            <!-- Earnings (Monthly) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-info shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Transaksi</div>
		                      <div class="row no-gutters align-items-center">
		                        <div class="col-auto">
		                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah_transaksi_harian ?></div>
		                        </div>
		                      </div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>

		            <!-- Pending Requests Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-warning shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
		                    <div class="col mr-2">
		                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Item Terjual</div>
		                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_item_terjual_harian->item ?></div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-box fa-2x text-gray-300"></i>
		                    </div>
		                  </div>
		                </div>
		              </div>
					</div>
					<!-- end of card -->
				  </div>
				  <!-- Content Row -->
				  <div class="row">
					<!-- Content Column -->
					<div class="col-lg-6 mb-4">
						<!-- Project Card Example -->
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Penjualan Terbanyak</h6>
							</div>
							<div class="card-body">
								<?php foreach ($item_terlaris_harian as $item): ?>
									<?php $presentase = ($item->kuantitas/$jumlah_item_terjual_harian->item) * 100;?>
									<h4 class="small font-weight-bold"><?= $item->nama_barang ?> (<?= $item->nama_brand ?>) <span class="float-right"><?= $item->kuantitas?></span></h4>
									<div class="progress mb-4">
										<div class="progress-bar bg-danger" role="progressbar" style="width: <?= $presentase?>%" aria-valuenow="<?= $presentase?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
					<!-- Pie Chart -->
					<div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Brand Dengan Omset Terbanyak</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <!-- <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Direct
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Social
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Referral
                                        </span>
                                    </div> -->
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

	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	
	<!-- Page level plugins -->
	<script src="<?= base_url('sb-admin') ?>/vendor/chart.js/Chart.min.js"></script>
	
	<!-- Page level plugins -->
	<script>
		// Set new default font family and font color to mimic Bootstrap's default styling
		Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
		Chart.defaults.global.defaultFontColor = '#858796';

		function number_format(number, decimals, dec_point, thousands_sep) {
		// *     example: number_format(1234.56, 2, ',', ' ');
		// *     return: '1 234,56'
		number = (number + '').replace(',', '').replace(' ', '');
		var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function(n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
			};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
		}

		// Pie Chart Example
		var ctx = document.getElementById("myPieChart");
		var myPieChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: [
				<?php
					foreach ($brand_terlaris_harian as $data) {
						echo "'" .$data->nama_brand."',";
					}
          		?>
			],
			datasets: [{
			data: [
				<?php
					foreach ($brand_terlaris_harian as $data) {
						echo "" .$data->kuantitas.",";
					}
          		?>
			],
			backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#F0B36A', '#0591AF', '#cab287'],
			hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#F09440', '#0591AF', '#cab287'],
			hoverBorderColor: "rgba(234, 236, 244, 1)",
			}],
		},
		options: {
			maintainAspectRatio: false,
			tooltips: {
			backgroundColor: "rgb(255,255,255)",
			bodyFontColor: "#858796",
			borderColor: '#dddfeb',
			borderWidth: 1,
			xPadding: 15,
			yPadding: 15,
			displayColors: true,
			caretPadding: 10,
			callbacks: {
					label: function(tooltipItem, data) {
					var datasetLabel = data.labels[tooltipItem.index] || '';
					return datasetLabel + ': Rp. ' + number_format(data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index]);
					}
				}
			},
			legend: {
			display: false
			},
			cutoutPercentage: 40,
		},
		});

	</script>
	<script>
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

		$("#bulan").change(function(){

			// variabel dari nilai combo box kendaraan
			var bulan = $("#bulan").val();
			// document.getElementById("demo").innerHTML = bulan;
			// Menggunakan ajax untuk mengirim dan dan menerima data dari server
			$.ajax({
				url : "<?php echo base_url();?>/laporan/get_tanggal",
				method : "POST",
				data : {bulan:bulan},
				async : false,
				dataType : 'json',
				success: function(data){
					var html = '';
					var i;

					html = '<option selected="selected" disabled="disabled" value="" selected>Pilih Tanggal</option>'

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