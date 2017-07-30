<!--include head of the page-->
<?php include "stud_inc_login/stud_head.php"; ?>
<body>  
    <?php include(APPPATH.'views/teach/uni_btn/uni_btn.php') ?>
	<div class="main-content">

        <!-- You only need this form and the form-login.css -->
        <form class="form-login" id="frm_login_stud" method="post" action="#">

            <div class="form-log-in-with-email">

                <div class="form-white-background">

                    <div class="form-title-row">
                        <h1>Welcome Student</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Access Code:</span>
                            <input type="text" name="stud_access_code" id="access_code" required="true">
                        </label>
                    </div>

                    <div class="form-row">
                        <button type="submit" title="Check your Code" style="background-color: #5bb590;">Proceed</button>
                    </div>

                </div>

            </div>
        </form>
    </div>

    <!--include foot of page here -->
    <?php include "stud_inc_login/stud_foot.php"; ?>

    <script type="text/javascript">
        
    $(document).ready(function(){

    //var hell = 'Hello world';
    /* the code above will be use to the stud/stud_page_login_view */

    $('form#frm_login_stud').on('submit', function(e){

            e.preventDefault();
            
            var code = $('#access_code').val();
            var url = "<?php echo site_url('student/validate_student')?>/" + code;

           $.ajax({

                url:url,
                dataType:"JSON",
                success:function(response){

                    //console.log(response.status);

                    if (response.status) {

                    $(this).toastmessage('showNoticeToast', 'Welcome Student!!');
                        setTimeout(function(){

                            location.href = "<?php echo site_url('student/student_home') ?>";

                        },2000);
                         
                    }
                    else{

                        $(this).toastmessage('showWarningToast', "Access Code not Found!!");
                    }
                },
                error:function(request, errorType, errormessage){

                     alert('ERROR: ' + errorType + ' with message: ' + errormessage);
                },
                /*beforeSend:function(){

                    $('div#loader').addClass('loader');
                },
                complete:function(){

                    $('#loader').removeClass('loader');
                }*/
           });

            //alert(data);
        });
        
    });
    </script>

</body>
</html>