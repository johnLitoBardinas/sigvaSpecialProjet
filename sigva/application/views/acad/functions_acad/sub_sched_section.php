<!--header-->
<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);
?>

<div class="container-fluid" style="margin-top: 3%">
	
		<div class="page-header">
        <h3>Subject Schedule List</h3>
        </div>
        <br/>
        <button class="btn btn-success" onclick="javascript:add_subject_schedule()"><i class="glyphicon glyphicon-plus"></i> Add Subject Schedule </button>
        <button class="btn btn-default" onclick="javascript:reload_table_subject_schedule()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />

		<div class="row">
			
			<div class="col-lg-6 col-md-6">
				
				<div class="panel panel-info">
	      		<div class="panel-heading"> <h3 class="modal-title">Adding Schedule Form</h3> </div>
	      		<div class="panel-body form">
	      	
	      		<form name="adding_sub_sched" id="adding_sub_sched" method="post" class="form-horizontal">
		        	
					<div class="form-group">
						<label class="control-label col-md-3" dir="ltr"> Subjects/ Teacher: </label>
                    	<div class="col-md-9">
                        <select id= "teacher_subject_id" name="teacher_subject_id"></select>
                        <span class="help-block"></span> <!--to larger the block element-->
                    </div>
					</div><!--form_group-->
		        	

					<div class="form-group">
						<label class="control-label col-md-3" dir="ltr"> Section: </label>
                    	<div class="col-md-9">
                        <select name="section_id" id="section_id" style="margin-left: -184px;"></select>
                        <span class="help-block"></span> <!--to larger the block element-->
                    </div>
					</div><!--form_group-->

			        <!--so iba sadi nalang-->
					
					<div class="form-group">
						<label class="control-label col-md-3" dir="ltr"> Room No: </label>
                    	<div class="col-md-9">
                        <input type="text" name="room" id="room" placeholder="room" style="margin-left: -104px;">
                        <span class="help-block"></span> <!--to larger the block element-->
                    </div>
					</div><!--form_group-->
			        

				<fieldset style="border:thin solid white ">
					 
					<legend> Date and Time</legend>
					<?php 

						$in_outTime = array(

							'7:30' => '7:30',
							'8:00' => '8:00',
							'8:30' => '8:30',
							'9:00' => '9:00',
							'9:30' => '9:30',
							'10:00' => '10:00',
							'10:30' => '10:30',
							'11:00' => '11:00',
							'11:30' => '11:30',
							'1:00' => '1:00',
							'1:30' => '1:30',
							'2:00' => '2:00',
							'2:30' => '2:30',
							'3:00' => '3:00',
							'3:30' => '3:30',
							'4:00' => '4:00',
							'4:30' => '4:30',
							'5:00' => '5:00',
							'5:30' => '5:30',
							'6:00' => '6:00',
							'6:30' => '6:30',
							'7:00' => '7:00',
							'7:30' => '7:30',
							'8:00' => '8:00',
							'8:30' => '8:30',
							'9:00' => '9:00',
							);

			        	$days = array(

						'mon' => 'MONDAY',
						'tue' => 'TUESDAY',
						'wed' => 'WENESDAY',
						'thurs' => 'THURSDAY',
						'fri' => 'FRIDAY',
						'sat' => 'SATURDAY'
						);

					$am_pm = array(

							'AM' => 'AM',
							'PM' => 'PM'
						);

					
					echo form_dropdown(array('id' => 'in_time'), $in_outTime);
					echo form_dropdown(array('id' => 'ampm1'), $am_pm);

					echo "<span class='glyphicon glyphicon-chevron-right'> </span>";

					echo form_dropdown(array('id' => 'out_time'), $in_outTime);
					echo form_dropdown(array('id' => 'ampm2'), $am_pm);

					echo br();
					$lb2_Attr = array(

							'style' => 'margin-top:2%;margin-left: -348px;font-size: 17px;color: #1a5180;'
						);
					echo form_label('DAYS:','',$lb2_Attr);
					echo br();

					$m_select_Attr = array(

							'style' => 'width:60%; font-size:17px; height:138px;',
							'multiple' => 'multiple',
							'id' => 'm_select_day'
						);

					echo form_multiselect('', $days, '', $m_select_Attr);
				         ?>
				</fieldset>
			        

			         <input type="hidden" id="date_time" name="date_time" value=""></input>

	        	</form>
	      </div><!--panel_body-->
	    </div><!--panel-info-->
			</div>
		</div>
		 
        

        <hr>
        <!--
            id na table amo yan kukuunon ta ko data galin sadto ehh javascript
        -->
        <table id="table_sub_sched" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th> Subject Code </th>
                    <th> Teacher Name </th>
                    <th> Section Name </th>
                    <th> Room </th>
                    <th style="width: 25%"> Date &amp Time </th>
                    <th style="width:125px;"> Actions </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
    </table>

