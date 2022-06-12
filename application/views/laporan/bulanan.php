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
							<h1 class="h3 m-0 text-gray-800"><?= $title ?> (<?=''.($omset_bulanan->tanggal ? $omset_bulanan->tanggal : 'Belum ada transaksi') ?>)</h1>
						</div>
						<div class="float-right">
							<form class="form-inline" action="<?= base_url('laporan/bulanan') ?>" method="post">
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
								<button type="submit" class="btn btn-primary" style="margin-left:5px"><i class="fa fa-search"></i></button>
								<a href="<?= base_url('laporan/bulanan') ?>" class="btn btn-success" style="margin-left:3px"><i class="fa fa-reply"></i></a>
								<button type="button" class="btn btn-danger btn-sm" style="margin-left:5px;" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Cetak Laba Rugi</button>
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
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Omset Penjualan</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($omset_bulanan->omset, 0, ',', '.') ?></div>
									</div>
										<div class="col-auto">
										<i class="fas fa-coins fa-2x text-gray-300"></i>
									</div>
		                  		</div>
		                	</div>
		              	</div>
		            </div>

		            <!-- Earnings (Monthly) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              	<div class="card border-left-success shadow h-100 py-2">
		                	<div class="card-body">
		                  		<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengeluaran</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($pengeluaran_bulanan->total, 0, ',', '.')?></div>
									</div>
										<div class="col-auto">
										<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
									</div>
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
									<?php $laba =  $omset_bulanan->omset - $pengeluaran_bulanan->total - $harga_pokok->hpp?>
										<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Laba Penjualan</div>
										<div class="row no-gutters align-items-center">
											<div class="col-auto">
												<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($laba, 0, ',', '.') ?></div>
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
										<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Hutang</div>
										<div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($total_hutang->hutang, 0, ',', '.') ?></div>
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
								<h6 class="m-0 font-weight-bold text-primary">Pendapatan Member Terbanyak</h6>
							</div>
							<div class="card-body">
								<?php foreach ($pendapatan_terbanyak as $item): ?>
									<?php $presentase = ($item->pendapatan/$jumlah_pendapatan_terbanyak->pendapatan) * 100;?>
									<h4 class="small font-weight-bold"><?= $item->nama_pelanggan?> <span class="float-right">Rp.<?= number_format($item->pendapatan, 0, ',', '.')?></span></h4>
									<div class="progress mb-4">
										<div class="progress-bar bg-primary" role="progressbar" style="width: <?= $presentase?>%" aria-valuenow="<?= $presentase?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
					<!-- Content Column -->
					<div class="col-lg-6 mb-4">
						<!-- Project Card Example -->
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Item Terlaris</h6>
							</div>
							<div class="card-body">
								<?php foreach ($item_terlaris as $item): ?>
									<?php $presentase = ($item->kuantitas/$jumlah_item_terjual_bulanan->item) * 100;?>
									<h4 class="small font-weight-bold"><?= $item->nama_barang ?> <span class="float-right"><?= number_format($item->kuantitas, 0, ',', '.')?></span></h4>
									<div class="progress mb-4">
										<div class="progress-bar bg-primary" role="progressbar" style="width: <?= $presentase?>%" aria-valuenow="<?= $presentase?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
				<!-- Bar Chart -->
				<div class="row">
					<div class="col-xl-8 col-lg-6">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Brand</h6>
							</div>
							<div class="card-body">
								<div class="chart-bar">
									<canvas id="myBarChart"></canvas>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-lg-6">
						<!-- Project Card Example -->
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Perolehan Kasir</h6>
							</div>
							<div class="card-body">
								<?php foreach ($penjualan_kasir as $penjualan): ?>
									<?php $presentase = ($penjualan->penjualan/$jumlah_pendapatan_terbanyak->pendapatan) * 100;?>
									<h4 class="small font-weight-bold"><?= $penjualan->nama_kasir ?> <span class="float-right">Rp. <?= number_format($penjualan->penjualan, 0, ',', '.')?></span></h4>
									<div class="progress mb-4">
										<div class="progress-bar bg-primary" role="progressbar" style="width: <?= $presentase?>%" aria-valuenow="<?= $presentase?>" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								<?php endforeach ?>
							</div>
						</div>
					</div>
				</div>
				<!-- Line Chart -->
				<div class="col-xl-12 col-lg-6">
					<div class="card shadow mb-4">
						<!-- Card Header - Dropdown -->
						<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan</h6>
							<div class="dropdown no-arrow">
								<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
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
							<div class="chart-area">
								<canvas id="myAreaChart"></canvas>
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
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form  action="<?= base_url('laporan/export_laba_rugi_bulanan') ?>" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Cetak Laporan Laba Rugi</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					
					<label for="modal_tahun"><strong>Tahun</strong></label>
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

	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	
	<!-- Page level plugins -->
	<script src="<?= base_url('sb-admin') ?>/vendor/chart.js/Chart.min.js"></script>

	
	<!-- Chart -->
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
		// Area Chart Example
		var ctx = document.getElementById("myAreaChart");
		var myLineChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [
				<?php
					foreach ($get_omset as $data) {
						echo '"' .$data->periode.'",';
					}
          		?>
			],
			datasets: [{
			label: "Pendapatan",
			lineTension: 0.3,
			backgroundColor: "rgba(78, 115, 223, 0.5)",
			borderColor: "rgba(78, 115, 223, 1)",
			pointRadius: 3,
			pointBackgroundColor: "rgba(78, 115, 223, 1)",
			pointBorderColor: "rgba(78, 115, 223, 1)",
			pointHoverRadius: 3,
			pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
			pointHoverBorderColor: "rgba(78, 115, 223, 1)",
			pointHitRadius: 10,
			pointBorderWidth: 2,
			// data: [0,300, 400, 500, 200]
			data: [
				<?php
					foreach ($get_omset as $data) {
						echo "" .$data->omset.",";
					}
          		?>
			]
			}],
		},
		options: {
			maintainAspectRatio: false,
			layout: {
			padding: {
				left: 10,
				right: 25,
				top: 25,
				bottom: 0
			}
			},
			scales: {
			xAxes: [{
				time: {
				unit: 'date'
				},
				gridLines: {
				display: false,
				drawBorder: false
				},
				ticks: {
				maxTicksLimit: 32
				}
			}],
			yAxes: [{
				ticks: {
				maxTicksLimit: 8,
				padding: 10,
				// Include a dollar sign in the ticks
				callback: function(value, index, values) {
					return 'Rp. ' + number_format(value);
				}
				},
				gridLines: {
				color: "rgb(234, 236, 244)",
				zeroLineColor: "rgb(234, 236, 244)",
				drawBorder: false,
				borderDash: [2],
				zeroLineBorderDash: [2]
				}
			}],
			},
			legend: {
			display: false
			},
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				titleMarginBottom: 10,
				titleFontColor: '#6e707e',
				titleFontSize: 14,
				borderColor: '#dddfeb',
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				intersect: false,
				mode: 'index',
				caretPadding: 10,
				callbacks: {
					label: function(tooltipItem, chart) {
					var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
					return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
					}
				}
			}
		}
		});

		// Bar Chart Example
		// var ctx = document.getElementById("myBarChart");
		// var myBarChart = new Chart(ctx, {
		// type: 'bar',
		// data: {
		// 	labels: [
		// 		<?php
		// 			foreach ($brand_terlaris_bulanan as $data) {
		// 				echo '"' .$data->nama_brand.'",';
		// 			}
        //   		?>
		// 	],
		// 	datasets: [{
		// 	label: "Revenue",
		// 	backgroundColor: "#4e73df",
		// 	hoverBackgroundColor: "#2e59d9",
		// 	borderColor: "#4e73df",
		// 	data: [<?php
		// 			foreach ($brand_terlaris_bulanan as $data) {
		// 				echo "" .$data->kuantitas.",";
		// 			}
        //   		?>],
		// 	}],
		// },
		// options: {
		// 	maintainAspectRatio: false,
		// 	layout: {
		// 	padding: {
		// 		left: 10,
		// 		right: 25,
		// 		top: 25,
		// 		bottom: 0
		// 	}
		// 	},
		// 	scales: {
		// 	xAxes: [{
		// 		time: {
		// 		unit: 'month'
		// 		},
		// 		gridLines: {
		// 		display: false,
		// 		drawBorder: false
		// 		},
		// 		ticks: {
		// 		maxTicksLimit: 20
		// 		},
		// 		maxBarThickness: 25,
		// 	}],
		// 	yAxes: [{
		// 		ticks: {
		// 		min: 0,
		// 		max: 10000000,
		// 		// maxTicksLimit: 5,
		// 		padding: 10,
		// 		// Include a dollar sign in the ticks
		// 		callback: function(value, index, values) {
		// 			return 'Rp.' + number_format(value);
		// 		}
		// 		},
		// 		gridLines: {
		// 		color: "rgb(234, 236, 244)",
		// 		zeroLineColor: "rgb(234, 236, 244)",
		// 		drawBorder: false,
		// 		borderDash: [2],
		// 		zeroLineBorderDash: [1]
		// 		}
		// 	}],
		// 	},
		// 	legend: {
		// 	display: false
		// 	},
		// 	tooltips: {
		// 	titleMarginBottom: 10,
		// 	titleFontColor: '#6e707e',
		// 	titleFontSize: 14,
		// 	backgroundColor: "rgb(255,255,255)",
		// 	bodyFontColor: "#858796",
		// 	borderColor: '#dddfeb',
		// 	borderWidth: 1,
		// 	xPadding: 15,
		// 	yPadding: 15,
		// 	displayColors: false,
		// 	caretPadding: 10,
		// 	callbacks: {
		// 		label: function(tooltipItem, chart) {
		// 		var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
		// 		return datasetLabel + ': Rp.' + number_format(tooltipItem.yLabel);
		// 		}
		// 	}
		// 	},
		// }
		// });
		var ctx = document.getElementById("myBarChart");
		var myLineChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [
				<?php
					foreach ($brand_terlaris_bulanan as $data) {
						echo '"' .$data->nama_brand.'",';
					}
          		?>
			],
			datasets: [{
			label: "Pendapatan",
			lineTension: 0.3,
			backgroundColor: "rgba(78, 115, 223, 0.5)",
			borderColor: "rgba(78, 115, 223, 1)",
			pointRadius: 3,
			pointBackgroundColor: "rgba(78, 115, 223, 1)",
			pointBorderColor: "rgba(78, 115, 223, 1)",
			pointHoverRadius: 3,
			pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
			pointHoverBorderColor: "rgba(78, 115, 223, 1)",
			pointHitRadius: 10,
			pointBorderWidth: 2,
			// data: [0,300, 400, 500, 200]
			data: [
				<?php
					foreach ($brand_terlaris_bulanan as $data) {
						echo "" .$data->kuantitas.",";
					}
          		?>
			]
			}],
		},
		options: {
			maintainAspectRatio: false,
			layout: {
			padding: {
				left: 10,
				right: 25,
				top: 25,
				bottom: 0
			}
			},
			scales: {
			xAxes: [{
				time: {
				unit: 'date'
				},
				gridLines: {
				display: false,
				drawBorder: false
				},
				ticks: {
				maxTicksLimit: 32
				}
			}],
			yAxes: [{
				ticks: {
				maxTicksLimit: 8,
				padding: 10,
				// Include a dollar sign in the ticks
				callback: function(value, index, values) {
					return 'Rp. ' + number_format(value);
				}
				},
				gridLines: {
				color: "rgb(234, 236, 244)",
				zeroLineColor: "rgb(234, 236, 244)",
				drawBorder: false,
				borderDash: [2],
				zeroLineBorderDash: [2]
				}
			}],
			},
			legend: {
			display: false
			},
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				titleMarginBottom: 10,
				titleFontColor: '#6e707e',
				titleFontSize: 14,
				borderColor: '#dddfeb',
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				intersect: false,
				mode: 'index',
				caretPadding: 10,
				callbacks: {
					label: function(tooltipItem, chart) {
					var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
					return datasetLabel + ': Rp. ' + number_format(tooltipItem.yLabel);
					}
				}
			}
		}
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