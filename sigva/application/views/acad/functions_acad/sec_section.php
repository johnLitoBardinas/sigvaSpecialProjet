<!--header-->
<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);
?>

<!-- body -->
<div class="container-fluid" style="margin-top:3%">

		<div class="page-header">
	    <h1>Section List</h1>
	  	</div>

        <br/>
        <button class="btn btn-success" onclick="add_section()"><i class="glyphicon glyphicon-plus"></i> Add Section </button>
        <button class="btn btn-default" onclick="reload_table_section()"><i class="glyphicon glyphicon-refresh"></i></button>
        <br />
        <br />
        <!--
            id na table amo yan kukuunon ta ko data galin sadto ehh javascript
        -->
        <table id="table_sec" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th> Section Name </th>
                    <!-- <th>Subject Description </th> -->
                    <!-- <th>Gender</th>
                    <th>Address</th>
                    <th>Date of Birth</th> -->
                    <th style="width:125px;"> Actions </th>
                </tr>
            </thead>
            <tbody>
            </tbody>

    </table>
</div><!-- end of the container fluid -->


<!--footer--> <!--to load the assets first-->
<?php 
$foot = $path."/sigva/application/views/inc/foot.php";
include($foot);
 ?>


 <!-- javascript of the sec_section page -->
 <script type="text/javascript">
 	
 	var save_method;
	var table_sec;

/*
	_section = function suffix extension
	_sec = extension to someone hold data or show data

	modal_form_sec = modal
	form_sec = form
	table_sec = table
*/
	//ready event with a callback anonymous function
	$(document).ready(function(){

		// datatable (event or function) with a object argument
		table_sec = $("#table_sec").DataTable({

			/*key:value pairs_ JSON formated*/
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('academic/ajax_list_sec') ?>",
				"type":"POST"
			},//ajax propeties with object JSON data


			"columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
	        ],//datatables colomDefinition
		});

	}); // end document.ready()


	/* adding section */
	function add_section(){

		save_method = 'add';

		$('#form_sec')[0].reset(); // reset the form frm
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form_sec').modal('show'); // modal({setting})
		$('.modal-title').text('Add Section'); // the title
	}

	/*mysql> describe section_tbl;
	+--------------+-------------+------+-----+---------+----------------+
	| Field        | Type        | Null | Key | Default | Extra          |
	+--------------+-------------+------+-----+---------+----------------+
	| section_id   | int(11)     | NO   | PRI | NULL    | auto_increment |
	| section_name | varchar(15) | NO   |     | NULL    |                |
	+--------------+-------------+------+-----+---------+----------------+*/

	/* editing section */
	function edit_section(section_id){

		save_method = 'update';
		$('#form_sec')[0].reset(); // reset form on modals
	    $('.form-group').removeClass('has-error'); // clear error class
	    $('.help-block').empty(); // clear error string

	    //JQUERY mismong library
	    $.ajax({

	    	url:"<?php echo site_url('academic/ajax_edit_sec') ?>/"+section_id,
	    	type:"GET",
	    	dataType: "JSON",

	    	success:function(data){

	    		$('[name="section_id"]').val(data.section_id);
	    		$('[name="section_name"]').val(data.section_name);

	 			$('#modal_form_sec').modal('show');// show the bootstrap model when completed
	 			$('.modal-title').text('Edit Section');
	    	},//properties obj laman

	    	error:function (jqXHR, textStatus, errorThrown){

	    		alert("Error from Section Ajax");
	    	}
	    });//e_ajax()
	}


	/* reload the section table */
	function reload_table_section()
	{
	    table_sec.ajax.reload(null,false); //reload datatable ajax 
	}


	/* saving data whether it its a add or an update */
	function save_section(){

		$("#btnSave").text('Saving...');
		$("#btnSave").attr('disabled', true);

		var url;

		if (save_method == 'add') {

			url = "<?php echo site_url('academic/ajax_add_sec') ?>";
		}
		else{

			url = "<?php echo site_url('academic/ajax_update_sec') ?>";
		}

		$.ajax({


			url:url,
			type:"POST",//post data array
			data:$("#form_sec").serialize(),
			dataType:"JSON",

			success:function(data){

				if (data.status) {

					$("#modal_form_sec").modal('hide');
					$(this).toastmessage('showNoticeToast', 'Section Updated');
					reload_table_section();
				}

				$("#btnSave").text('save');
				$("#btnSave").attr('disabled', false);
			},//e_s

			error: function (jqXHR, textStatus, errorThrown) //if an error is a response parameter will catch the error to show at the xhr panel
	        {
	            alert('Error adding / update data');
	            $('#btnSave').text('save'); //change button text
	            $('#btnSave').attr('disabled',false); //set button enable 

	        }
		});

	}


	/* deleting the section by its section_id*/
	function delete_section(section_id){

		if (confirm('Are you sure to delete Section?')) {

			$.ajax({

				url:"<?php echo site_url('academic/ajax_delete_sec') ?>/" + section_id,
				type:"POST",
				dataType:"JSON",

				success:function(){

					$('#modal_form_sec').modal('hide');
					$(this).toastmessage('showNoticeToast', 'Deleted');
                	reload_table_section();
				},
				error:function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Error deleting data');
	            }

			});

		}// end confirm

	}

 </script>

 <!-- the modal will be included here -->
 <?php include('acad_function_modals/section_modal.php') ?>