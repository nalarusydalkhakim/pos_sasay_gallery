<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
    <style>
    #myDIV {
    width: 100%;
    padding: 50px 0;
    text-align: center;
    background-color: lightblue;
    margin-top: 20px;
    }
</style>
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
                            <h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
                        </div>
                    </div>
                    <hr>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert" >
                        <Strong>Cara Menambahkan Brand</Strong>
                        <button type="button" class="close" id="bt1" onclick="myFunction()">
                            <span aria-hidden="true">&plus;</span>
                        </button>
					</div>
                    <div id="tutorial">
                        <p>ksjasjasjaksjaksjaksj ajkadjakjdakdjj jdjakdjakdj</p>
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
    <script>
        $(document).ready(function(){
			$('#tutorial').hide()
            var test = 1 ;
            $(document).on('click', '#bt1', function () {
                if (test == 1) {
                    $('#tutorial').show()
                    $('#bt1').html('-')
                    test = 0;
                }else if(test == 0){
                    $('#tutorial').hide()
                    $('#bt1').html('+')
                    test = 1;
                }
            })
        })
    </script>  
</body>
</html>