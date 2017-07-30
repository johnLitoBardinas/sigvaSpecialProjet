<!--bs_modal-->
<div class="modal fade" id="modal_form_teach" role="dialog">	

	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<!--header-->
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Teacher Form</h3>
			</div>

			<!--body-->
			<div class="modal-body form">
				
				<form action="#" id="form_teach" class="form-horizontal">
					
					<input type="hidden" name="teacher_id">

					<div class="form-body">
						
						<!--txt_lname-->
						<div class="form-group">
                            <label class="control-label col-md-5">Last Name </label>
                            <div class="col-md-7">
                                <input name="teacher_lname" placeholder="Last Name" class="form-control" type="text">
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div>

						<!--txt_fname-->
                        <div class="form-group">
                        	
							<label class="control-label col-md-5">First Name </label>
							<div class="col-md-7">
                                <input name="teacher_fname" placeholder="First Name" class="form-control" type="text">
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div><!--frm_group-->


                        <!--txt_mname-->
                        <div class="form-group">
                        	
							<label class="control-label col-md-5">Middle Name </label>
							<div class="col-md-7">
                                <input name="teacher_mname" placeholder="Middle Name" class="form-control" type="text">
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div><!--frm_group-->

					</div><!--e_frmBOdy-->
				</form>
			</div>

			
			<!--footer-->
			<div class="modal-footer">
				
				<button type="button" id="btnSave" onclick="save_teach()" class="btn btn-primary">Save</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!--modal_content-->
	</div><!--.modal_dialog-->
</div><!--#modal_form-->
