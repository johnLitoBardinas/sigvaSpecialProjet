<div class="container-fluid">

        <h3 style="font-size: 20px">Subject Schedule List</h3>
        
        <button class="btn btn-default" onclick="reload_table_stud_sub_sched()"><i class="glyphicon glyphicon-refresh"></i></button>
        <br>
		
		<?php echo form_open('', array('id' => 'stud_sub_sched')); ?>
        <div style="margin-top: 1%;" align="left">
			<label> Search Student Name: </label>
	        <select name="student_search" id="student_search" style="height: 37px; font-family: arial">

	        	<!-- student_num => stud_name -->
	        </select>

	        <label> Term </label>
	        <select name="sem" id="sem" style="height: 37px; font-family: arial">
	        	
	        	<option value="1st"> 1st semester</option>
	        	<option value="2nd"> 2nd semester</option>
	        </select>

	        <select name="school_year" id="school_year" style="height: 37px; font-family: arial">
	        	
	        	<option value="2016-2017"> 2016-2017 </option>
	        	<option value="2017-2018"> 2017-2018 </option>
	        	<option value="2019-2020"> 2019-2020 </option>
	        	<option value="2021-2022"> 2021-2022 </option>
	        	<option value="2023-2024"> 2023-2024 </option>
	        	<option value="2025-2026"> 2025-2026 </option>
	        </select>
        </div>
        <br />
        <br />
        <!--
            id na table amo yan kukuunon ta ko data galin sadto ehh javascript
        -->
        <table id="table_stud_sub_sched_lst" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th> Subject Code </th>
                    <th> Subject Description </th>
                 <!--    <th> Subject Prerequisite </th> -->
                    <th> Teacher Name </th>
                    <th> Section </th>
                    <th> Room </th>
                    <th> Schedule </th>
                    <th style="width:5%;"> Select </th>
                </tr>
            </thead>
            <tbody>
            </tbody>

			<div align="left" style="margin-top:-26px;margin-left:337px;margin-bottom: 6%;">
			<span id="status"></span>
            <button title="Save the checked schedule" class="btn btn-success btn-md" id="btn_save_data"> <span class="glyphicon glyphicon-plus"> </span> Save </button>
            </div>

            <!-- <input type="submit" value=""> -->

        <?php echo form_close(); ?>

    </table>
</div><!-- end of the container fluid -->

<script type="text/javascript">
	
	var table_stud_sub_sched_lst;

	/* for adding new stud sub_sched */

	$(document).ready(function(){

		table_stud_sub_sched_lst = $("#table_stud_sub_sched_lst").DataTable({

			"bFilter":true, // to disabled the search in datatables
			/*key:value pairs_ JSON formated*/
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('registrar/ajax_list_stud_sub_sched') ?>",
				"type":"POST"
			},//ajax propeties with object JSON data


			"columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
	        ],//datatables colomDefinition
		});


		ajax_stud_list();

	});// ready

	$(function(){

		$('form#stud_sub_sched').on('submit', function(evt){
			evt.preventDefault();
			$("#btn_save_data").attr('disabled', true);
			var stud_id;
			var sem;
			var sy;
			var sub_sched = []; // declaring a literal javascript array type variable
			
			
			stud_id = $("#student_search").val();
			sem = $("#sem").val();
			sy = $("#school_year").val();
			//console.log("Student ID: " + stud_id);

			//console.log(sem + " - " + sy);
			$(':checkbox:checked').each(function(i){

				sub_sched[i] = $(this).val();

				var url = "<?php echo site_url('Registrar/add_stud_sub_sched')?>/"+stud_id+"/"+sub_sched[i]+"/"+sem+"/"+sy;

				console.log("sub_sched_id: " + sub_sched[i]);
				var success = function(response){

					var f_res = $.parseJSON(response);

					console.log(f_res.status);
					$("#status").html(f_res.status);

				};

				$.post(url, success);

			});

		});
	});// like the document.ready sir
	/* ajax for the student_list*/
	function ajax_stud_list(){

		var url = "<?php echo site_url('registrar/ajax_stud_list') ?>";

		var callback = function(response){

			/*console.log(response);*/

			var f_res = $.parseJSON(response);

			/*console.log(f_res);*/

			var injectHtm = "<select name='student_search' id='student_search' name='choice_subsched[]'>";
 			$.each(f_res, function(i, obj){

 				injectHtm += '<option '+'value= "'+ obj.student_id  + '" > ' + obj.stud_fulname +' </option>';	
 			});
 			injectHtm += "</select>";

 			$("#student_search").html(injectHtm);
		};

		$.get(url, callback);
	}


	/* ajax for reloading the table*/
	function reload_table_stud_sub_sched(){

		table_stud_sub_sched_lst.ajax.reload(null,false);
		$("#status").text('');
		$("#btn_save_data").attr('disabled', false);
	}
</script>



<!-- javascript here -->
<?php 
	/*
		table_stud_sub_sched_lst = table name
	*/
 ?>