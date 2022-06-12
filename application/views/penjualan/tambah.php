<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
	<?php $this->load->view('partials/toggle_style.php') ?>
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
						<a href="<?= base_url('penjualan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Kembali</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col">
						<div class="card shadow">
							<div class="card-header"><strong>Isi Form Dibawah Ini!</strong></div>
							<div class="card-body">
								<form action="<?= base_url('penjualan/proses_tambah') ?>" id="form-tambah" method="POST">
									<h5>Data Kasir</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-md-2">
											<label>No. Penjualan</label>
											<input type="text" name="no_penjualan" value="PJ<?= time() ?>" readonly class="form-control">
										</div>
										<div class="form-group col-md-3">
											<label>Kode Kasir</label>
											<input type="text" name="kode_kasir" value="<?= $this->session->login['kode'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-md-3">
											<label>Nama Kasir</label>
											<input type="text" name="nama_kasir" value="<?= $this->session->login['nama'] ?>" readonly class="form-control">
										</div>
										<div class="form-group col-md-2">
											<label>Tanggal Penjualan</label>
											<input type="text" name="tgl_penjualan" value="<?= date('Y-m-d') ?>" readonly class="form-control">
										</div>
										<div class="form-group col-md-2">
											<label>Jam</label>
											<input type="text" name="jam_penjualan" value="<?= date('H:i:s') ?>" readonly class="form-control">
										</div>
									</div>
									<h5>Data Customer</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-md-2">
											<label for="nama_pelanggan" id="nama_customer_err">Nama Customer</label>
											<input list="list_pelanggan" name="nama_pelanggan" id="nama_pelanggan" class="form-control" placeholder="Nama Customer" autocomplete="off">
											<datalist id="list_pelanggan">
												<?php foreach ($all_pelanggan as $pelanggan): ?>
													<option value="<?= $pelanggan->nama_pelanggan ?>"><?= $pelanggan->nama_pelanggan ?></option>
												<?php endforeach ?>
											</datalist>
										</div>
										<input type="hidden" name="id_pelanggan" value="" readonly class="form-control">
										<div class="form-group col-md-2">
											<label>Kode Customer</label>
											<input type="text" name="kode_pelanggan" value="" readonly class="form-control">
										</div>
										<div class="form-group col-md-2">
											<label>Level Customer</label>
											<input type="text" name="level_pelanggan" value="" readonly class="form-control">
										</div>
										<!-- data saldo hidden -->
										<input type="hidden" name="saldo_customer" id="saldo_customer" value="" class="form-control">
										<div class="form-group col-md-2">
											<label>Deposit</label>
											<input type="text" name="deposit_customer" id="deposit_customer" value="" readonly class="form-control">
										</div>
										<div class="form-group col-md-2">
											<label>Hutang</label>
											<input type="text" name="hutang_customer" id="hutang_customer" value="" readonly class="form-control">
										</div>
										<!-- <div class="form-group col-md-2">
											<label>Gunakan Barcode</label><br>
											<label class="switch">
												<input type="checkbox" id="use_barcode" name="use_barcode" value="false">
												<span class="slider round"></span>
											</label>
										</div> -->
										<!-- <div class="form-group col-md-2">
											<label>Gunakan Saldo</label><br>
											<label class="switch">
												<input type="checkbox" id="use_saldo" name="use_saldo" value="false" disabled="true">
												<span class="slider round"></span>
											</label>
										</div> -->
									</div>
									<h5 >Data Barang</h5>
									<hr>
									<div class="form-row">
										<div class="form-group col-md-2">
											<label>Kode Barang</label>
											<!-- <input type="text" name="kode_barang" value="" class="form-control"> -->
											<input  name="kode_barang" id="kode_barang" class="form-control"  placeholder="Scan Disini" autocomplete="off"  readonly>
											<!-- list='list_kode_barang' -->
											<datalist id="list_kode_barang">
												<?php foreach ($all_barang as $barang): ?>
													<option value="<?= $barang->kode_barang ?>"><?= $barang->kode_barang ?></option>
												<?php endforeach ?>
											</datalist>
										</div>
										<div class="form-group col-md-2">
											<label for="nama_barang">Nama Barang</label>
											<input list='list_barang'  name="nama_barang" id="nama_barang" class="form-control"  placeholder="Pilih Barang" autocomplete="off" >
											<datalist id="list_barang">
												<?php foreach ($all_barang as $barang): ?>
													<option value="<?= $barang->nama_barang ?>"><?= $barang->nama_barang ?></option>
												<?php endforeach ?>
											</datalist>
										</div>
										<div class="form-group col-md-2">
											<label>Brand</label>
											<input type="text" name="nama_brand" value="" readonly class="form-control">
										</div>
										<div class="form-group col-md-2">
											<label>Harga Barang</label>
											<input type="text" name="harga_barang" value="" readonly class="form-control">
										</div>
										<div class="form-group col-md-1">
											<label>Jumlah</label>
											<input type="number" name="jumlah" value="" class="form-control" readonly min='1'>
										</div>
										<div class="form-group col-md-1">
											<label>Diskon(%)</label>
											<input type="number" name="diskon" id="diskon" value="" class="form-control" readonly min='0' max='100'>
										</div>
										<div class="form-group col-md-2">
											<label>Sub Total</label>
											<input type="number" name="sub_total" value="" class="form-control" readonly>
										</div>
										<div class="form-group col-md-1">
											<label for="">&nbsp;</label>
											<button disabled type="button" class="btn btn-primary btn-block" id="tambah"><i class="fa fa-plus"></i></button>
										</div>
										<input type="hidden" name="satuan" value="">
									</div>
									<div class="keranjang">
										<h5>Detail Pembelian</h5>
										<hr>
										<div class="table-responsive">
											<table class="table table-bordered" id="keranjang">
												<thead>
													<tr>
														<td width="20%">Nama Barang</td>
														<td width="15%">Brand</td>
														<td width="15%">Harga</td>
														<td width="10%">Jumlah</td>
														<td width="10%">Diskon(%)</td>
														<td width="20%">Sub Total</td>
														<td width="10%">Aksi</td>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
												<tfoot>
													<tr>
														<td colspan="5" align="right"><strong>Total : </strong></td>
														<td id="total"></td>
														<td rowspan="0" style="vertical-align: middle;">
															<input type="hidden" name="total_hidden" value="">
															<input type="hidden" name="jumlah_total_hidden" value="">
															<!-- <input type="hidden" name="pembayaran_hidden" value=""> -->
															<input type="hidden" name="kembalian_hidden" value="">
															<input type="hidden" name="saldo_hidden" value="">
															<input type="hidden" name="max_hidden" value="">
															<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
														</td>
													</tr>
													<tr>
														<td colspan="5" align="right"><strong>Diskon : </strong></td>
														<td><input type="number" name="diskon_total" id="diskon_total"  class="form-control" placeholder="%"></td>
													</tr>
													<tr>
														<td colspan="5" align="right"><strong>Jumlah Total : </strong></td>
														<td id="jumlah_total"></td>
													</tr>
													<!-- <tr id="sisa_saldo_row">
														<td colspan="5" align="right"><strong>Sisa Saldo : </strong></td>
														<td id="sisa_saldo"></td>
													</tr> -->
													<tr id="metode_pembayaran_row">
														<td colspan="5" align="right"><strong>Metode Pembayaran </strong></td>
														<td>
															<select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
																<option value="" selected>--Pilih --</option>
																<option value="cash">Cash</option>
																<option value="kredit">Kredit</option>
															</select>
														</td>
													</tr>
													<!-- Validasi Pembayaran Kredit -->
													<tr id="kredit_validation_row">
														<td colspan="5" align="right" style="color: red;"><strong>Bayar Hutang/Deposit ?</strong></td>
														<td>
															<select name="kredit_validation" id="kredit_validation" class="form-control">
																<option value="" selected>--Pilih --</option>
																<option value="ya">YA</option>
																<option value="tidak">TIDAK</option>
															</select>
														</td>
													</tr>
													<!-- Sistem Pembayaran -->
													<tr id="sistem_pembayaran_row">
														<td colspan="5" align="right"><strong>Sistem Pembayaran </strong></td>
														<td>
															<select name="sistem_pembayaran" id="sistem_pembayaran" class="form-control">
																<option value="" selected>--Pilih --</option>
																<option value="tunai">Tunai</option>
																<option value="transfer">Transfer</option>
															</select>
														</td>
													</tr>
													<!-- End Sistem Pembayaran -->
													<!-- transfer bank -->
													<tr id="transfer_row">
														<td colspan="5" align="right"><strong>Transfer</strong></td>
														<td>
															<select name="kode_bank" id="kode_bank" class="form-control">
																<option value="" selected>--Pilih --</option>
																<?php foreach ($all_bank as $bank): ?>
																	<option value="<?= $bank->kode_bank ?>"><?= $bank->nama_bank ?></option>
																<?php endforeach ?>
															</select>
														</td>
													</tr>
													<!-- end transfer bank -->
													<!-- pembayaran-->
													<tr id="pembayaran_row">
														<td colspan="5" align="right"><strong>Pembayaran</strong></td>
														<td ><input type="number" name="pembayaran" id="pembayaran"  class="form-control" placeholder="Rp.0"></td>
													</tr>
													<!-- end pembayaran -->
													<!-- kembalian -->
													<tr id="kembalian_row">
														<td colspan="5" align="right"><strong>Kembalian</strong></td>
														<td id="kembalian"></td>
													</tr>
													<!-- end kembalian-->
													<!-- saldo -->
													<tr id="saldo_row">
														<td colspan="5" align="right"><strong>Saldo</strong></td>
														<td id="saldo"></td>
													</tr>
													<!-- end saldo -->
													
												</tfoot>
											</table>
										</div>
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
	<script>
		$(document).ready(function(){
			$('tfoot').hide()

			$(document).keypress(function(event){
		    	if (event.which == '13') {
		      		event.preventDefault();
			   	}
			})
			// var switchStatus = false;
			// $("#use_saldo").on('change', function() {
			// 	if ($(this).is(':checked')) {
			// 		switchStatus = $(this).is(':checked');
			// 		alert(switchStatus);// To verify
			// 	}
			// 	else {
			// 	switchStatus = $(this).is(':checked');
			// 	alert(switchStatus);// To verify
			// 	}
			// });
			
			$('#nama_pelanggan').on('change', function(){

			if($(this).val() == '') reset()
			else {
				const url_get_all_pelanggan = $('#content').data('url') + '/get_all_pelanggan'
				$.ajax({
					url: url_get_all_pelanggan,
					type: 'POST',
					dataType: 'json',
					data: {nama_pelanggan: $(this).val()},
					success: function(data){
						$('input[name="kode_pelanggan"]').val(data.kode_pelanggan)
						$('input[name="level_pelanggan"]').val(data.level)
						$('input[name="id_pelanggan"]').val(data.id)
						$('input[name="saldo_customer"]').val(data.saldo)
						// $('input[name="diskon"]').val(data.diskon)
						// document.getElementById("use_saldo").disabled = false
						document.getElementById("nama_customer_err").style.color = "#8587B0";
						if ($('input[name="harga_barang"]').val()) {
							$('input[name="sub_total"]').val(($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) * ((100-$('input[name="diskon"]').val())/100))		
						}
						if (data.saldo > 0) {
							$('input[name="deposit_customer"]').val(data.saldo)
							$('input[name="hutang_customer"]').val(0)
						}else if (data.saldo < 0){
							$('input[name="deposit_customer"]').val(0)
							$('input[name="hutang_customer"]').val(data.saldo*-1)
						}else{
							$('input[name="deposit_customer"]').val(0)
							$('input[name="hutang_customer"]').val(0)
						}
						//focus after click
						if ($('#use_barcode').is(':checked')) {
							$('input[name="kode_barang"]').focus();
						}else{
							$('input[name="nama_barang"]').focus()
						}
					}
				})
			}
			})

			$('#use_barcode').on('change', function(){
				if ($('#use_barcode').is(':checked')) {
					$('input[name="kode_barang"]').prop('readonly', false)
					$('input[name="nama_barang"]').prop('readonly', true)
					$('input[name="kode_barang"]').focus()
				}else{
					$('input[name="kode_barang"]').prop('readonly', true)
					$('input[name="nama_barang"]').prop('readonly', false)
					$('input[name="nama_barang"]').focus()
				}
			})

			$('#kode_barang').on('keyup', function(){

			if($(this).val() == '') reset()
			else {
				const url_get_all_barang = $('#content').data('url') + '/get_all_barang_by_kode'
				$.ajax({
					url: url_get_all_barang,
					type: 'POST',
					dataType: 'json',
					data: {kode_barang: $(this).val()},
					success: function(data){
						$('input[name="nama_barang"]').val(data.nama_barang)
						$('input[name="nama_brand"]').val(data.nama_brand)
						$('input[name="harga_barang"]').val(data.harga_jual)
						$('input[name="jumlah"]').val(1)
						$('input[name="diskon"]').val(0)
						$('input[name="satuan"]').val(data.satuan)
						$('input[name="max_hidden"]').val(data.stok)
						$('input[name="jumlah"]').prop('readonly', false)
						$('input[name="jumlah"]').focus()
						$('input[name="diskon"]').prop('readonly', false)
						$('button#tambah').prop('disabled', false)

						var Diskon = $('input[name="diskon"]').val()/100;
						var subTotal = $('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()

						$('input[name="sub_total"]').val(($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) * ((100-$('input[name="diskon"]').val())/100))
						
						$('input[name="jumlah"]').on('keydown keyup change blur', function(){
							$('input[name="sub_total"]').val(($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) * ((100-$('input[name="diskon"]').val())/100))
						})
						$('input[name="diskon"]').on('keydown keyup change blur', function(){
							$('input[name="sub_total"]').val(($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) * ((100-$('input[name="diskon"]').val())/100))
						})
					}
				})
			}
			})
			
			
			$('#nama_barang').on('change', function(){

				if($(this).val() == '') reset()
				else {
					const url_get_all_barang = $('#content').data('url') + '/get_all_barang'
					$.ajax({
						url: url_get_all_barang,
						type: 'POST',
						dataType: 'json',
						data: {nama_barang: $(this).val()},
						success: function(data){
							$('input[name="kode_barang"]').val(data.kode_barang)
							$('input[name="nama_brand"]').val(data.nama_brand)
							$('input[name="harga_barang"]').val(data.harga_jual)
							$('input[name="jumlah"]').val(1)
							$('input[name="diskon"]').val(0)
							$('input[name="satuan"]').val(data.satuan)
							$('input[name="max_hidden"]').val(data.stok)
							$('input[name="jumlah"]').prop('readonly', false)
							$('input[name="diskon"]').prop('readonly', false)
							$('button#tambah').prop('disabled', false)

							var Diskon = $('input[name="diskon"]').val()/100;
							var subTotal = $('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()

							$('input[name="sub_total"]').val(($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) * ((100-$('input[name="diskon"]').val())/100))
							
							$('input[name="jumlah"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val(($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) * ((100-$('input[name="diskon"]').val())/100))
							})
							$('input[name="diskon"]').on('keydown keyup change blur', function(){
								$('input[name="sub_total"]').val(($('input[name="jumlah"]').val() * $('input[name="harga_barang"]').val()) * ((100-$('input[name="diskon"]').val())/100))
							})
						}
					})
				}
			})

			
			$('#diskon_total').on('keydown keyup change blur', function(){
				var jumlah_total, saldo_customer, sisa_saldo, pembayaran, kembalian;
				pembayaran = parseInt(document.getElementById("pembayaran").value);
				saldo_customer = parseInt(document.getElementById("saldo_customer").value);
				jumlah_total = $('input[name="total_hidden"]').val() * ((100-$('input[name="diskon_total"]').val())/100);
				// sisa_saldo = saldo_customer - jumlah_total;

				kembalian = pembayaran - jumlah_total;

				$('#jumlah_total').html('<strong>Rp. ' + numberWithCommas(jumlah_total) + '</strong>');
				$('input[name="jumlah_total_hidden"]').val(jumlah_total);
				if (pembayaran) {
					$('#kembalian').html('<strong>Rp. ' +numberWithCommas(kembalian)+ '</strong>')
					$('input[name="kembalian_hidden"]').val(sisa_saldo)
					if ($('#kredit_validation').val() == 'ya') {
						sisa_saldo = (pembayaran + saldo_customer) - jumlah_total
						$('#saldo').html('<strong>Rp. ' +numberWithCommas(sisa_saldo)+ '</strong>');
						$('input[name="saldo_hidden"]').val(sisa_saldo)
					}else if ($('#kredit_validation').val() == 'tidak') {
						sisa_saldo = saldo_customer - jumlah_total
						$('#saldo').html('<strong>Rp. ' +numberWithCommas(sisa_saldo)+ '</strong>');
						$('input[name="saldo_hidden"]').val(sisa_saldo)
					}
				}else{
					$('#kembalian').html('<strong>' +0+ '</strong>')
					if ($('#kredit_validation').val() == 'ya') {
						$('#saldo').html('<strong>' +0+ '</strong>');
					}else if ($('#kredit_validation').val() == 'tidak') {
						sisa_saldo = saldo_customer - jumlah_total
						$('#saldo').html('<strong>Rp. ' +numberWithCommas(sisa_saldo)+ '</strong>');
						$('input[name="saldo_hidden"]').val(sisa_saldo)
					}
				}
			})

			$('#pembayaran').on('keydown keyup change blur', function(){
				var jumlah_total, saldo_customer, sisa_saldo, pembayaran;
				pembayaran = parseInt(document.getElementById("pembayaran").value);
				saldo_customer = parseInt(document.getElementById("saldo_customer").value);

				jumlah_total = $('input[name="total_hidden"]').val() * ((100-$('input[name="diskon_total"]').val())/100);

				kembalian = pembayaran - jumlah_total;


				$('#jumlah_total').html('<strong>Rp. ' + numberWithCommas(jumlah_total) + '</strong>');
				$('input[name="jumlah_total_hidden"]').val(jumlah_total);
				if (pembayaran) {
					$('#kembalian').html('<strong>Rp. ' +numberWithCommas(kembalian)+ '</strong>')
					$('input[name="kembalian_hidden"]').val(sisa_saldo)
					if ($('#kredit_validation').val() == 'ya') {
						sisa_saldo = (pembayaran + saldo_customer) - jumlah_total
						$('#saldo').html('<strong>Rp. ' +numberWithCommas(sisa_saldo)+ '</strong>');
						$('input[name="saldo_hidden"]').val(sisa_saldo)
					}else if ($('#kredit_validation').val() == 'tidak') {
						sisa_saldo = saldo_customer - jumlah_total
						$('#saldo').html('<strong>Rp. ' +numberWithCommas(sisa_saldo)+ '</strong>');
						$('input[name="saldo_hidden"]').val(sisa_saldo)
					}
				}else{
					$('#kembalian').html('<strong>' +0+ '</strong>')
					if ($('#kredit_validation').val() == 'ya') {
						$('#saldo').html('<strong>' +0+ '</strong>');
					}else if ($('#kredit_validation').val() == 'tidak') {
						sisa_saldo = saldo_customer - jumlah_total
						$('#saldo').html('<strong>Rp. ' +numberWithCommas(sisa_saldo)+ '</strong>');
						$('input[name="saldo_hidden"]').val(sisa_saldo)
					}
				}
			})

			$('#metode_pembayaran').on('change', function(){
				metode_pembayaran = $(this).val()
				sistem_pembayaran = $('#sistem_pembayaran').val()
				if (metode_pembayaran == "cash") {
					$('#sistem_pembayaran_row').show()
					$('#kredit_validation_row').hide()
					$('#pembayaran_row').hide()
					$('#kembalian_row').hide()
					$('#saldo_row').hide()
					$('#transfer_row').hide()
					$("#sistem_pembayaran").prop('required',true);	
					if (sistem_pembayaran == 'tunai') {
						$('#pembayaran_row').show()
						$('#kembalian_row').show()
						$('#saldo_row').hide()
						$('#kredit_validation_row').hide()
						$('#transfer_row').hide()
						$("#pembayaran").prop('required',true)
						$("#kode_bank").prop('required',false)
						$("#kode_bank").val("")
					}else if(sistem_pembayaran == "transfer"){
						$('#pembayaran_row').hide()
						$('#kembalian_row').hide()
						$('#saldo_row').hide()
						$('#kredit_validation_row').hide()
						$('#transfer_row').show()
						$("#pembayaran").prop('required',false)
						$("#kode_bank").prop('required',true)
						$("#pembayaran").val("")
						$('#kembalian').html('')
					}
				}else if(metode_pembayaran == "kredit"){
					$('#kredit_validation_row').show()
					$('#sistem_pembayaran_row').hide()
					$('#pembayaran_row').hide()
					$('#kembalian_row').hide()
					$('#saldo_row').hide()
					$('#transfer_row').hide()
					$("#kredit_validation").prop('required',true);	
					if ($('#kredit_validation').val() = 'ya') {
						$('#sistem_pembayaran_row').show()
						if (sistem_pembayaran == 'tunai') {
							$('#pembayaran_row').show()
							$('#kembalian_row').hide()
							$('#saldo_row').show()
							$('#transfer_row').hide()
						}else if (sistem_pembayaran == 'transfer') {
							$('#pembayaran_row').show()
							$('#kembalian_row').hide()
							$('#saldo_row').hide()
							$('#transfer_row').show()
						}	
					}else if ($('#kredit_validation').val() = 'tidak') {
						$('#pembayaran_row').hide()
						$('#kembalian_row').hide()
						$('#saldo_row').show()
						$('#transfer_row').hide()
					}
				}
			})

			$('#sistem_pembayaran').on('change', function(){
				metode_pembayaran = $('#metode_pembayaran').val()
				sistem_pembayaran = $(this).val()
				kredit_validation = $('#kredit_validation').val()
				if (metode_pembayaran == "cash") {
					if (sistem_pembayaran == 'tunai') {
						$('#pembayaran_row').show()
						$('#kembalian_row').show()
						$('#saldo_row').hide()
						$('#kredit_validation_row').hide()
						$('#transfer_row').hide()
						$("#pembayaran").prop('required',true);
						$("#kode_bank").prop('required',false);
						$("#kode_bank").val("");
					}else if(sistem_pembayaran == "transfer"){
						$('#pembayaran_row').hide()
						$('#kembalian_row').hide()
						$('#saldo_row').hide()
						$('#kredit_validation_row').hide()
						$('#transfer_row').show()
						$("#pembayaran").prop('required',false);
						$("#kode_bank").prop('required',true);
						$("#pembayaran").val("");
						$('#kembalian').html('')
					}
				}else if(metode_pembayaran == "kredit"){
					if (kredit_validation = 'ya') {
						$('#pembayaran_row').show()
						$('#kembalian_row').hide()
						$('#saldo_row').show()
						if (sistem_pembayaran == 'tunai') {
							$('#pembayaran_row').show()
							$('#kembalian_row').hide()
							$('#saldo_row').show()
							$('#transfer_row').hide()
						}else if (sistem_pembayaran == 'transfer') {
							$('#pembayaran_row').show()
							$('#kembalian_row').hide()
							$('#saldo_row').show()
							$('#transfer_row').show()
						}	
					}
					// else if ($('#kredit_validation_row').val() = 'tidak') {
					// 	$('#pembayaran_row').hide()
					// 	$('#kembalian_row').hide()
					// 	$('#saldo_row').show()
					// 	$('#transfer_row').hide()
					// }
				}
			})

			$('#kredit_validation').on('change', function(){
				metode_pembayaran = $('#metode_pembayaran').val()
				sistem_pembayaran = $('#sistem_pembayaran').val()
				kredit_validation = $(this).val()
				//calculate saldo
				saldo_customer = parseInt(document.getElementById("saldo_customer").value);
				pembayaran = parseInt(document.getElementById("pembayaran").value);
				jumlah_total = $('input[name="total_hidden"]').val() * ((100-$('input[name="diskon_total"]').val())/100);


				if(metode_pembayaran == "kredit"){
					if (kredit_validation == 'ya') {
						$('#sistem_pembayaran_row').show()
						if (sistem_pembayaran == 'tunai') {
							sisa_saldo = (saldo_customer + pembayaran) - jumlah_total;
							$('#pembayaran_row').show()
							$('#kembalian_row').hide()
							$('#saldo_row').show()
							$('#transfer_row').hide()
							$('#saldo').html('<strong>Rp. ' +numberWithCommas(sisa_saldo)+ '</strong>');
							$('input[name="saldo_hidden"]').val(sisa_saldo)
						}else if (sistem_pembayaran == 'transfer') {
							sisa_saldo = (saldo_customer + pembayaran) - jumlah_total;
							$('#pembayaran_row').show()
							$('#kembalian_row').hide()
							$('#saldo_row').hide()
							$('#transfer_row').show()
							$('#saldo').html('<strong>Rp. ' +numberWithCommas(sisa_saldo)+ '</strong>');
							$('input[name="saldo_hidden"]').val(sisa_saldo)
						}	
					}else if (kredit_validation == 'tidak') {
						sisa_saldo = saldo_customer - jumlah_total;
						$('#sistem_pembayaran_row').hide()
						$('#pembayaran_row').hide()
						$('#kembalian_row').hide()
						$('#saldo_row').show()
						$('#transfer_row').hide()
						$('#saldo').html('<strong>Rp. ' +numberWithCommas(sisa_saldo)+ '</strong>')
						$('input[name="saldo_hidden"]').val(sisa_saldo)
					}
				}
			})


			$(document).on('click', '#tambah', function(e){
				var nama_customer, pesan, test, saldo_customer;
				nama_customer = document.getElementById("nama_pelanggan").value;
				saldo_customer = parseInt(document.getElementById("saldo_customer").value);
				const url_keranjang_barang = $('#content').data('url') + '/keranjang_barang'
				const data_keranjang = {
					kode_barang: $('input[name="kode_barang"]').val(),
					nama_barang: $('input[name="nama_barang"]').val(),
					nama_brand: $('input[name="nama_brand"]').val(),
					harga_barang: $('input[name="harga_barang"]').val(),
					jumlah: $('input[name="jumlah"]').val(),
					diskon: $('input[name="diskon"]').val(),
					satuan: $('input[name="satuan"]').val(),
					sub_total: $('input[name="sub_total"]').val(),
				}	

				if(parseInt($('input[name="max_hidden"]').val()) < parseInt(data_keranjang.jumlah)) {
					alert('stok tidak tersedia! stok tersedia : ' + parseInt($('input[name="max_hidden"]').val()))	
				} else if (nama_customer == "") {
					pesan = 'Nama Customer Tidak Boleh Kosong';
					alert(pesan)
					document.getElementById("nama_customer_err").style.color = "#ff0000";
				}
				else {
					$.ajax({
						url: url_keranjang_barang,
						type: 'POST',
						data: data_keranjang,
						success: function(data){
							if($('datalist[name="list_barang"]').val() == data_keranjang.nama_barang) $('option[value="' + data_keranjang.nama_barang + '"]').hide()
							reset()

							$('input[name="diskon_total"]').val(0)

							$('table#keranjang tbody').append(data)
							$('tfoot').show()


							<?= number_format($barang->harga_jual, 0, ',', '.') ?>

							$('#total').html('<strong>Rp. ' +  numberWithCommas(hitung_total()) + '</strong>')
							$('input[name="total_hidden"]').val(hitung_total())
							$('#jumlah_total').html('<strong>Rp. ' + numberWithCommas(hitung_total()) + '</strong>')
							$('input[name="jumlah_total_hidden"]').val(hitung_total())
							$('#pembayaran_row').hide()
							$('#kembalian_row').hide()
							$('#sistem_pembayaran_row').hide()
							$('#kredit_validation_row').hide()
							$('#saldo_row').hide()
							$('#transfer_row').hide()
							//focus after click
							if ($('#use_barcode').is(':checked')) {
								$('input[name="kode_barang"]').focus();
							}else{
								$('input[name="nama_barang"]').focus()
							}
							// if ($('#use_saldo').is(':checked')) {
							// 	$('#sisa_saldo').html('<strong>' + sisa_saldo+ '</strong>')
							// 	$('input[name="saldo_hidden"]').val(sisa_saldo)
							// }
							// else {
							// 	$('#sisa_saldo_row').hide()
							// }
						}
					})
				}

			})


			$(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()

				$('select[value="' + $(this).data('nama-barang') + '"]').show()

				$('#total').html('<strong>' + hitung_total() + '</strong>')
				$('input[name="total_hidden"]').val(hitung_total())
				// $('#jumlah_total').html('<strong>' + hitung_total() + '</strong>')
				// $('input[name="jumlah_total_hidden"]').val(hitung_total())
				var jumlah_total;
				
				jumlah_total = $('input[name="total_hidden"]').val() * ((100-$('input[name="diskon_total"]').val())/100);
				$('#jumlah_total').html('<strong>Rp. ' + jumlah_total + '</strong>');
				$('input[name="jumlah_total_hidden"]').val(jumlah_total);

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

			$('button[type="submit"]').on('click', function(){
				$('input[name="kode_barang"]').prop('disabled', true)
				$('select[name="nama_barang"]').prop('disabled', true)
				$('input[name="harga_barang"]').prop('disabled', true)
				$('input[name="jumlah"]').prop('disabled', true)
				$('input[name="diskon"]').prop('disabled', true)
				$('input[name="sub_total"]').prop('disabled', true)
			})

			function hitung_total(){
				let total = 0;
				$('.sub_total').each(function(){
					total += parseInt($(this).text())
				})

				return total;
			}
			/* Fungsi formatRupiah */
			function numberWithCommas(x) {
    			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
			}

			function reset(){
				$('#nama_barang').val('')
				$('input[name="kode_barang"]').val('')
				$('input[name="kode_brand"]').val('')
				$('input[name="harga_barang"]').val('')
				$('input[name="jumlah"]').val('')
				$('input[name="nama_kategori"]').val('')
				// $('input[name="diskon"]').val('')
				$('input[name="sub_total"]').val('')
				$('input[name="jumlah"]').prop('readonly', true)
				// $('input[name="diskon"]').prop('readonly', true)
				$('button#tambah').prop('disabled', true)
			}
		})
	</script>
</body>
</html>