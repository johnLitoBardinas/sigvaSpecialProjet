<?php 

	foreach ($sched_dat as $row) {
		
		$s_code = $row->sub_code;
		$sec_name = $row->sec_name;
		$num_stud = $row->num_stud;

	}
	$this->session->set_tempdata('sub_code', $s_code, 1800);
	$this->session->set_tempdata('sec_name', $sec_name, 1800);

	include(APPPATH.'views/teach/teach_inc/teach_head_prt.php');
 ?>
<body>

	<div class="container-fluid" style="margin-top: -50px;">

		<div class="row">
			
			<div class="col-lg-5 col-md-5 col-sm-5">
				
				<label> 
						<span class="label label-default"> Subject Code: </span>
				</label>
				<span class="span_sched_det"> <?= $s_code; ?> </span><br>

				<label> 
						<span class="label label-default"> Section: </span>	
				</label>
				<span class="span_sched_det"><?= $sec_name ?></span><br>
              	
              	<label>
              		<span class="label label-default">Number of Students: </span>
              	</label>
				<span class="span_sched_det"> <?= $num_stud ?></span><br>

			</div>

		</div>

		<div class="row">
			
			<div class="col-lg-12 col-md-12 col-sm-12">
				
				<?php include('teach_auto_compute/auto_compute_tbl.php') ?>
			</div>
		</div>
	
	</div>

	<!--datatables-->
	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>

	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>
	<!--custom_script for the page -->

	<!--toasing-->
	<script type="text/javascript" src="<?php echo base_url('assets/alert_Tost/src/main/javascript/jquery.toastmessage.js'); ?>"></script>

</body>
</html>



