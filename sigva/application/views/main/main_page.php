<!--* head_here *-->
<?php 
    $path = $this->config->item('server_root');
    //$head = $path."/sigva/application/views/inc/head.php";

    $head = APPPATH.'views/inc/head.php';
    include($head);
?>
<body class="page cust_main_page" id="page" style="background-color: #000; background-image: url('<?php echo base_url('assets/custom/main_page/images/Naga.jpg') ?>');">

    <!--slide show of the text -->
    <?php include('main_prt/text_slide_show.php') ?>

    <div class="container-fluid">
        
        <!--codrops_top_bar-->
        <div class="codrops-top">

            <span class="right">
                <a href="" style="font-size: 22px;
"> SPECIAL PROJECT: <strong> STI Naga</strong></a><strong> SIGVA v3.0</strong>
            </span>
        </div>
        <!--/codrops_top_bar-->

        <!--button in top left corner-->
        <?php include('main_prt/top_left_btn.php') ?>

    </div><!--/container_fluid-->      
<!--* foot_here *-->
<?php 
    //$foot = $path."/sigva/application/views/inc/foot.php";
    $foot = APPPATH.'views/inc/foot.php';
    include($foot);
 ?>
    <!--the custom javascript for the page-->
    <?php include('main_js/main_js.php') ?>