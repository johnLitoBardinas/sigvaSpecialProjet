<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="images/gif" href="<?php echo base_url('assets/assets_img/main/sigva_icon.png') ?>" />
    <title> <?php echo $title_page; ?></title>

    <!---->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/custom_reg/css/form-register.css')?>">

    <!--toast alert here-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/alert_Tost/src/main/resources/css/jquery.toastmessage.css') ?>">

</head>

    <div class="main-content">

        <!-- You only need this form and the form-register.css -->

        <?php echo form_open('', array('id' => 'form-register', 'class' => 'form-register')); ?>
            <!-- teach_account | enum('y','n') -->
            <input type="hidden" name="teach_account" value="y">
            <div class="form-register-with-email" >

                <div class="form-white-background">

                    <div class="err"></div>

                    <div class="form-title-row">
                        <h1>Create an account</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Teacher ID</span>
                            <input type="number" name="teacher_id" id="teacher_id"required="true">
                        </label>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Username</span>
                            <input type="text" name="username" required="true">
                        </label>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Password</span>
                            <input type="password" name="pass" required="true">
                        </label>
                    </div>

                    
                    <div class="form-row">
                        <label>
                            <span>Confirm Password</span>
                            <input type="password" name="c_pass" required="true">
                        </label>
                    </div>

                    <div class="form-row">
                        <label class="form-checkbox">
                            <input type="checkbox" name="accpt" checked>
                            <span>I agree to the <a href="#">terms and conditions</a></span>
                        </label>
                    </div>

                    <div class="form-row">
                        <button type="submit" title="Register Account">Register</button>
                    </div>

                </div>

                <a href="<?php echo site_url('teacher');?>" class="form-log-in-with-existing">Already have an account? Login here &rarr;</a>

            </div>

        <?php echo form_close(); ?>

    </div>

    <script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js'); ?>"></script>

    <!--toast components-->
    <script type="text/javascript" src="<?php echo base_url('assets/alert_Tost/src/main/javascript/jquery.toastmessage.js'); ?>"></script>

    <!--bootstrap components-->
    <script type="text/javascript" src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <!--internal javascript-->
    <script type="text/javascript">

        $(document).ready(function(){


            /* dapat so response na ko server ahh ibubutang sadto ehh toast */
            $('form.form-register').on('submit', function(evt){
                evt.preventDefault();

                var url = "<?php echo site_url('teacher/val_reg_teach'); ?>";
                var data = $(this).serialize();
                
                var cb = function(response){

                   var f_rs = $.parseJSON(response);

                   console.log(f_rs.status);
                   if (f_rs.status) {

                        $(this).toastmessage('showNoticeToast', 'Account Successfully Created');
                        $('button').attr('disabled', true);
                        $('button').css('cursor', 'no-drop');
                   }
                   else{

                        $(this).toastmessage('showErrorToast', "Error might be: <br/>Invalid Teacher ID or<br/> Unmatch Password");
                   }
                   
                };

                $.post(url, data, cb);

                /* (type of toast, msg)*/
            });
        });


        /*function ajax_reg(){

            var url = "<?php //echo site_url('teac'); ?>";
            $.post(urk, data, cb);            
        }*/
    </script>
</body>

</html>
