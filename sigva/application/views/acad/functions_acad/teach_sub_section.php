<!--header-->
<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);
?>

<div class="container-fluid" style="margin-top: 3%">

        <div class="page-header">
        <h3>Teacher Subjects List</h3>
        </div>
        <br/>
        <!---->
        <button class="btn btn-success" onclick="javascript:add_teach_sub()"><i class="glyphicon glyphicon-plus"></i> Add Teacher Subject </button>
        <button class="btn btn-default" onclick="javascript:reload_table_teacher_subject()"><i class="glyphicon glyphicon-refresh"></i></button>

        <div class="row" style="margin-top: 2%">
            
            <div class="col-lg-5 col-md-5">
                
                 <div class="panel panel-default">
                  <div class="panel-heading"> <h3 class="modal-header"></h3>Adding Teacher Subject</div>
                  <div class="panel-body">
                      
                      <form name="adding_sub_teach" id="adding_sub_teach" method="post" class="form-horizontal" align="left">
                        <label style="width: 200px"> Subject Name: </label><select id= "subject_id" name="subject_id" style="margin-left:-74px"></select><br>
                        <label style="width: 200px"> Teacher Name: </label><select name="teacher_id" id="teacher_id" style="margin-left:-74px;" ></select>
                      </form>
                  </div>
                </div>
            </div>
        </div>
       
		

        <hr>
        <!--
            id na table amo yan kukuunon ta ko data galin sadto ehh javascript
        -->
        <table id="table_teach_sub" class="table table-striped table-bordered" cellspacing="0" width="100%">

            <thead>
                <tr>
                    <th> Teacher Last Name </th>
                    <th> Teacher First Name</th>
                    <th> Subject Code </th>
                    <th> Subject Description </th>
                    <th style="width:125px" > Actions </th>
                </tr>
            </thead>
            <tbody>
            </tbody>

    </table>
</div><!-- container_fluid -->

<!--footer--> <!--to load the assets first-->
<?php 
$foot = $path."/sigva/application/views/inc/foot.php";
include($foot);
 ?>

 <!-- javascript for the page -->

 <script type="text/javascript">
 	
 	/* glob var*/
 	var save_method;
	var table_teach_sub;
	var subject_list;

 	$(document).ready(function(){

 		table_teach_sub = $("#table_teach_sub").DataTable({

 			/*key:value pairs_ JSON formated*/
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('academic/ajax_list_teach_sub') ?>",
				"type":"POST"
			},//ajax propeties with object JSON data


			"columnDefs": [
		        { 
		            "targets": [ -1 ], //last column
		            "orderable": false, //set not orderable
		        }
	        ],//datatables colomDefinition
		
 		});
            
        /*setInterval(function(){*/

            ajax_list_teach();
        /*}, 5666);

        setInterval(function(){*/
            
            ajax_list_sub();
        /*}, 5666);*/
            

            
        


 	});/* document.ready*/


 	/* create a ajax request that output the dropbox with the different subjects on it
			
			< option value = id> Name </option>
 	*/
 	/*version 1 ajax_list _sub*/
 	function ajax_list_sub(){
 		var showHtml;

 		var url = "<?php echo site_url('academic/ajax_out_list_sub') ?>";

 		var get_subj = function(response){

 			var res_1 = $.parseJSON(response);

 			showHtml = "<select name='subject_id' id='subject_id'>";
 			$.each(res_1, function(i, value){

 				/*console.log(value.subject_id, value.subject_code);*/

 				showHtml += '<option '+'value= "'+ value.subject_id  + '" > ' + value.subject_code +' </option>';

 			});
 			showHtml += "</select>";

 			$("#subject_id").html(showHtml);	

 		};
		
 		$.get(url, get_subj);
 	}


 	function ajax_list_teach(){

 		var url = "<?php echo site_url('academic/ajax_out_list_teach') ?>";

 		var get_teach = function(response){

 			/*console.log(response);*/ // array a response dapat e parse mo paya
 			var res_2 = $.parseJSON(response);

 			/*console.log(res_2);*/

			var showHtm = "<select name='teacher_id' id='teacher_id'>";
 			$.each(res_2, function(i, value){

 				/*console.log(value.teacher_id, value.TeacherName);*/

 				showHtm += '<option '+'value= "'+ value.teacher_id  + '" > ' + value.TeacherName +' </option>';

 				
 			});
 			showHtm += "</select>";

 			$("#teacher_id").html(showHtm); 
 			// binabalyuwan ahh mismong elemet na ka paryo niya

 		};

 		$.get(url, get_teach);
 	}

/*

	mag popost pag agko data na e susubmit 

	pero pag get mig koko man lang an sa data
*/

 	function add_teach_sub(){

 		var url = "<?php echo site_url('academic/ajax_add_teach_sub') ?>";

 		var data = $("#adding_sub_teach").serialize();

 		$.post(url, data, function(response){

 			var res_f = $.parseJSON(response);

 			if (res_f.status === true) {

 				//alert('Data been inserted!');
                $(this).toastmessage('showNoticeToast', 'Added');
 			}
 			else{
 				alert('Data not submitted!');
 			}

 			reload_table_teacher_subject();
 		});
 	}


 	function delete_teacher_subject(teacher_subject_id){

 		if (confirm("Are you sure to delete Teacher Subject? \n Some data might be lost?")) {

            $.ajax({

                url:"<?php echo site_url('academic/ajax_delete_teach_sub') ?>/" + teacher_subject_id,
                type:"POST",
                dataType:"JSON",

                success:function(){

                    //alert('Data has beed deleted!');
                    $(this).toastmessage('showNoticeToast', 'Deleted');
                    reload_table_teacher_subject();
                },
                error:function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }

            });

        }
 	}
 	/* refreshing the table for the subject*/
	function reload_table_teacher_subject()
	{
	    table_teach_sub.ajax.reload(null,false); //reload datatable ajax 
	}
 	/* working naman yung nasa may data table natin */
 	/* adding new teach_sub*/
	

 </script>
 <?php 
/*
_teacher_subject = extension
_teach_sub = form name
*/
?>

