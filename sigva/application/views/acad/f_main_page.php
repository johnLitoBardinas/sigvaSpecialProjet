<?php include(APPPATH.'views/inc/head.php') ?>

<body class="container-fluid">
	
	<script type="text/javascript">
		
		/* pag nag load na di body dapat mauda na o ma hide na so loading*/
		$(document).ready(function(){

			setTimeout(show_loading, 1600);
			function show_loading(){

				$("#modal").hide();
				$("#home_prt").show();
				
			}			
			$("#modal").show();
			$("#home_prt").hide();

			document.body.style.backgroundColor = "#f2f3ea";
		});

	</script>

	<!-- custom model -->
	<div id="modal" style='width: 100px;height: 100px;margin-right: auto;margin-left: auto;margin-top: 13%; border-radius: 5px; top:auto;
	left: auto; background: rgba( 150, 184, 178, .4 )url(<?php echo base_url("assets/custom/loading8.gif")?>) 50% 50% no-repeat;'>
		
		<span class="loading"> </span>
	</div>

	
	<!-- the jumbotrom will be here saying hi welcome to sigva -->
	<!-- the bootstrap jumbotrom example -->
	
	<div id="home_prt">
		<div class="jumbotron" id="grad">

		  <h1 style="font-family: 'Chalk Line Outline', helvetica"> Welcome to the SIGVA <code style="background-color: transparent;">registrar</code> </h1> 

		</div>

	</div>

<?php include(APPPATH.'views/inc/foot.php') ?>