<?php 

$reg_id = $this->session->userdata('reg_id');
if(empty($reg_id)){

	redirect(site_url('registrar'));
} 

?>
<!DOCTYPE html>
<html lang="en">

	<?php include('inc_new_home/inc_new_head.php') ?>

<body>
	
	<?php include('inc_new_home/inc_new_responsive_header.php') ?>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
			
			<!--these can be included at the inc/sidebar-->
			<!-- start: Main Menu -->
			<?php include('inc_new_home/inc_home_side.php') ?>
			<!-- end: Main Menu -->
		

			<!--can be in the inc/noscript-->
			<!--
			in case of the browser does not support javascript for the browser
			-->
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<!-- start: Content class="span10">-->
			<!-- Adding student -->
			<div id="content" class="reg_process">

					<iframe id="dynaIframe" src="http://localhost/sigva/academic" width="93%"></iframe>
			</div><!--/fluid-row-->

	

		<!--the javascript is on the footer now -->
		<!-- start: JavaScript-->

		<?php include('inc_home_reg/script_home_reg.php') ?>
	
<!-- custom script for the page -->
<script type="text/javascript">
			
	$(document).ready(function(){

		//$("#register a:contains('REGISTER')").parent().addClass('active');

		$('ul.main-menu').on('click', 'li > a', function(){

			//alert('event for the add_stud');
			//$('div#content').toggle();

			$(this).closest('ul').find('li').removeClass('active');
			$(this).parent().toggleClass('active');
			//var title = $(this).find('span').text();
			//alert(title);

			if ($(this).find('span').data('src')) {
				var src = $(this).find('span').data('src');
				/* swap the current iframe display*/
				changeIframe(src);

			}
			else{

				console.log('no path');
			}
		});


		$('ul.dropdown-menu').on('click', 'li > a#profile', function(){
			//alert('sample account info here!');

			var src = $(this).closest('li').data('src');

			/* swap the current iframe display*/
			changeIframe(src);
		});

		function changeIframe(src){

			var path = "<?php echo site_url() ?>" + src;
			$('iframe#dynaIframe').attr({'src': path});
			//alert(path);

			console.log(path);
		}
	});

		/* function to logOut the registrar */
		function logOutReg(){

			location.href="<?php echo site_url('registrar') ?>";
		}
</script>
	<!--end nalang ng footer dito -->
</body>
</html>
