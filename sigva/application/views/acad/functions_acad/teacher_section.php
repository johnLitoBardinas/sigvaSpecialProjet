<!--header-->
<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);
?>

<div class="container-fluid" style="margin-top: 3%">
	
	<!--teacher-->
	
		<div class="page-header">
        <h3>Teacher List</h3>
        </div>
        <br/>
        <button class="btn btn-success" onclick="add_teacher()"><i class="glyphicon glyphicon-plus"></i> Add Teacher </button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i></button>
        <br />
        <br />
        <!--
            id na table amo yan kukuunon ta ko data galin sadto ehh javascript
        -->
        <table id="table_teach" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                	<th> Teacher ID</th>
                    <th> Last Name </th>
                    <th> First Name </th>
                    <th> Middle Name </th>
                    <th> Have Account? </th>
                    <!-- <th> Date of Birth</th> -->
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

    </table>
</div><!-- container -->

<!--footer--> <!--to load the assets first-->
<?php 
$foot = $path."/sigva/application/views/inc/foot.php";
include($foot);
 ?>


 <!-- java script for the teacher -->
 <script type="text/javascript">
 	
 	var save_method;
	var table_teach;


	//in the document is ready
	$(document).ready(function (){

		//table
		table_teach = $("#table_teach").DataTable({

			/*key:value pairs_ JSON formated*/
			//"bInfo" : false,
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('academic/ajax_list_teach') ?>",
				"type":"POST"
			},//ajax propeties with object JSON data


			"columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
	        ],//datatables colomDefinition
		});

	});//e_docu.ready


	//adding teacher
	function add_teacher(){

		save_method = 'add';

		$('#form_teach')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form_teach').modal('show');
		$('.modal-title').text('Add Teacher');
	}//e_+teach


	//editing subject
	function edit_teacher(teacher_id){

		save_method = 'update';
		$('#form_teach')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    $.ajax({

	    	url:"<?php echo site_url('academic/ajax_edit_teach') ?>/"+teacher_id,
	    	type:"GET",
	    	dataType: "JSON",

	    	success:function(data){

	    		//form input get data throught the response data obj
	    		$('[name="teacher_id"]').val(data.teacher_id);
	    		$('[name="teacher_lname"]').val(data.teacher_lname);
	    		$('[name="teacher_fname"]').val(data.teacher_fname);
	    		$('[name="teacher_mname"]').val(data.teacher_mname);
	    		/*$('[name="teach_account"]').val(data.teach_account);*/

	 			$('#modal_form_teach').modal('show');// show the bootstrap model when completed
	 			$('.modal-title').text('Edit Teacher');
	    	},//properties obj laman

	    	error:function (jqXHR, textStatus, errorThrown){

	    		alert("Error from Subject Ajax");
	    	}
	    });//e_ajax()
	}//e_edit_teach


	/*reloading the table*/
	function reload_table()
	{
		//table at the top
	    table_teach.ajax.reload(null,false); //reload datatable ajax 
	}


	/*ajax_saving data teacher*/
	function save_teach(){

		$("#btnSave").text('Saving...');
		$("#btnSave").attr('disabled', true);

		var url;

		if (save_method == 'add') {

			url = "<?php echo site_url('academic/ajax_add_teach') ?>";
		}
		else{

			url = "<?php echo site_url('academic/ajax_update_teach') ?>";
		}

		$.ajax({


			url:url,
			type:"POST",//post data array
			data:$("#form_teach").serialize(), // ginagawang url serve parametirise ang data sa form with its input:name element
			dataType:"JSON",

			success:function(data){

				if (data.status) {

					$("#modal_form_teach").modal('hide');
					$(this).toastmessage('showNoticeToast', 'Updated');
					reload_table();
				}

				$("#btnSave").text('save');
				$("#btnSave").attr('disabled', false);
			},//e_s

			error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 

	        }
		});

	}//e_save()


	function delete_teacher(teacher_id){

		if (confirm('Are you sure to delete Subject?')) {

			$.ajax({

				url:"<?php echo site_url('academic/ajax_delete_teach') ?>/" + teacher_id,
				type:"POST",
				dataType:"JSON",

				success:function(){

					$('#modal_form_teach').modal('hide');
					$(this).toastmessage('showNoticeToast', 'Deleted');
                	reload_table();
				},
				error:function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }

			});
		}

	}//e_del_sub()

 </script>

 <?php include('acad_function_modals/teacher_modal.php') ?>