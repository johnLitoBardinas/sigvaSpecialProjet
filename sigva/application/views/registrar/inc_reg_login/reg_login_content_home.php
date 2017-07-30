<div class="content row" style="margin-top: 12%">
		
		<section class="main col-lg-4 col-md-6 col-sm-4">
			<div class="form-group">

			<h1 style='font-size: 27px;font-family: Segoe UI;
    font-weight: bold;'> SIGVA <span> -registrar- </span></h1>
				
				<div class="error"></div>


				<?php 
					echo form_open('', array('id' => 'toRegistrar'));

				?>
				
				
				<input placeholder="Username" class="form-control input-lg" type="text" name="reg_user" required="true" id="reg_user" style="margin-bottom: 2%">

				 
				<input placeholder="Password" class="form-control input-lg" type="password" name="reg_pass" required="true" id="reg_pass" style="margin-bottom: 2%">

				<input class="btn btn-primary btn-lg" type="submit" value="Login" style="margin-left: 78%">
				<?php echo form_close(); ?>	
					
				 	
			</div>

		</section><!--login_e-->

		<section class=" sidebar col-lg-8 col-md-6 col-sm-8" style="line-spacing: 6%">
			
			<!--pre-->
			<p style="text-align: left"> The registrar is used for
			</p>
			<dl align="left">
				<dt> Student </dt>
				<dd> - Registered new Student</dd>
				<dd> - Update Student Subject's Schedule</dd>
				<dd> - Delete Student </dd>
				<dd> - School Grades Peripheral </dd>
			</dl>
		</section>
		
</div><!--content_row-->