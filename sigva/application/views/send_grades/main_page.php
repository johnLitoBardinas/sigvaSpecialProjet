<!DOCTYPE html>
<html lang="en">

    <?php include('inc_main_page/main_page_head.php');?>
<body>

    <div class="box9">
        
        <div class="box-header"> 
            <h2 style="font-family: Segoe UI Light Oblique"> <b>Term:</b> <span id="term"> 1st sem 2016-2017</span></h2>
        </div>


        <div class="box-content">
            
    <form id="frm_Send" action="<?php echo site_url('send_grades/text_Blast') ?>" method="POST">

    <input type="hidden" value="" id="outJsonSend" name="outJsonSend"></input>
    <button type="submit" id="btn_Send" class="btn btn-lg btn-success" style="margin:2%"> <span class="glyphicon glyphicon-send"></span> &nbsp Release Grades </button>

    </form>

    </div><!--box_content-->
    </div><!--box9-->
    <br>
    <br>
    <label> Select Subject: <!-- onchange='filterText()''-->
        <select id='filterText' style='display:inline-block; height: 37px;font-stretch: extra-expanded;font-size: 17px;width: 88%;margin-left: 12%;'>
            <option value='all'> All</option>
        </select>
    </label>
     <table id="table_format" class="table table-bordered table-striped table-hover table-list-search">

                    <!-- two ajax request will be here the filter text and the  content td -->
                    
                        <tr>
                            <td style="display: none"> Grade code </td>
                            <td> Student name </td>
                            <td> Subject</td>
                            <td> Prelim </td>
                            <td> Midterm </td>
                            <td> Prefinal </td>
                            <td> Finals </td>
                            <td> Subject Grade </td>
                            <td> Gen. Average </td>
                            <td> Remarks </td>
                            <td> Section </td>
                            <td> Guardian Number </td>
                        </tr>
                    <tbody  id="myTable">
                        <!-- tr here to be append using ajax -->
                    </tbody>
                </table>

<?php include('inc_main_page/main_page_footer.php') ?>

<script>

    $(document).ready(function(){

        ajax_get_grades_data();
        // ajax_select_subjects
        var url = "<?php echo site_url('send_grades/ajax_get_select_subject') ?>";

        $.ajax(url, {
            method:"POST",
            dataType:"JSON",
            success:function(data){

               var injectHtml="";

                $.each(data, function(i, key){


                    injectHtml += "<option value='"+key.subject_name+"'>"+key.subject_name+"</option>";

                });

                $('#filterText').append(injectHtml);
            },
            error:function(request, errorType, errorMessage){

                alert("Request: " + request + "Message : " + errorMessage);
            }

        });


        /* auto sort table*/
        $('label').on('change', '#filterText', function(){
                
                $("#btn_Send").attr('disabled', false);

                //filterText();
                var rows = $('table#table_format tbody#myTable > tr');
                var selected = this.value;
                //alert(selected);

                if (selected != "all") {

                    
                    rows.filter("[position='"+selected+"']").show();
                    rows.not("[position='"+selected+"']").hide();
                    //alert(selected);

                    var myTableArray = [];

                    $("table#table_format tbody#myTable > tr[position='"+selected+"']").each(function() {
                        var arrayOfThisRow = [];
                        var tableData = $(this).find('td');
                        if (tableData.length > 0) {
                            tableData.each(function() { arrayOfThisRow.push($(this).text()); });
                            myTableArray.push(arrayOfThisRow);
                        }
                    });

                    //alert(myTableArray);

                    //console.log(myTableArray);

                    //console.log(JSON.stringify(myTableArray));
                    $('input#outJsonSend').val(JSON.stringify(myTableArray));
                }else{

                    rows.show();
                }//e_if_else*/
        });

        /* magic of sending new message here */
        $('form#frm_Send').on('submit', function(e){
            e.preventDefault();

            if (confirm('Proceed?')) {

                //console.log("input = :) " + $('input#outJsonSend').val());
                var url = $(this).attr('action');
                var data = $('form#frm_Send').serialize();

                /* may time lagyan ng progress bar */
                $.ajax(url,{

                    data: data,
                    method:"POST",
                    dataType:"JSON",

                    success:function(response){

                        /* toast ang nandito */
                        //console.log(response.status);

                        if (response.status) {

                            //console.log(response.status);
                            $(this).toastmessage('showNoticeToast', 'SUCCESS!! Sending');

                            /* 
                            saving the system term
                            */

                            var sub = $("#filterText").val();

                            var savelogs = "<?php echo site_url('send_grades/save_textBlast_Logs');?>/"+ sub;

                            $.post(savelogs, function(response){

                                     //console.log('logs saved');
                                    $(this).toastmessage('showSuccessToast', 'Logs Saved!');
                                    $("#btn_Send").attr('disabled', true);
                                
                            });
                        }
                        else{

                            $(this).toastmessage('showErrorToast', 'ERROR!! Sending');  
                        }
                    },
                    error:function(request, errorType, errorMessage){

                    alert("Request: " + request + "Message : " + errorMessage);
                    }

                });
            }// the confirm

        });
    });

    /* ajax get the data for the table */
    function ajax_get_grades_data(){

        var url = "<?php echo site_url('send_grades/ajax_get_subjects_all')?>";
        $.ajax(url, {
            method:"POST",
            dataType:"JSON",
            success:function(data){

                //console.log(data);
                put_to_tbl(data);
            },

            error:function(request, errorType, errorMessage){

                alert("Request: " + request + "Message : " + errorMessage);
            }

        });
    }

    function put_to_tbl(data){

        var outHtml = "";
        $.each(data, function(i, value){

            //console.log(value.stud_name);

                outHtml += "<tr position='"+value.subject_name+"'>";

                outHtml += "<td style='display:none'>"+value.grade_code+"</td>";
                outHtml += "<td>"+value.stud_name+"</td>";
                outHtml += "<td>"+value.subject_name+"</td>";
                outHtml += "<td>"+value.pr_grade+"</td>";
                outHtml += "<td>"+value.md_grade+"</td>";
                outHtml += "<td>"+value.pf_grade+"</td>";
                outHtml += "<td>"+value.finals+"</td>";
                outHtml += "<td>"+value.sub_grade+"</td>";
                outHtml += "<td>"+value.gen_ave+"</td>";
                outHtml += "<td>"+value.remarks+"</td>";
                outHtml += "<td>"+value.sec+"</td>";
                outHtml += "<td>"+value.guardian_num+"</td>";

            outHtml += "</tr>";
        });

        $('#myTable').append(outHtml);
    }

</script>
</body>
</html>

<!-- 
        very first sending text blast:

        10/24/2016 with no logs
 -->