<div class="modal fade" id="modal_form_sub_sched" role="dialog">
	
	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Edit Schedule Form</h3>
			</div><!-- modal_header -->

			<div class="modal-body form">
				
				<form name="form_sub_sched" id="form_sub_sched" class="form-horizontal">

				<input type="hidden" name="v_subject_schedule_id">
	        	<input type="hidden" name="v_teacher_subject_id">
	        	<input type="hidden" name="v_section_id">

		        <!--so iba sadi nalang-->

		        <div class="form-group">
                    <label class="control-label col-md-5">Current Schedule </label>
                    <div class="col-md-7">
                        <input type="text" name="v_date_time" readonly="true" style="width: 100%; border: 0; outline: 0;
    background: transparent;
    border-bottom: 1px solid gray;">
                        <span class="help-block"></span> <!--to larger the block element-->
                    </div>
                </div>

				
				<div class="form-group">
					
					<label class="control-label col-md-5">Current Room </label>
                    <div class="col-md-7">
                        <input type="text" name="v_room" id="room" placeholder="room">
                        <span class="help-block"></span> <!--to larger the block element-->
                    </div>
				</div>

				<div class="form-group">
					
					<label class="control-label col-md-5"> Time:</label>

					<div class="col-md-7">
						<?php 

							$in_outTime = array(

							'7:30' => '7:30',
							'8:00' => '8:00',
							'8:30' => '8:30',
							'9:00' => '9:00',
							'9:30' => '9:30',
							'10:00' => '10:00',
							'10:30' => '10:30',
							'11:00' => '11:00',
							'11:30' => '11:30',
							'1:00' => '1:00',
							'1:30' => '1:30',
							'2:00' => '2:00',
							'2:30' => '2:30',
							'3:00' => '3:00',
							'3:30' => '3:30',
							'4:00' => '4:00',
							'4:30' => '4:30',
							'5:00' => '5:00',
							'5:30' => '5:30',
							'6:00' => '6:00',
							'6:30' => '6:30',
							'7:00' => '7:00',
							'7:30' => '7:30',
							'8:00' => '8:00',
							'8:30' => '8:30',
							'9:00' => '9:00',
							);

				        	$days = array(

							'mon' => 'MONDAY',
							'tue' => 'TUESDAY',
							'wed' => 'WENESDAY',
							'thurs' => 'THURSDAY',
							'fri' => 'FRIDAY',
							'sat' => 'SATURDAY'
							);

						$am_pm = array(

								'AM' => 'AM',
								'PM' => 'PM'
							);

						echo form_dropdown(array('id' => 'v_in_time'), $in_outTime);
						echo form_dropdown(array('id' => 'ampm1'), $am_pm);
						echo br();
						echo "<span class='glyphicon glyphicon-arrow-down'> </span>";
						echo br();

						echo form_dropdown(array('id' => 'v_out_time'), $in_outTime);
						echo form_dropdown(array('id' => 'ampm2'), $am_pm);

						echo br();
						$lb2_Attr = array(

								'style' => 'margin-top:2%;'
							);
						echo form_label('DAYS:','',$lb2_Attr);
						echo br();

						$m_select_Attr = array(

								'style' => 'width:168px; font-size:17px; height:20%',
								'multiple' => 'multiple',
								'id' => 'v_select_day'
							);

						echo form_multiselect('', $days, '', $m_select_Attr);
					         ?>

					         <span class="help-block"></span> <!--to larger the block element-->
					</div>
				</div>


			         <input type="hidden" id="v_date_time" name="date_time" value=""></input>

	        	</form>

			</div>

			<div class="modal-footer">
				
				<button type="button" id="btnSave" onclick="save_sub_sched()" class="btn btn-primary">Save</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!--modal_content-->

	</div><!--modal-->

</div><!--modal_fade-->