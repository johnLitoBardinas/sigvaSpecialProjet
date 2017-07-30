<?php include("teach_inc/teach_head_prt.php"); ?>

 	<?php 
 		/*echo (isset($teach_dat) ? print_r($teach_dat) : 'No data found');*/

 		foreach ($teach_dat as $row) {
 			
 			$t_id = $row->teach_id;
 			$t_name = $row->teach_name;
 			$t_username = $row->username;
 		}

 		//$GLOBALS['t_id'] = $t_id;
 		$GLOBALS['t_name'] = $t_name;
        $this->session->set_userdata('teach_name',$t_name);
 		//$GLOBALS['t_username'] = $t_username;
 	 ?>

	<!--main_prt of the page-->
 	 <?php include('teach_inc/teach_main_prt.php'); ?>


<!--datatables-->
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>

<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>

<!-- custom javascript for the page -->
 <script type="text/javascript">
        
        $(document).ready(function(){

            // dapat pag cliniclick ahh anchor = nag aactive iya. tas so dating agko active na attr. na uuda na dapat

            $('#sched').on('click', function(evt){

                evt.preventDefault();

                if ($('#subj_prt').show() || $('#main_wrapper').show()) {

                    $('#main_wrapper').hide();
                    $('#sched_prt').show();
                    $('#subj_prt').hide();
                }
           
            });


            $('#subj').on('click', function(evt){

                evt.preventDefault();

                if ($('#sched_prt').show() || $('#main_wrapper').show()) {

                	// i hihide ko yung sa loob ng main. tas aapend ko sa main wrapper yung class
                    $('#main_wrapper').hide();
                    $('#sched_prt').hide();
                    $('#subj_prt').show();
                }
                
            });
        });


    </script>