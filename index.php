
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login Page - Ace Admin</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
		 <link href="css1/style.css" rel="stylesheet">
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan']=="gagal"){
            echo "
            <script type='text/javascript'>
            alert ('Password yang anda masukan salah!');</script>;";
        }
    }
    ?>
	<body class="login-layout ">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-car white"></i>
									<span class="green">Rentcar</span>
									<span class="white" id="id-text2">Application</span>
								</h1>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												Sign In
											</h4>

											<div class="space-6"></div>

											<form action="web/cek_login.php" method="post">
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" name="username" class="form-control" placeholder="Username" required />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="password" class="form-control" placeholder="Password" required />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">

														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">Login</span>
														</button>
													</div>


													<div class="space-4"></div>
												
											</form>

											<ul class="bg-bubbles">
                								<li></li>
                								<li></li>
                								<li></li>
                								<li></li>
                								<li></li>
                								<li></li>
                								<li></li>
                								<li></li>
                								<li></li>
                								<li></li>
            							</ul>
										</div><!-- /.widget-main -->

										
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->
								<?php
									include "web/base_template_footer.php"; //akan memanggil base_template_footer.php sebagai footer
								?>
								
							</div><!-- /.position-relative -->

							
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});
			
			
			
			//you don't need this, just used for changing background
			// jQuery(function($) {
			//  $('#btn-login-dark').on('click', function(e) {
			// 	$('body').attr('class', 'login-layout');
			// 	$('#id-text2').attr('class', 'white');
			// 	$('#id-company-text').attr('class', 'blue');
				
			// 	e.preventDefault();
			//  });
			//  $('#btn-login-light').on('click', function(e) {
			// 	$('body').attr('class', 'login-layout light-login');
			// 	$('#id-text2').attr('class', 'grey');
			// 	$('#id-company-text').attr('class', 'blue');
				
			// 	e.preventDefault();
			//  });
			//  $('#btn-login-blur').on('click', function(e) {
			// 	$('body').attr('class', 'login-layout blur-login');
			// 	$('#id-text2').attr('class', 'white');
			// 	$('#id-company-text').attr('class', 'light-blue');
				
			// 	e.preventDefault();
			//  });
			 
			// });
		</script>
	</body>
</html>
