<!--header-->
<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);

    $this->session->unset_userdata('acad_id');
?>

<!--recal about the bootstrap-->
<body class="container-fluid">
	<script type="text/javascript">
		
		/* pag nag load na di body dapat mauda na o ma hide na so loading*/
		$(document).ready(function(){

			setTimeout(show_loading, 1600);
			function show_loading(){

				$("#modal").hide();
				$("#acad_login").show();
				
			}			
			$("#modal").show();
			$("#acad_login").hide();

			document.body.style.backgroundColor = "#f2f3ea";
		});

	</script>
	<div id="modal" style='width: 100px;height: 100px;margin-right: auto;margin-left: auto;margin-top: 13%; border-radius: 5px; top:auto;
	left: auto; background: rgba( 150, 184, 178, .4 )url(<?php echo base_url("assets/custom/loading8.gif")?>) 50% 50% no-repeat;'>
		
		<span class="loading"> </span>
		<p> &nbsp Please wait.. </p>
	</div>

	<div class="container" id="acad_login">
		
		<div class="content row" style="margin-top: 12%">
				
				<section class="main col-lg-4 col-md-6 col-sm-4">
					<div class="form-group">

					<h1 style='font-size: 27px;'> SIGVA <span> -academic- </span></h1>
						
						<div class="error"></div>
						<?php 
							echo form_open('', array('class' => 'toAjax'));
						?>
						
						
						<input placeholder="Username" class="form-control input-lg" type="text" name="acad_user" required="true" id="acad_user" style="margin-bottom: 2%">

						 
						<input placeholder="Password" class="form-control input-lg" type="password" name="acad_pass" required="true" id="acad_pass" style="margin-bottom: 2%">

						<input class="btn btn-primary btn-lg" type="submit" value="Login" style="margin-left: 78%">
						<?php echo form_close(); ?>	
							
						 	
					</div>

				</section><!--login_e-->

				<section class=" sidebar col-lg-8 col-md-6 col-sm-8" style="line-spacing: 6%">
					
					<!--pre-->
					<p style="text-align: left"> The academic is used for assigning, updating, deleting the list by the following data
					</p>

					<ol style="text-align: left; ">
						<li> 1. Subject Schedules </li>
						<li> 2. Teacher's Subjects</li>
						<li> 3. Teachers </li>
						<li> 4. Subject's </li>
						<li> 5. Section's </li>
					</ol>
				</section>
				
		</div>

	</div><!--/.container-->


	<script>
		
		$(document).ready(function (){

			$('form.toAjax').on('submit', function(form){

				form.preventDefault();
				$.post('<?php echo site_url();?>'+'academic/validate_acad', $('form.toAjax').serialize(), function(data){

					if(data === "1"){

						location.href="<?php echo site_url('academic/home') ?>";
					}else{
					/*console.log(data);*/
					$('div.error').addClass('alert alert-warning fade in').attr('aria-label','close');
					$('div.error').html(data);
					}
				});
			});
		});
	</script>


<!--footer-->
<?php 
$foot = $path."/sigva/application/views/inc/foot.php";
include($foot);
 ?>
