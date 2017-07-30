<div class="container-fluid">

        <h3 style="font-size: 20px">Student's Schedule List</h3>
        <button class="btn btn-default" onclick="reload_tb_view_stud_sched()"><i class="glyphicon glyphicon-refresh"></i></button>
        <br>
        <br />
        <br />
        <!--
            id na table amo yan kukuunon ta ko data galin sadto ehh javascript
        -->
        <table id="tb_view_stud_sched" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th> Grade Code </th>
                    <th> Student </th>
                    <th> Subject </th>
                    <th> Subject Description </th>
                    <th> Teacher </th>
                    <th> Section </th>
                    <th> Room </th>
                   <th> Schedule </th>
                    <th style="width:5%;"> Action </th>
                </tr>
            </thead>
            <tbody>
            </tbody>

			<span id="status"></span>

    </table>
</div><!-- end of the container fluid -->

<script type="text/javascript">
	
	var tb_view_stud_sched;

	/* for adding new stud sub_sched */

	$(document).ready(function(){

		tb_view_stud_sched = $("#tb_view_stud_sched").DataTable({

			//"bFilter":false, // to disabled the search in datatables
			/*key:value pairs_ JSON formated*/
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('registrar/out_stud_sub_sched_view') ?>",
				"type":"POST"
			},//ajax propeties with object JSON data

			"columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
	        ],//datatables colomDefinition

		});


		// Add event listener for opening and closing details
	    $('#example tbody').on('click', 'td.details-control', function () {
	        var tr = $(this).closest('tr');
	        var row = table.row( tr );
	 
	        if ( row.child.isShown() ) {
	            // This row is already open - close it
	            row.child.hide();
	            tr.removeClass('shown');
	        }
	        else {
	            // Open this row
	            row.child( format(row.data()) ).show();
	            tr.addClass('shown');
	        }
	    } );

		//?
		ajax_stud_list();

	});// ready

	/* ajax for reloading the table*/
	function reload_tb_view_stud_sched(){

		tb_view_stud_sched.ajax.reload(null,false);
	}


	function delete_stud_sched(stud_grade_id){

		

		if (confirm('Delete this Student Schedule? ')) {

			//del_stud_sched
			/*alert('Data has been deleted');*/

			$.ajax({

				url:"<?php echo site_url('registrar/del_stud_sched') ?>/"+stud_grade_id,
				type:"POST",
				dataType:"JSON",

				success:function(){

					alert('Data has been deleted');
					reload_tb_view_stud_sched();
				},
				error:function (jqXHR, textStatus, errorThrown)
	            {
	                alert('Data not deleted error request');
	            }
			});
		}
	}


</script>