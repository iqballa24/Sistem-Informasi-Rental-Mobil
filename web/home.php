<?php
if(!defined('OFFDIRECT')) include 'error404.php';
include 'koneksi.php';

$Qry  = $koneksidb->query("SELECT count(*) AS total from dt_pemesanan");
$Qry1 = $koneksidb->query("SELECT count(*) AS total from customer");
$Qry2 = $koneksidb->query("SELECT count(*) AS total from mobil"); 
$Qry3 = $koneksidb->query("SELECT sum(a.durasi * b.harga) AS total from dt_pemesanan a
							LEFT JOIN harga b ON a.id_mobil = b.id_mobil "); 

$hasil  = mysqli_fetch_array($Qry);
$hasil1 = mysqli_fetch_array($Qry1);
$hasil2 = mysqli_fetch_array($Qry2);
$hasil3 = mysqli_fetch_array($Qry3);
?>
<body class="no-skin">
<?php
	include "base_template_topnav.php";	 //akan memanggil file base_template_topnav.php sebagai header
	echo '<div class="main-container ace-save-state" id="main-container">';
	include "menu.php";	 //akan memanggil file menu.php sebagai pembuatan menu
	
?>
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

					</div>

					<div class="page-content">
						
						<div class="page-header">
							<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview &amp; stats
								</small>
							
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
							
								
									<div class="alert alert-block alert-info">
										<button type="button" class="close" data-dismiss="alert">
											<i class="ace-icon fa fa-times"></i>
										</button>

										<i class="ace-icon fa fa-check green"></i>

										Selamat datang
										<strong class="green">
											<b>Admin</b>
										</strong>,<br><br>
										Berusaha, berdoa, dan santuy
									</div>
									
								
									<div class="widget-header widget-header-flat widget-header-small">
										<h5 class="widget-title">
											<i class="ace-icon fa fa-signal"></i>
											Kelola Halaman Web
										</h5>
										
									</div>
									<br>
								<div class="row">
									<div class="space-6"></div>

									<div class="col-sm-12 infobox-container">
										
										<div class="infobox infobox-purple">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-user"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo ($hasil1['total']); ?></span>
												<div class="infobox-content">Total Customer</div>
											</div>
												
										</div>
										
										
										<div class="infobox infobox-red">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-car"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo ($hasil2['total']); ?></span>
												<div class="infobox-content">Total Mobil</div>
											</div>

											
										</div>

										
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-money"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo "Rp.".number_format($hasil3['total']); ?></span>
												<div class="infobox-content">Total Pendapatan</div>
											</div>
										</div>
										<div class="infobox infobox-black">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-line-chart "></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo ($hasil['total']); ?></span>
												<div class="infobox-content">Total transaksi</div>
											</div>
										</div>
		
									</div>


								</div><!-- /.row -->

								<div class="space-18"></div>

								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

<?php
	include "base_template_footer.php";	//akan memanggil base_template_footer.php sebagai footer
?>
      </div>
    </div>
 

</body>    

