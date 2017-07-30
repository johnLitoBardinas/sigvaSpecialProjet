<?php 
    
    //print_r($student_grades_article);
    foreach ($student_grades_article as $row) {}
 ?>

 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title_page; ?></title>
    
    <link rel="icon" type="images/gif" href="<?php echo base_url('assets/assets_img/main/sigva_icon.png') ?>" />
	<!--rvs-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">

	<!--font_awesome-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/teach_assets/font-awesome/css/font-awesome.min.css')?>">
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/teach_assets/css/local.css')?>" />
</head>

<body style="margin-top: 1%; background-color: #ffffff">	
	<div class="container">
        
        <!--page_header-->
        <div class="page-header">
            
                <a href="<?php echo site_url('student') ?>" class="btn btn-info btn-lg">
                  <span class="glyphicon glyphicon-log-out"></span> Log out
                </a>
        </div>
            
        <div class="row">
            
            <div class="col-lg-5 col-md-5 col-sm-5" dir="ltr">
                
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: #0F8585; color:#fff; text-transform: uppercase; font-weight: bold"> Student Information </div>
                    
                    <div class="panel-body">
                        
                            <strong> Name: </strong> <span> <?= $row->stud_name ?></span><br>
                            <strong> Program: </strong> <span> <?= $row->program ?></span><br>
                            <strong> Status: </strong> <span> <?= $row->stud_status ?></span><br>
                    </div>

                    <div class="panel-footer">
                        
                        <!--window.open('http://localhost:81/CI_fun/pdfexample')-->
                        <button class="btn btn-md btn-success" onclick="window.open('<?php echo site_url("student_printing") ?>')" style="color:#004"> <span class="glyphicon glyphicon-eye-open" style="font-size: 20px"> </span> &nbsp Print Grades </button>

                    </div>

                </div>

            </div>


            <div class="col-lg-7 col-md-7 col-sm-7">
                
                <div class="row" id="list_subjects" style="height: 100%;">
                    <!--ajax.append here-->

                </div><!--row-->
                    <!--
						dito ko nalang e aapend si sa ajax request ko.
                    -->
            </div>
        </div><!-- row1 -->

    </div><!--container-->

<?php include "stud_inc_login/stud_foot.php" ?>

    <script type="text/javascript">
        
        /* 
        dapat agko na ko ajax sadti na e aapend ko man lang iya sadto ehh # na list_subjects
        */

        $(document).ready(function(){

            //setInterval(grades_article,10000);
            grades_article();

            $('#list_subjects').on('click', 'div#individual_grades', function(){

                $(this).find('table.table-default').slideToggle();
            });

        });

        function grades_article(){

            var url = "<?php echo site_url('student/ajax_grades_article') ?>";
            $.ajax(url,{

                dataType:"Text",
                success:function(response){

                    //$('h3#term').text();
                    $('#list_subjects').append(response);
                },
                error:function(request, errorType, errormessage){

                    alert('ERROR: ' + errorType + ' with message: ' + errormessage);
                }
            });
        }

    </script>
</body>
</html>