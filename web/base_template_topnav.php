<div id="navbar" class="navbar navbar-default          ace-save-state">
	<div class="navbar-container ace-save-state" id="navbar-container">
		<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
			<span class="sr-only">Toggle sidebar</span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>

			<span class="icon-bar"></span>
		</button>

		<div class="navbar-header pull-left">
			<a href="<?php echo $baseURL ; ?>" class="navbar-brand"> 
				<big>
				<i class="fa fa-car"></i>
				</big>
				<small>
				RentCar
				</small>
			</a>
		</div>

		<div class="navbar-buttons navbar-header pull-right" role="navigation" >
			<ul class="nav ace-nav" >
				<li class="transparent dropdown-modal">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						
							<img class="nav-user-photo" width="40" height="40" src="<?php echo $baseURL; ?>images/p.jpg" alt="" />
						<span class="user-info" >
							<small>Selamat datang,</small> Admin
						</span>

						<i class="ace-icon fa fa-caret-down"></i>
					</a>

					<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="<?php echo $baseURL; ?>m_profil/password" onclick="return rubah_password();"><i class="ace-icon fa fa-user"></i>Ubah Password</a>
						</li>
						<li class="divider"></li>
						<li><a href="<?php echo $baseURL; ?>logout" onclick="return confirm('Yakin keluar..?');"><i class="ace-icon fa fa-power-off"></i>Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div><!-- /.navbar-container -->
</div>

</script>
