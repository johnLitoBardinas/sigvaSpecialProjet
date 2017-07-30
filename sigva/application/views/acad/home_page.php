<!--header-->
<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);

?>
	<script type="text/javascript">
		
		/* pag nag load na di body dapat mauda na o ma hide na so loading*/
		$(document).ready(function(){

			/*setTimeout(show_loading, 1600);
			function show_loading(){

				$("#modal").hide();
				$("#acad_home").show();
				$("#acad_func").show();
			}			
			$("#modal").show();
			$("#acad_home").hide();
			$("#acad_func").hide();*/

			document.body.style.backgroundColor = "#f2f3ea";
		});

	</script>
	<!-- <div id="modal" style='width: 100px;height: 100px;margin-right: auto;margin-left: auto;margin-top: 13%; border-radius: 5px; top:auto;
	left: auto; background: rgba( 150, 184, 178, .4 )url(<?php //echo base_url("assets/custom/loading8.gif")?>) 50% 50% no-repeat;'>
		
		<span class="loading"> </span>
		<p> &nbsp Please wait.. </p>
	</div> -->

	<header class="container-fluid" id="acad_home" >
		
		<ul class="nav nav-tabs">
			<li> 
				<span class="glyphicon glyphicon-user"> </span>
				<a href="#changeAccount" data-toggle="tab"> My Account </a>
			</li>

			<li> <span class="glyphicon glyphicon-pencil"></span><a href="#subjects" data-toggle="tab"> School Subjects </a></li>

			<li> <span class="glyphicon glyphicon-pencil"></span><a href="#teachers" data-toggle="tab"> School Teachers </a></li>

			<li><span class="glyphicon glyphicon-pencil"></span><a href="#section" data-toggle="tab"> School Sections </a></li>

			<li><span class="glyphicon glyphicon-pencil"></span><a href="#teach_sub" data-toggle="tab"> Teacher Subjects </a></li>

			<li><span class="glyphicon glyphicon-pencil"></span><a href="#sub_sched" data-toggle="tab"> Subject Schedules </a></li>


			<li style="cursor: pointer; display: block;" title="Logout" dir="rtl"> <span class="glyphicon glyphicon-log-out" onclick='location.href="<?php echo base_url();?>academic"'></span> </li>

		</ul>

	</header>


	<div class="tab-content" id="acad_func">
		
		<div class="tab-pane fade active in" id="changeAccount">

			<iframe src="<?php echo site_url('academic/iframe_changeAcc') ?>"  width="100%" scrolling="no" frameborder="0" onload="javascript:resizeIframe(this)"></iframe>
		</div>

		<div class="tab-pane" id="subjects">

			<iframe src="<?php echo site_url('academic/iframe_subject_section') ?>" width="100%" scrolling="auto" frameborder="0" onload="javascript:resizeIframe(this)"></iframe>
		</div>

		<div class="tab-pane" id="teachers">
<!-- 			
<h1>f_teacher</h1> -->
			<?php //include('functions_acad/teacher_section.php') ?>
			<iframe src="<?php echo site_url('academic/iframe_teacher_section') ?>" width="100%" scrolling="auto" frameborder="0" onload="javascript:resizeIframe(this)"></iframe>

		</div>

		<div class="tab-pane" id="section">
			
			<!-- <h1>for the sections</h1> -->
			<iframe src="<?php echo site_url('academic/iframe_section_section') ?>" width="100%" scrolling="auto" frameborder="0" onload="javascript:resizeIframe(this)"></iframe>

		</div>

		
		<!--
			teacher_subject_e rereload; dapat iya pag nag change so data sa database
		-->
		<div class="tab-pane" id="teach_sub">
			
			<!-- <h1>for the teacher_subjects</h1> -->
			<iframe src="<?php echo base_url('academic/iframe_teacher_subject') ?>" width="100%" scrolling="auto" frameborder="0" onload="javascript:resizeIframe(this)" id="frame_teach_sub"></iframe>
		</div>

		<div class="tab-pane" id="sub_sched">
			
			<!-- <h1> for the subject sched</h1> -->
			<iframe src="<?php echo site_url('academic/iframe_subject_schedule') ?>" width="100%" scrolling="auto" frameborder="0" onload="javascript:resizeIframe(this)"></iframe>
		</div>


	</div><!--end of the tab pane-->

<!--footer-->
<?php 
$foot = $path."/sigva/application/views/inc/foot.php";
include($foot);
 ?>