<!--header-->
<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);
?>
    <div id="reg_student" class="main-content container-fluid" style="margin-top:1%;">

        <!-- You only need this form and the form-validation.css -->

        <!--adding new student-->
        <div id="Reg_stud">
          <?php include('stud_list_sections/stud_list_add.php') ?>
        </div>
    </div><!--first panel-->


    <div class="row">
        
        <div class="col-lg-12 col-md-12">
            
             <div class="panel panel-primary">
              <div class="panel-heading"> 
                <span class="glyphicon glyphicon-file"></span>Available Schedule 
              </div>
              <div class="panel-body">
                  
                  <!--adding schedule by the student-->
                  <?php include('stud_list_sections/stud_sub_sched_add.php'); ?>
              </div>
            </div>

        </div><!--column-->
         
    </div><!--row-->


    <div class="row">
        
        <div class="col-lg-12 col-md-12">
            
             <div class="panel panel-success">
              <div class="panel-heading"> <span class="glyphicon glyphicon-file"></span> Student Subjects Schedule <span style="margin-left:5%"> TERM: 1st sem 2016-2017</span></div> 
              <div class="panel-body">
                  
                  <!--deleting and viewing the current subject of the student-->
                  <?php include('stud_list_sections/stud_view_sub_sched.php'); ?>
              </div>
            </div>

        </div><!--column-->
         
    </div><!--row-->
<!--footer--> <!--to load the assets first-->
<?php 
$foot = $path."/sigva/application/views/inc/foot.php";
include($foot);
 ?>  

<!-- javascript of the page -->
<script>

    $(document).ready(function() {

    	$("#guardian_notExist").show();
        // Here is how to show an error message next to a form field

        out_guard_list();

        $('form#add_new_rec').on('submit', function(evt){

            evt.preventDefault();

            //var test = $('form#add_new_rec').serialize();
            //console.log(test);

            var url = "<?php echo site_url('registrar/validate_guardian_student_data'); ?>";

            var data = $('form#add_new_rec').serialize();
            
            var cb = function(response){

              var f_res = $.parseJSON(response);

              //console.log(f_res.status);

              if(f_res.status){

                $(this).toastmessage('showNoticeToast', 'Sucessfully Registered!');

                setTimeout(function(){

                  location.reload(true);
                }, 1000);
              }
              else{

                $(this).toastmessage('showWarningToast', 'Error Registering');
              }

            };


            /* pitfall kung may mga data na ipapasa e lagay mo*/
            $.post(url,data, cb);
        });
    });


    /* drop box event change to none*/
    function guardian_notExist(){

      var guard_name = $("#listed_guardian").val();
    	
        if (guard_name != 'none') {

          $("#guardian_notExist").hide(1000);
        }
        else if(guard_name == 'none'){

          $("#guardian_notExist").show(1000);
        }
        else{

          $("#guardian_notExist").show(1000);
        }
    }

    /* outputing the list of the guardian */
    function out_guard_list(){

      var url = "<?php echo site_url('registrar/out_guardian_list') ?>";

      var cb = function(data){

        /*console.log(data);*/

        var f_dat = $.parseJSON(data);

        /*console.log(f_dat);*/

        $.each(f_dat, function(i, row){

          var new_g = $("<option value="+ row.guard_id+">"+ row.guard_name+"</option>");

          $("#listed_guardian").append(new_g);
        });
      };
      $.get(url, cb);
    }
</script>

</body>

</html>