</div><!--container_fluid-->



<!--footer--> <!--to load the assets first-->
<?php 
$foot = $path."/sigva/application/views/inc/foot.php";
include($foot);
 ?>

 <?php include('acad_function_modals/subject_sched_modal.php') ?>



 <!-- java script for the page -->
 <script type="text/javascript">
 	
 	var table_sub_sched;

 	$(document).ready(function(){

 		table_sub_sched = $("#table_sub_sched").DataTable({

 			/*key:value pairs_ JSON formated*/
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('academic/ajax_list_sub_sched') ?>",
				"type":"POST"
			},//ajax propeties with object JSON data


			"columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
	        ]

 		});// endDataTableObject
            
            

        /*setInterval(function(){*/

        	ajax_list_teach_sub();
        /*}, 5666);
        setInterval(function(){*/

        	ajax_list_sec();
        /*}, 5666);*/
            
            
 		

 	});


 	/* getting the teacher subject*/
 	function ajax_list_teach_sub(){

 		var inHtml;

 		var url = "<?php echo site_url('academic/out_list_teach_sub') ?>";

 		var callback = function(response){

 			var f_res = $.parseJSON(response);

 			/*console.log(f_res);*/

 			inHtml = "<select name='teacher_subject_id' id='teacher_subject_id'>";
 			$.each(f_res, function(i, value){

 				/*console.log(value.subject_id, value.subject_code);*/

 				inHtml += '<option '+'value= "'+ value.teacher_subject_id  + '" > ' + value.TeacherSubject +' </option>';

 			});
 			inHtml += "</select>";

 			$("#teacher_subject_id").html(inHtml);
 		};


 		$.get(url, callback);
 	}


 	/* reloading the table */
 	function reload_table_subject_schedule(){

 		table_sub_sched.ajax.reload(null,false);
 	}

 	/* getting the section list */
 	function ajax_list_sec(){

 		var inHtml;

 		var url = "<?php echo site_url('academic/out_list_sec') ?>";

 		var callback = function(response){

 			var f_res = $.parseJSON(response);

 			/*console.log(f_res);*/

 			inHtml = "<select name='section_id' id='section_id'>";
 			$.each(f_res, function(i, value){

 				inHtml += '<option '+'value= "'+ value.section_id  + '" > ' + value.section_name +' </option>';

 			});
 			inHtml += "</select>";

 			$("#section_id").html(inHtml);
 		};


 		$.get(url, callback);
 	}



 	/* ajax_add_subject_schedule */
 	function add_subject_schedule(){

 		formatDateTime();
 		var url = "<?php echo site_url('academic/ajax_add_sub_sched') ?>";

 		var data = $("#adding_sub_sched").serialize();

 		console.log(data);

 		console.log('ehem');
 		$.post(url, data, function(response){

 			var res_f = $.parseJSON(response);

 			if (res_f.status === true) {

 				/* tost message here */
 				//alert('Data been inserted!');
 				 $(this).toastmessage('showNoticeToast', 'Schedule Inserted');
 			}
 			else{
 				alert('Data not submitted!');
 			}

 			reload_table_subject_schedule();
 		});
 	}


 	/* deleting data in the row*/
 	function delete_subject_schedule(subject_schedule_id){

 		if (confirm("Are you sure to delete Schedule? \n Some data might be lost?")) {

            $.ajax({

                url:"<?php echo site_url('academic/ajax_delete_sub_sched') ?>/" + subject_schedule_id,
                type:"POST",
                dataType:"JSON",

                success:function(){

                    //alert('Data has beed deleted!');
                    $(this).toastmessage('showSuccessToast', 'Schedule Deleted');
                    reload_table_subject_schedule();
                },
                error:function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }

            });

        }
 	}


 	/* editing the subject schedule */

		/* 

			_subject_schedule = extension

		*/

		/*
			_sub_sched = extension
			acd_sub_sched = model
	*/

 	function edit_sub_sched(subject_schedule_id){

		save_method = 'update';
		$('#form_sub_sched')[0].reset(); // reset form on modals
	    /*$('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string
*/		
		$("#modal_form_sub_sched").modal('show');
	    //JQUERY mismong library
	    $.ajax({

	    	url:"<?php echo site_url('academic/ajax_edit_sub_sched') ?>/"+subject_schedule_id,
	    	type:"GET",
	    	dataType: "JSON",

	    	success:function(data){

	    		$('[name="v_subject_schedule_id"]').val(data. subject_schedule_id);
	    		$('[name="v_teacher_subject_id"]').val(data.teacher_subject_id);
	    		$('[name="v_section_id"]').val(data.section_id);
	    		$('[name="v_room"]').val(data.room);
	    		$('[name="v_date_time"]').val(data.date_time);

	 			$('#modal_form_sec').modal('show');// show the bootstrap model when completed
	 			$('.modal-title').text('Edit Subject Schedule');
	    	},//properties obj laman

	    	error:function (jqXHR, textStatus, errorThrown){

	    		alert("Error from Section Ajax");
	    	}
	    });//e_ajax()
	}

	/* saving data whether it its a add or an update */
	function save_sub_sched(){

		$("#btnSave").text('Saving...');
		$("#btnSave").attr('disabled', true);

		var url;

			if ( save_method === "update") {
			url = "<?php echo site_url('academic/ajax_update_sub_sched') ?>";
			}

			//alert($("#form_sub_sched").serialize());

			formatDateTime_t();
		$.ajax({


			url:url,
			type:"POST",//post data array
			data:$("#form_sub_sched").serialize(),
			dataType:"JSON",

			success:function(data){

				if (data.status) {

					$("#modal_form_sub_sched").modal('hide');
					reload_table_subject_schedule();
				}

				$("#btnSave").text('save');
				$("#btnSave").attr('disabled', false);
			},//e_s

			error: function (jqXHR, textStatus, errorThrown) //if an error is a response parameter will catch the error to show at the xhr panel
	        {
	            alert('Error update data');
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 

	        }
		});

	}

/* custom private function */
 	function formatDateTime(){
 		

 		var time1 = $("#in_time").val();
 		var amp1 = $("#ampm1").val();
 		var time2 = $("#out_time").val();
 		var amp2 = $("#ampm2").val();
 		var days = $("#m_select_day").val();

 		var f_day_time = days + " " + time1 + " " + amp1 + " - " + time2 + " " + amp2;
 		/*console.log(days + " " + time1 + " " + amp1 + " " + time2 + " " + amp2);*/
 		$("#date_time").val(f_day_time);

 		/*alert(f_day_time);*/
 	}


 	function formatDateTime_t(){

 		var v_select_day = $("#v_select_day").val();
 		var v_in_time = $("#v_in_time").val();
 		var ampm1 = $("#ampm1").val();
 		var v_out_time = $("#v_out_time").val();
 		var ampm2 = $("#ampm2").val();

 		var f_day_time = v_select_day + " " + v_in_time + " " + ampm1 + " - " + v_out_time + " " + ampm2;

 		$("#v_date_time").val(f_day_time);

 		/*alert(f_day_time);*/
 	}

 </script>