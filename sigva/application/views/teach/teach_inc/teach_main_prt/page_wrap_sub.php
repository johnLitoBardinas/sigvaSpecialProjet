<div class="page-wrapper">
            
    <div class="row">
     	<div class="col-lg-12 col-md-12 col-sm-12">
     		
     		<div class="panel panel-success" style="margin:0 auto; width: 95%;">
              <div class="panel-heading">
                <h3 class="panel-title"> <span class="glyphicon glyphicon-list-alt"></span> &nbsp My Subject </h3>
              </div>
              <div class="panel-body">

				<div class="container-fluid">
			        
			        <!--
			            id na table amo yan kukuunon ta ko data galin sadto ehh javascript
			        -->
			        <table id="table_t_sub" class="table table-striped table-bordered" cellspacing="0" width="100%">
			            <thead>
			                <tr>
			                    <th> Subject Code </th>
			                    <th> Subject Description </th>
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
 	
 	var table_t_sub;

	$(document).ready(function(){

		table_t_sub = $("#table_t_sub").DataTable({

			/*key:value pairs_ JSON formated*/
			"bInfo" : false,
			"processing":true,
			"serverSide":true,
			"order":[],
			"ajax":{

				"url":"<?php echo site_url('teacher/ajx_get_tSub') ?>",
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