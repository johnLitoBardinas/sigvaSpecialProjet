<!--header-->
<?php 
    //$path = $this->config->item('server_root');
    $head = APPPATH."views/inc/head.php";
    include($head);
?>

<!--recal about the bootstrap-->
<body class="container-fluid">

	<?php include(APPPATH.'views/inc/uni_btn.php') ?>

	<!--loader of the home page-->
	<?php include('inc_reg_login/reg_loader.php') ?>

	<!--actual model_loader-->
	<?php include('inc_reg_login/reg_modal_loader.php') ?>

	<div class="container" id="registrar_login" style="margin-top: -62px;">
		
		<!--this will be the content row-->
		<?php include('inc_reg_login/reg_login_content_home.php') ?>

	</div><!--/.container-->


	<!--script for the login_reg-->
	<?php include('inc_reg_login/script_reg_login.php') ?>


<!--footer-->
<?php 
$foot = APPPATH."views/inc/foot.php";
include($foot);
 ?>
