<script>
	
	$(document).ready(function (){

		/* ajax form of $.ajax*/

		$("#toRegistrar").submit(function(evt){
			evt.preventDefault(); // preventing load page

			var url = "<?php echo site_url() ?>registrar/validate_registrar";
			var frmData = $("#toRegistrar").serialize();

			/*console.log(frmData);*/
			var login_cb = function(response){

				if(response === "1"){

					location.href="<?php echo site_url('registrar/home') ?>";

					/*console.log('Sucessfully login');*/
				}else{
				/*console.log(data);*/
				$('div.error').addClass('alert alert-danger fade in').attr('aria-label','close');
				$('div.error').html(response);
				}
			};

			$.post(url, frmData, login_cb);

		});
	});
</script>