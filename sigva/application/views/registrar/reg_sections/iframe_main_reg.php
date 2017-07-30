<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);
?>

<div class="row" style="height: 100%; margin-top: 1%">
	
	<div class="col-lg-6 col-md-6">

		<div class="panel panel-success">
	      <div class="panel-heading"> <h1>Registrar Account</h1></div>
	      <div class="panel-body">

			<img src="http://placehold.it/100x100" alt="">

		      
			  <p class="text-left">Username: <span> Registrar </span></p>
			  <p class="text-left">Password: <span> ***** </span></p>
	      </div>
	    </div>
	</div>


	<div class="col-lg-6 col-md-6">
		<div class="panel panel-warning">
	      <div class="panel-heading"> Change Account </div>
	      <div class="panel-body">
	      	
	      	<div class="notification"></div>
			<?php echo form_open('', array('class' => 'form-horizontal update_reg_user')); ?>

		    <div class="form-group">

		      <label class="control-label col-sm-3 col-md-3 col-lg-3" for="usrname">Username:</label>
		      <div class="col-sm-9 col-md-9 col-lg-9">
		        <input type="text" class="form-control" name="new_Username_rg" id="new_Username" placeholder="New username" required="true">
		      </div>
		    </div>
		    <div class="form-group">

		      <label class="control-label col-sm-3 col-md-3 col-lg-3" for="pwd">Old Password:</label>
		      <div class="col-sm-9 col-md-9 col-lg-9">
		        <input type="password" class="form-control" name="old_pass_rg" id="pwd" placeholder="password" required="true">
		      </div>
		    </div>

			<!--new Password-->
		    <div class="form-group">

		      <label class="control-label col-sm-3 col-md-3 col-lg-3" for="pwd">New Password:</label>
		      <div class="col-sm-9 col-md-9 col-lg-9">
		        <input type="password" class="form-control" name="new_pass_rg" id="pwd" placeholder="password" required="true">
		      </div>
		    </div>

			<!--confirm Password-->
		    <div class="form-group">

		      <label class="control-label col-sm-3 col-md-3 col-lg-3" for="pwd">Confirm Password:</label>
		      <div class="col-sm-9 col-md-9 col-lg-9">
		        <input type="password" class="form-control" name="confirm_pass_rg" id="pwd" placeholder="password" required="true">
		      </div>
		    </div>

		    <div class="form-group">

		      <div class="col-sm-offset-10 col-sm-2">
		        <button dir="rtl" type="submit" class="btn btn-default" id="update_reg">Enter</button>
		      </div>
		    </div>

			<?php echo form_close(); ?>
	      </div>
	    </div>
	</div>
</div><!--row-->

<script type="text/javascript">
	
	$(document).ready(function(){

		$("form.update_reg_user").on('submit', function(form){ 
 			/*form dito ay yung element na form natin na yung may class na update_acad_User*/

 			form.preventDefault();

 			var url = "<?php echo site_url('registrar/change_acc_reg') ?>";
 			
 			var data = $("form.update_reg_user").serialize();

 			var callbck = function(data){

 				$("div.notification").html(data);
 				/*$("#update_reg").attr('disabled', true);*/
 			};

 			$.post(url, data, callbck);

 		});


 		/*$("input").on('change', function(){

 			$("div.notification").hide();
 			$("#update_reg").attr('disabled', false);
 		});*/

	});
</script>