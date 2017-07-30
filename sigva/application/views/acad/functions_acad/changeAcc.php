<!--header-->
<?php 
    $path = $this->config->item('server_root');
    $head = $path."/sigva/application/views/inc/head.php";
    include($head);
?>

<div class="row" style="margin-left:5%; margin-top:3%">
 	
 	<?php //echo $this->session->userdata('acad_id'); ?>
 	<!--first panel-->
	<div class="col-lg-5 col-md-5 col-sm-5">
		
		 <div class="panel panel-primary">
		      <div class="panel-heading"> Academic Account </div>
		      <div class="panel-body">
		      	
		      	<img src="http://placehold.it/100x100" alt="">

		      
			  <p class="text-left">Username: <span> Admin </span></p>
			  <p class="text-left">Password: <span> ***** </span></p>
			  
		      </div>
		 </div>
	</div>

	<!--second panel-->
	<div class="col-lg-6 col-md-6 col-sm-6">
		
		<div class="panel panel-default panel-success">
	      <div class="panel-heading"> Change Account</div>
	      <div class="panel-body">

			<div class="notification"></div>
			<?php echo form_open('', array('class' => 'form-horizontal update_acad_User')); ?>

		    <div class="form-group">
		      <label class="control-label col-sm-3 col-md-3 col-lg-3" for="usrname">Username:</label>
		      <div class="col-sm-9 col-md-9 col-lg-9">
		        <input type="text" class="form-control" name="new_Username" id="new_Username" placeholder="New username" required="true">
		      </div>
		    </div>
		    <div class="form-group">
		      <label class="control-label col-sm-3 col-md-3 col-lg-3" for="pwd">Old Password:</label>
		      <div class="col-sm-9 col-md-9 col-lg-9">
		        <input type="password" class="form-control" name="old_pass" id="pwd" placeholder="password" required="true">
		      </div>
		    </div>

			<!--new Password-->
		    <div class="form-group">
		      <label class="control-label col-sm-3 col-md-3 col-lg-3" for="pwd">New Password:</label>
		      <div class="col-sm-9 col-md-9 col-lg-9">
		        <input type="password" class="form-control" name="new_pass" id="pwd" placeholder="password" required="true">
		      </div>
		    </div>

			<!--confirm Password-->
		    <div class="form-group">
		      <label class="control-label col-sm-3 col-md-3 col-lg-3" for="pwd">Confirm Password:</label>
		      <div class="col-sm-9 col-md-9 col-lg-9">
		        <input type="password" class="form-control" name="confirm_pass" id="pwd" placeholder="password" required="true">
		      </div>
		    </div>
		    <div class="form-group">
		      <div class="col-sm-offset-10 col-sm-2">
		        <button dir="rtl" type="submit" class="btn btn-default" id="update_acad">Enter</button>
		      </div>
		    </div>

			<?php echo form_close(); ?>
	      </div>
	    </div>
	</div>
 </div>

 <script type="text/javascript">
 	
 	$(document).ready(function(){

 		$("form.update_acad_User").on('submit', function(form){ 
 			/*form dito ay yung element na form natin na yung may class na update_acad_User*/

 			form.preventDefault();
 			$.post('<?php echo site_url();?>'+'academic/changeAdmin', $('form.update_acad_User').serialize(), function (data){

 				$("div.notification").html(data);

 				/*alert(data);*/
 				$("update_acad").disabled();
 				/*alert($("form.update_acad_User").serialize());*/
 			});
 		});
 	});
 </script>