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
			<div id="content" data-url="<?= base_url('kasir') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<!-- <div class="float-right">
						<form class="form-inline" action="<?= base_url('pelanggan/laporan') ?>" method="post">
							<select class="form-control" name="bulan" id='bulan'>
								<option selected="selected" disabled="disabled" value="" selected>Pilih Bulan</option>
								<?php foreach ($get_omset as $data): ?>
									<option value="<?= $data->omset ?>"><?= $data->omset?></option>
								<?php endforeach ?>
							</select>
							<button type="submit" class="btn btn-primary" style="margin-left:5px"><i class="fa fa-search"></i></button>
						</form>
					</div> -->
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
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pendapatan Penjualan</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($omset_penjualan->omset, 0, ',', '.') ?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-coins fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
							<?php if ($this->session->login['role'] == 'kasir'): ?>
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Item Terjual</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_item_terjual->item ?></div>
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
									<div class="text-xs font-weight-bold text-success  text-uppercase mb-1">Pengeluaran</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_pengeluaran->total, 0, ',', '.') ?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-file-invoice fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
							<?php if ($this->session->login['role'] == 'kasir'): ?>
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Item Tersedia</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $modal_ditoko->stok ?></div>
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
		              <div class="card border-left-info shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
						  <?php if ($this->session->login['role'] == 'admin'): ?>
								<div class="col mr-2">
									<?php $laba =  $omset_penjualan->omset - $total_pengeluaran->total - $harga_pokok->hpp?>
									<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Laba Penjualan</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($laba, 0, ',', '.') ?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
							<?php if ($this->session->login['role'] == 'kasir'): ?>
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Transaksi</div>
										<div class="row no-gutters align-items-center">
											<div class="col-auto">
												<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=number_format($jumlah_penjualan , 0, ',', '.') ?></div>
											</div>
										</div>
									</div>
								<div class="col-auto">
								<i class="fas fa-file-invoice fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
		                  	</div>
		                </div>
		              </div>
		            </div>

		            <!-- Pending Requests Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-warning shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
						  	<?php if ($this->session->login['role'] == 'admin'): ?>
								<div class="col mr-2">
									<!-- <?php $laba =  $omset_penjualan->omset - $total_pengeluaran->total?> -->
									<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Hutang</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_hutang->hutang, 0, ',', '.') ?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
							<?php if ($this->session->login['role'] == 'kasir'): ?>
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Customer</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pelanggan ?></div>
								</div>
								<div class="col-auto">
									<i class="fas fa-users fa-2x text-gray-300"></i>
								</div>
							<?php endif ?>
		                  </div>
		                </div>
		              </div>
					</div>

					
					<?php if ($this->session->login['role'] == 'admin'): ?>

					<!-- Earnings (total) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-primary shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
						  	<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Transaksi</div>
									<div class="row no-gutters align-items-center">
										<div class="col-auto">
											<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=number_format($jumlah_penjualan , 0, ',', '.') ?></div>
										</div>
									</div>
								</div>
								<div class="col-auto">
								<i class="fas fa-cash-register fa-2x text-gray-300"></i>
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
									<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Item Tersedia</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($modal_ditoko->stok , 0, ',', '.')?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-box fa-2x text-gray-300"></i>
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
		                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Item Terjual</div>
		                      <div class="row no-gutters align-items-center">
		                        <div class="col-auto">
		                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=  number_format($jumlah_item_terjual->item, 0, ',', '.') ?></div>
		                        </div>
		                      </div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-box fa-2x text-gray-300"></i>
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
		                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Customer</div>
		                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pelanggan ?></div>
		                    </div>
		                    <div class="col-auto">
		                      <i class="fas fa-users fa-2x text-gray-300"></i>
		                    </div>
		                  </div>
		                </div>
		              </div>
					</div>		
					
					<!-- Earnings (total) Card Example -->
		            <div class="col-xl-3 col-md-6 mb-4">
		              <div class="card border-left-primary shadow h-100 py-2">
		                <div class="card-body">
		                  <div class="row no-gutters align-items-center">
								<div class="col mr-2">
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Piutang</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_piutang->hutang, 0, ',', '.') ?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
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
									<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Deposit</div>
									<div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($total_deposit->deposit , 0, ',', '.')?></div>
								</div>
									<div class="col-auto">
									<i class="fas fa-coins fa-2x text-gray-300"></i>
								</div>
		                  </div>
		                </div>
		              </div>
		            </div>

		            
					<?php endif ?>
					
					<!-- Area Chart -->
					<?php if ($this->session->login['role'] == 'admin'): ?>
					<div class="col-xl-12 col-lg-6">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div
                                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Grafik Pendapatan Penjualan</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Pilih Grafik:</div>
                                        <a class="dropdown-item" href="#">Pendapatan</a>
                                        <a class="dropdown-item" href="#">Pengeluaran</a>
                                        <a class="dropdown-item" href="#">Laba Bersih</a>
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
					<?php endif ?>
				</div>

				
				  
				 

		        <div class="row">
		          	<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Profil Toko</strong></div>
							<div class="card-body">
								<strong>Nama Toko : </strong><br>
								<input  type="text" value="<?= $toko->nama_toko ?>" readonly class="form-control mt-2 mb-2">
								<strong>Nama Pemilik : </strong><br>
								<input  type="text" value="<?= $toko->nama_pemilik ?>" readonly class="form-control mt-2 mb-2">
								<strong>No Telepon : </strong><br>
								<input  type="text" value="<?= $toko->no_telepon ?>" readonly class="form-control mt-2 mb-2">
								<strong>Alamat : </strong><br>
								<input  type="text" value="<?= $toko->alamat ?>" readonly class="form-control mt-2">
							</div>				
						</div>
		          	</div>
		          	<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>User Sedang Login</strong></div>
							<div class="card-body">
								<strong>Nama : </strong><br>
								<input type="text" value="<?= $this->session->login['nama'] ?>" readonly class="form-control mt-2 mb-2">
								<strong>Username : </strong><br>
								<input type="text" value="<?= $this->session->login['username'] ?>" readonly class="form-control mt-2 mb-2">
								<strong>Role : </strong><br>
								<input type="text" value="<?= $this->session->login['role'] ?>" readonly class="form-control mt-2 mb-2">
								<strong>Jam Login : </strong><br>
								<input type="text" value="<?= $this->session->login['jam_masuk'] ?>" readonly class="form-control mt-2">
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
	
	<!-- Page level custom scripts -->
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
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [{
			label: "Pendapatan",
			yAxisID: 'A',
			lineTension: 0.3,
			backgroundColor: "rgba(5, 120, 123, 0.05)",
			borderColor: "rgba(5, 120, 123, 1)",
			pointRadius: 3,
			pointBackgroundColor: "rgba(5, 120, 123, 1)",
			pointBorderColor: "rgba(5, 120, 123, 1)",
			pointHoverRadius: 3,
			pointHoverBackgroundColor: "rgba(5, 120, 123, 1)",
			pointHoverBorderColor: "rgba(5, 120, 123, 1)",
			pointHitRadius: 10,
			pointBorderWidth: 2,
			// data: [0,300, 400, 500, 200]
			data: ['0','0',
				<?php
					foreach ($get_omset as $data) {
						echo "" .$data->omset.",";
					}
          		?>
				]
			},//pemisah chart 1
			// {
			// label: "Pengeluaran",
			// yAxisID: 'A',
			// lineTension: 0.3,
			// backgroundColor: "rgba(227, 49, 32, 0.05)",
			// borderColor: "rgba(227, 49, 32, 1)",
			// pointRadius: 3,
			// pointBackgroundColor: "rgba(227, 49, 32, 1)",
			// pointBorderColor: "rgba(227, 49, 32, 1)",
			// pointHoverRadius: 3,
			// pointHoverBackgroundColor: "rgba(227, 49, 32, 1)",
			// pointHoverBorderColor: "rgba(227, 49, 32, 1)",
			// pointHitRadius: 10,
			// pointBorderWidth: 2,
			// // data: [0,300, 400, 500, 200]
			// data: ['0',
			// 	<?php
			// 		foreach ($get_pengeluaran as $data) {
			// 			echo "" .$data->pengeluaran.",";
			// 		}
          	// 	?>
			// 	]
			// },//pemisah chart 2 rgba(246, 194, 62, 1)
			// {
			// label: "Laba",
			// yAxisID: 'A',
			// lineTension: 0.3,
			// backgroundColor: "rgba(246, 194, 62, 0.05)",
			// borderColor: "rgba(246, 194, 62, 1)",
			// pointRadius: 3,
			// pointBackgroundColor: "rgba(246, 194, 62, 1)",
			// pointBorderColor: "rgba(246, 194, 62, 1)",
			// pointHoverRadius: 3,
			// pointHoverBackgroundColor: "rgba(246, 194, 62, 1)",
			// pointHoverBorderColor: "rgba(246, 194, 62, 1)",
			// pointHitRadius: 10,
			// pointBorderWidth: 2,
			// // data: [0,300, 400, 500, 200]
			// data: ['0',
			// 	<?php
			// 		foreach ($get_hpp as $data) {
			// 			echo "" .$data->hpp.",";
			// 		}
          	// 	?>
			// 	]
			// }
			],
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
				maxTicksLimit: 12
				}
			}],
			yAxes: [{
				id: 'A',
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

    
</body>
</html>