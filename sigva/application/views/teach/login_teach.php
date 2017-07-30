 <!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $title_page; ?></title>
	<link rel="icon" type="images/gif" href="<?php echo base_url('assets/assets_img/main/sigva_icon.png') ?>" />
	<link rel="stylesheet" href="<?php echo site_url('assets/custom_reg/css/form-login.css'); ?>">

    <!--toast alert-->
    <!--toast alert here-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/alert_Tost/src/main/resources/css/jquery.toastmessage.css') ?>">

    <!--for the UNI_button-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>">

</head>

<body>
    
    <!-- uni_back_button -->
     <?php include(APPPATH.'views/teach/uni_btn/uni_btn.php') ?>

    <div class="main-content">
        
        <!-- You only need this form and the form-login.css -->
        <?php echo form_open('', array('class' => 'form-login')); ?>

            <div class="form-log-in-with-email" style="margin-top: 2%;">

                <div class="form-white-background">

                    <div class="form-title-row">
                        <h1>Login your Teacher Account</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Username</span>
                            <input type="text" name="teach_username" required="true">
                        </label>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Password</span>
                            <input type="password" name="teach_password" required="true">
                        </label>
                    </div>

                    <div class="form-row">
                        <button type="submit" id="login_teach" title="Login my Account">Log in</button>
                    </div>

                </div>

                <a href="<?php echo site_url('teacher/teacher_registration'); ?>" class="form-create-an-account">Create account from your id &rarr;</a>

            </div>
        <?php echo form_close(); ?>
    </div>


    <!-- the jquery script library -->
    <script type="text/javascript" src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js'); ?>"></script>

    <!--toast components-->
    <script type="text/javascript" src="<?php echo base_url('assets/alert_Tost/src/main/javascript/jquery.toastmessage.js'); ?>"></script>

    <!--bootstrap components-->
    <script type="text/javascript" src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>


    <!-- custom library of the page -->
    <script type="text/javascript">
        
        $(document).ready(function (){

            $('form.form-login').on('submit', function(form){

                form.preventDefault();
                var data = $('form.form-login').serialize();

                console.log(data);
                $.post('<?php echo site_url();?>'+'teacher/val_teach_login', data, function(data){

                    var f_res = $.parseJSON(data);

                    console.log(f_res);
                    if(f_res.status === true){
                        //alert('welcome');

                        var shwToast = function(){

                            $(this).toastmessage('showSuccessToast', 'Welcome!!');
                        };
                        
                        var goMain = function(){

                            location.href="<?php echo site_url('teacher/home') ?>";
                        };
                        /*goMain();*/

                        /* the home page will be.. redirected in interval of 5000*/
                        /* pitfall 

                        setInterval = nag fifire iya kada specific na seconds
                        setTimeout = mig delay iya depende sa specefic na time na naka butang
                        */
                        setTimeout(shwToast, 100);
                        setInterval(goMain, 3000);
                    }else{
                    
                        // toasing error incorect username or the password
                        $(this).toastmessage('showWarningToast', "Invalid Username or Password!");
                    }
                });
            });
        });
    </script>

</body>

</html>
