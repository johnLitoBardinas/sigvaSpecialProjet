<!--header-->
<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);
?>

<!--body part-->
<div class="container-fluid" style="margin-top: 3%">

		<div class="page-header">
        <h3>Subject List</h3>
        </div>
        <br/>
        <button class="btn btn-success" onclick="add_subject()"><i class="glyphicon glyphicon-plus"></i> Add Subject</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i></button>
        <br />
        <br />
        <!--
            id na table amo yan kukuunon ta ko data galin sadto ehh javascript
        -->
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Subject Code </th>
                    <th>Subject Description </th>
                    <th>Subject Unit's</th>
                    <!-- <th>Address</th>
                    <th>Date of Birth</th> -->
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

    </table>
</div>
<!--footer--> <!--to load the assets first-->
<?php 
$foot = $path."/sigva/application/views/inc/foot.php";
include($foot);
 ?>

<!--functional script_page-->
<script type="text/javascript">
	
	var save_method;
	var table;

	$(document).ready(function (){

		//table
		table = $("#table").DataTable({

			/*key:value pairs_ JSON formated*/
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('academic/ajax_list') ?>",
				"type":"POST"
			},//ajax propeties with object JSON data


			"columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
	        ],//datatables colomDefinition
		});

		//datepicker
		/*$(".datepicker").datepicker({

			autoclose: true,
	        format: "yyyy-mm-dd",
	        todayHighlight: true,
	        orientation: "top auto",
	        todayBtn: true,
	        todayHighlight: true, 
		});*///javascript:obj is define

	});// e_document_ready()


	//adding subject
	function add_subject(){

		save_method = 'add';

		$('#form')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form').modal('show');
		$('.modal-title').text('Add Subject');
	}

	//editing subject
	function edit_subject(subject_id){

		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //JQUERY mismong library
	    $.ajax({

	    	url:"<?php echo site_url('academic/ajax_edit_sub') ?>/"+subject_id,
	    	type:"GET",
	    	dataType: "JSON",

	    	success:function(data){

	    		$('[name="subject_id"]').val(data.subject_id);
	    		$('[name="subject_code"]').val(data.subject_code);
	    		$('[name="subject_description"]').val(data.subject_description);
	    		$('[name="subject_units"]').val(data.subject_units);


	 			$('#modal_form').modal('show');// show the bootstrap model when completed
	 			$('.modal-title').text('Edit Subject');
	    	},//properties obj laman

	    	error:function (jqXHR, textStatus, errorThrown){

	    		alert("Error from Subject Ajax");
	    	}
	    });//e_ajax()
	}

	function reload_table()
	{
	    table.ajax.reload(null,false); //reload datatable ajax 
	}

	function save(){

		$("#btnSave").text('Saving...');
		$("#btnSave").attr('disabled', true);

		var url;

		if (save_method == 'add') {

			url = "<?php echo site_url('academic/ajax_add_subject') ?>";
		}
		else{

			url = "<?php echo site_url('academic/ajax_update_subject') ?>";
		}

		$.ajax({


			url:url,
			type:"POST",//post data array
			data:$("#form").serialize(),
			dataType:"JSON",

			success:function(data){

				if (data.status) {

					$("#modal_form").modal('hide');
					$(this).toastmessage('showNoticeToast', 'Subject Updated');
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


	function delete_subject(subject_id){

		if (confirm('Are you sure to delete Subject?')) {

			$.ajax({

				url:"<?php echo site_url('academic/ajax_delete_subject') ?>/" + subject_id,
				type:"POST",
				dataType:"JSON",

				success:function(){

					$('#modal_form').modal('hide');
					$(this).toastmessage('showNoticeToast', 'Subject Deleted');
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

<!-- modal -->
<?php  include('acad_function_modals/subject_modal.php')?>