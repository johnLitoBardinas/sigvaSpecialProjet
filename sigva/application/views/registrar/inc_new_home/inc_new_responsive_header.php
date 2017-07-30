<!-- start: Header -->
<div class="navbar">
	<div class="navbar-inner cust_navbar">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="<?php echo site_url('registrar/home') ?>"><span>SIGVA <code>registrar</code></span></a>
							
			<!-- start: Header Menu -->
			<div class="nav-no-collapse header-nav">
				<ul class="nav pull-right">
					
					<!-- start: User Dropdown -->
					<li class="dropdown">
						<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
							<i class="halflings-icon white user"></i> Registrar STI Naga
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="dropdown-menu-title" disabled>
									<span>Account Settings</span>

							</li>

							<li data-src="registrar/iframe_main_reg" >
								<a id="profile" href="#">
									<i class="halflings-icon user"></i> Profile
								</a>
							</li>

							<li> <a id="logout" href="#" onclick="logOutReg()"><i class="halflings-icon off"></i> Logout</a></li>
						</ul>
					</li>
					<!-- end: User Dropdown -->
				</ul>
			</div>
			<!-- end: Header Menu -->
			
		</div>
	</div>
</div>