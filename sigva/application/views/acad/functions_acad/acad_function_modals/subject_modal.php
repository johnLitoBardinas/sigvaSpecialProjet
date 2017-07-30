<!--bs_modal-->
<div class="modal fade" id="modal_form" role="dialog">	

	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<!--header-->
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Subject Form</h3>
			</div>

			<!--body-->
			<div class="modal-body form">
				
				<form action="#" id="form" class="form-horizontal">
					
					<input type="hidden" name="subject_id">

					<div class="form-body">
						
						<!--txt_subject_code-->
						<div class="form-group">
                            <label class="control-label col-md-5">Subject Code</label>
                            <div class="col-md-7">
                                <input name="subject_code" placeholder="Subject Code" class="form-control" type="text">
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div>

						<!--txt_subject_desc-->
                        <div class="form-group">
                        	
							<label class="control-label col-md-5">Subject Description</label>
							<div class="col-md-7">
                                <input name="subject_description" placeholder="Subject Description" class="form-control" type="text">
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div><!--frm_group-->

						
						<!--for the subject_unit-->
                        <div class="form-group">
                        	
							<label class="control-label col-md-5">Subject Unit's</label>
							<div class="col-md-7">
                                <input name="subject_units" placeholder="Units" class="form-control" type="text" style="width: 71px;" maxlength="4">
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div><!--frm_group-->


					</div><!--e_frmBOdy-->
				</form>
			</div>

			
			<!--footer-->
			<div class="modal-footer">
				
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!--modal_content-->
	</div><!--.modal_dialog-->
</div><!--#modal_form-->