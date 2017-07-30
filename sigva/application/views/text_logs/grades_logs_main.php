<!DOCTYPE html>
<html lang="en">

	<?php
 	$path = $this->config->item('server_root');
	$head = $path."/sigva/application/views/send_grades/inc_main_page/main_page_head.php";
    include($head);
    ?>
    <!--dtable-->
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
<body>

	<div class="container" style="margin-top:2%">
		
		<div class="panel panel-primary">

	      <div class="panel-heading" style="    background-color: #195d4d;"> 
	      	
			<p>
			<span class="glyphicon glyphicon-list"></span> &nbsp Realease Grade Logs</p>
	      </div> <!--panel_heading-->

	      <div class="panel-body">
	      	
	      	<!--
				'sended_dateTime', 'subject_name', 'sem', 'school_year'
	      	-->
			<table id="table_grades_text_logs" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	            <thead>
	                <tr>
	                    <th> Date/ Time </th>
	                    <th> Subject </th>
	                    <th> Sem </th>
	                    <th> School Year </th>
	                </tr>
	            </thead>
	            <tbody>
	            <!--filled with mighty ajax-->
	            </tbody>

	    	</table>

	      </div>

	    </div><!-- panel_body -->

	</div><!--container-->

	<?php 

	$foot = $path."/sigva/application/views/send_grades/inc_main_page/main_page_footer.php";
    include($foot);
 ?>
 	<!--datatables-->
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>

<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>

	<!-- custom js for the page -->
	<script type="text/javascript">
		
		var table;

	$(document).ready(function(){

		table = $("#table_grades_text_logs").DataTable({

			/*key:value pairs_ JSON formated*/
			"bInfo" : false,
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('grades_text_logs/ajax_list_send_grades_logs') ?>",
				"type":"POST"
			},//ajax propeties with object JSON data


			"columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
	        ]//datatables colomDefinition

		});

	});
	</script>
</body>
</html>