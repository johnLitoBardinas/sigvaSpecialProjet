<div class="page-wrapper">

     <div class="row">
     	<div class="col-lg-12 col-md-12 col-sm-12">
     		
     		<div class="panel panel-default" style="margin:0 auto; width: 95%;">
              <div class="panel-heading">
                <h3 class="panel-title"> <span class="glyphicon glyphicon-list-alt"></span> &nbsp My Schedule </h3>
              </div>
              <div class="panel-body">

				<div class="container-fluid">
			        <button class="btn btn-primary btn-sm" onclick="reload_table_t_sched()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
			        <br />
			        <br />
			        <!--
			            id na table amo yan kukuunon ta ko data galin sadto ehh javascript
			        -->
			        <table id="table_t_sched" class="table table-striped table-bordered" cellspacing="0" width="100%">
			            <thead>
			                <tr>
			                    <th> Section Name </th>
			                    <th> Subject Code </th>
			                    <th> Room No. </th>
			                    <th> Date/ Time</th>
			                    <th style="width:125px;"> Actions </th>
			                </tr>
			            </thead>
			            <tbody>
			            <!--filled with mighty ajax-->
			            </tbody>

			    	</table>
				</div><!-- end of the container fluid -->

              </div><!--panel_body-->
            </div><!--panel_info-->

     	</div>
     </div><!--row-->
</div>

<script type="text/javascript">
	
	var table_t_sched;

	$(document).ready(function(){

		table_t_sched = $("#table_t_sched").DataTable({

			/*key:value pairs_ JSON formated*/
			"bInfo" : false,
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('teacher/ajx_teacher_sched') ?>",
				"type":"POST"
			},//ajax propeties with object JSON data


			"columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
	        ]//datatables colomDefinition

		});


		$('tbody').find('td').attr('valign', 'center');

	});


	function reload_table_t_sched(){

		table_t_sched.ajax.reload(null,false);
	}


	/* created 9/8/2016width=800,height=600,left=350px,top=15px */
	function view_students(sched_id){

		var myWindow = window.open("<?php echo site_url('teacher/shw_stud_inSched') ?>/"+sched_id+"", "Where is these title?", "toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1300,height=600,top15'");
	}


</script>