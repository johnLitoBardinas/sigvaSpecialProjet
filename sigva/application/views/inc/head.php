<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo doctype('html5'); ?>
<html lang="en">
<head>	

	<title> <?php echo $title_page ?> </title>

    <!--sigva_icon-->
    <link rel="icon" type="images/gif" href="<?php echo base_url('assets/assets_img/main/sigva_icon.png') ?>" />

    <!--meta_element-->
	<meta charset="utf-8" lang="eng">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SMS Innovated Grade Viewer Application" />
    
    <!--bs_min.css-->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    
    <!--dtable-->
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    
    <!-- main_css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom/main_page/css/demo.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom/main_page/css/style0.css') ?>">

    <!--registrar-->
    <link rel="stylesheet" href="<?php echo base_url('assets/custom_reg/css/form-validation.css'); ?>">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

     <!--toast alert here-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/alert_Tost/src/main/resources/css/jquery.toastmessage.css') ?>">

    <!-- custom css for the academic -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom/academic/reg_home_front.css') ?>">
    <!--custom css for the mainpage-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom/main_page/css/cust_css.css') ?>">
    
    <!--custom_css for the registrar-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom/registrar/reg_css.css') ?>">

    <!-- universal button for the SIGVA -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets_img/btn_back/css/UI_b_css.css') ?>">

    <!--jquery-->
    <script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js') ?>"></script>

   
    <!-- script respond -->
<!--     <script src="js/respond.min.js"></script> -->

    <style type="text/css">

    /* main page additional css */
        .chk{

            border:thin solid blue; 
        }

        .lchoice{
            text-transform: uppercase;
            cursor: pointer;
            background-color: darkblue;
            width: 141.53px;
        }


        /* for the acad*/
        body {
            position: relative;
        }
        ul.nav-pills {
            top: 20px;
            position: fixed;
        }
        div.col-sm-9 div {
            height: 250px;
            font-size: 28px;
        }
        /* #section1 {color: #fff; background-color: #1E88E5;}
        #section2 {color: #fff; background-color: #673ab7;}
        #section3 {color: #fff; background-color: #ff9800;}
        #section41 {color: #fff; background-color: #00bcd4;}
        #section42 {color: #fff; background-color: #009688;} */
        
        @media screen and (max-width: 810px) {
          #section1, #section2, #section3, #section41, #section42  {
              margin-left: 150px;
          }
        }


        /* academic addtional css */

        .nav.nav-tabs{

            /* border:thin solid blue; */
        }

        /* academic home */
        li>span{
/* 
            background-color: green; */
            font-size: 40px;
        }

        iframe{

            margin:0;
            padding:0;
        }


       /*  table.table_sub_sched:nth-child(5)>dt{
               
               text-align:left;
       } */

       th{

        text-align: center;
        }

        td{

            text-align: left;
        }
        .alignCnt{

            display: block;
            text-align: center;
            width: 100%;
        }
    </style>


    <!--iframe_responsive-->
    <script language="javascript" type="text/javascript">
      function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
      }
    </script>

</head>

<body>