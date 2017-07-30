<!--bs_modal-->
<div class="modal fade" id="modal_form_sec" role="dialog">	

	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<!--header-->
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Section Form</h3>
			</div>

			<!--body-->
			<div class="modal-body form">
				
				<form action="#" id="form_sec" class="form-horizontal">
					
					<input type="hidden" name="subject_id">

					<div class="form-body">
						
						<!--txt_subject_code-->
						<div class="form-group">
                            <label class="control-label col-md-5">Section Name</label>
                            <div class="col-md-7">
                                <input name="section_name" placeholder="Section Name" class="form-control" type="text">
                                <span class="help-block"></span> <!--to larger the block element-->
                            </div>
                        </div>

					</div><!--e_frmBOdy-->
				</form>
			</div>

			
			<!--footer-->
			<div class="modal-footer">
				
				<button type="button" id="btnSave" onclick="save_section()" class="btn btn-primary">Save</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
			</div>
		</div><!--modal_content-->
	</div><!--.modal_dialog-->
</div><!--#modal_form-->
