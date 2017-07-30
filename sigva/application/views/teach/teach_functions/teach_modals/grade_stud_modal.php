<?php 
	/* dito kona sasaluhin yung ibabato ng controller para dun sa hidden yung id man lang nung grade tas yung guardian_number sasalohin na sa baba*/
 ?>


<!--bs_modal-->
<div class="modal fade" id="modal_form_grade_stud" role="dialog">	

	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<!--header-->
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Grade Form <br>
                	<span id="stud_name" style="font-size: 18px; color:#1f4d8c; font-weight: bold"></span>
                </h3>
			</div>

			<!--body-->
			<div class="modal-body form">

				<?php

				/*form_attr*/
				$form_attr = array('class' => 'form-inline', 'id' => 'grade_stud'); 
				echo form_open('', $form_attr); 
				?>

					
					<input type="hidden" name="stud_grade_id">
					<input type="hidden" name="guardian_num">
					<input type="hidden" name="stud_name">
					
					<div class="form-body">
						
						<!--prelim-->
						<div class="form-group">
                            <label class="control-label col-md-7">*Prelim <i> 20%</i></label>
                            <div class="col-md-5">
                                <input type="number" name="prelim" id="pr" min="65" max="100" required>
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div>

						
						<!--midterm-->
                        <div class="form-group">
                            <label class="control-label col-md-7">*Midterm <i> 20%</i></label>
                            <div class="col-md-5">
                                <input type="number" name="midterm" id="md" min="65" max="100" required>
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div>


                        <!--pre_finals-->
                        <div class="form-group">
                            <label class="control-label col-md-7">*Pre-Finals <i> 20%</i></label>
                            <div class="col-md-5">
                                <input type="number" name="pre_final" id="pf" min="65" max="100" required>
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div>


                        <!--finals-->
                        <div class="form-group">
                            <label class="control-label col-md-7">*Finals <i> 40%</i></label>
                            <div class="col-md-5">
                                <input type="number" name="final" id="f" min="65" max="100" required>
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div>


                        <!--disabled-->
                        <!--total_subject_grade-->
                        <div class="form-group chk">
                            <label class="control-label col-md-7">Subject Grade</label>
                            <div class="col-md-5">
                                <input type="number" name="sub_grade" id="s_g" readonly="true" style="width: 53px;color: #011019; background-color: #e5e7d9;" >
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div>

                        <!--equivalent-->
                        <div class="form-group">
                            <label class="control-label col-md-7">Equivalent</label>
                            <div class="col-md-5">
                                <input type="number" name="eq" id="sub_eq" readonly="true" style="width: 53px; color: #011019; background-color: #e5e7d9; ">
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div>



						<div class="form-group">

							<label for="" class="control-label col-md-7">Remarks</label>

							<div class="col-md-5">
                                <textarea rows="2" cols="20" style="resize: none" name="remarks"> </textarea>
                                <span class="help-block"></span> <!--to larger the block element-->
                        	</div>
						</div>
						

					</div><!--e_frmBOdy-->

				<?php echo form_close(); ?>
			</div>

			

			<!--footer-->
			<div class="modal-footer chk">
				
				<div class="well well-sm alert alert-warning" style="text-align: justify;"> <strong> Notice!!</strong> &nbsp The grade will automatically send to the student guardian upon Sending. <br> <p style="padding-left: 14.5%"> Be careful of the grade credentials. </p> </div> 
				<!--
				onclick="save_section()

				-->
				<!--save/ send-->
				<button type="button" id="btnSave" class="btn btn-primary" onclick="save_stud_grade()"> <span class="glyphicon glyphico-send"></span>Send</button>

				<button type="button" class="btn btn-warning" data-dismiss="modal">Back</button>
				<!--cancel-->
			</div><!--modal_footer-->

		</div><!--modal_content-->

	</div><!--modal_dialog-->

</div><!--modal_grade_stud-->
<!-- //echo APPPATH.'views/teach/teach_functions/teach_modals/grade_stud/grade_stud_sc.js' -->

<script type="text/javascript">
	
	$(document).ready(function(){

		$('input').change(function(e){

			var sub_g = 0;
			var pr = $('#pr').val();
			var md = $('#md').val();
			var pf = $('#pf').val();
			var f = $('#f').val();

			sub_g = (pr * .20) + (md * .20) + (pf * .20) + (f * .40);

			$('#s_g').val(Math.round(sub_g));


			if (sub_g < 74) {

				$('#sub_eq').val("5.00");
			}
			else if( (sub_g > 74) && (sub_g < 77) ){

				$('#sub_eq').val("3.00");
			}
			else if( (sub_g > 76) && (sub_g < 80) ){

				$('#sub_eq').val("2.75");
			}
			else if( (sub_g > 79) && (sub_g < 83) ){

				$('#sub_eq').val("2.50");

			}
			else if( (sub_g > 82) && (sub_g < 86) ){

				$('#sub_eq').val("2.25");

			}
			else if( (sub_g > 85) && (sub_g < 89) ){

				$('#sub_eq').val("2.00");

			}
			else if( (sub_g > 88) && (sub_g < 92) ){

				$('#sub_eq').val("1.75");

			}
			else if( (sub_g > 91) && (sub_g < 95) ){

				$('#sub_eq').val("1.50");

			}
			else if( (sub_g > 94) && (sub_g < 98) ){

				$('#sub_eq').val("1.25");

			}
			else if( (sub_g > 97) && (sub_g < 101) ){

				$('#sub_eq').val("1.00");

			}
			else{

				$('#sub_eq').val("0.00");
			}

		});

	});

</script>