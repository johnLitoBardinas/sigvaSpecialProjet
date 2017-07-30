<?php 

    $this->load->helper('string');

    $id_pt1 = random_string('alnum', 3);

    $id_pt2 = random_string('numeric', 4);

    $f_id = strtoupper($id_pt1) . '-' . $id_pt2;

 ?>

<div class="error"></div>

<!-- titirawon taka nganod mapisti ka -->
<?php echo form_open('', array('class' => 'form-validation', 'id' => 'add_new_rec', 'style' => 'background-color:#b8e4e4')) ?>

        <div class="form-title-row">
            <h1> Student Details </h1>
        </div>

        <input type="hidden" name="stud_grade_code" value="<?php //echo $f_id; ?>"></input>

        <div class="form-row">
        
            <label>
                <span> Access Code </span>
                <input class="reg_myField" type="text" name="stud_grade_code" readonly="true" value="<?php echo $f_id ?>">
            </label>
        
        </div>

        <div class="form-row ">

            <label>
                <span> First Name </span>
                <input class="reg_myField" type="text" name="stud_first" required="true">
            </label>

        </div>


        <div class="form-row">

            <label>
                <span> Last Name </span>
                <input class="reg_myField" type="text" name="stud_last" required="true">
            </label>

        </div>


        <div class="form-row">

            <label>
                <span>Middle Name</span>
                <input class="reg_myField" type="text" name="stud_middle">
            </label>

        </div>

        <div class="form-row">

            <label>
                <span>Status</span>
                <select name="stud_status" class="reg_Drop">
                    <option disabled="true">Choose an option</option>
                    <option value="regular"> Regular </option>
                    <option value="irregular"> Irregular </option>
                    
                </select>
            </label>
        </div>


        <div class="form-row">

            <label>
                <span>Program</span>
                <select name="stud_program" class="reg_Drop">
                    <option value="bsit"> BSIT </option>
                    <option value="bscs"> BSCS </option>
                    <option value="itp"> ITP </option>
                    <option value="hrm"> HRM </option>
                    <option value="hrs"> HRS </option>
                    
                </select>
            </label>
        </div>


        <div class="form-row">

            <label>
                <span> Listed Guardian <i style="font-size: 14px; color:darkcyan"> already</i> </span>
                <select name="listed_guardian" id="listed_guardian" onchange="javascript:guardian_notExist()">
                    
                    <option> none </option>
                    <!--here is the ajax list of avaiblable guardian-->
                    <!-- <option value="1"> Bardinas, Purisima Misola </option> -->


                    <!--$(#listed_guardian).append(out_ajax)-->
                </select>
            </label>
        </div>


    	<div id="guardian_notExist">
    		<!--guardian details-->
            <div class="form-title-row">
                <h1> Guardian Details </h1>
            </div>

            <div class="form-row">

                <label>
                    <span> First Name </span>
                    <input class="reg_myField" type="text" name="guardian_first">
                </label>

            </div>


            <div class="form-row">

                <label>
                    <span> Last Name </span>
                    <input class="reg_myField" type="text" name="guardian_last" >
                </label>

            </div>


            <div class="form-row">

                <label>
                    <span>Middle Name</span>
                    <input class="reg_myField" type="text" name="guardian_middle">
                </label>

            </div>


            <div class="form-row">
                <label>
                    <span> Address </span>
                    <textarea style="text-transform: capitalize !important;" name="guardian_addr" fixed="true" rows="5"></textarea>
                </label>
            </div>

            <div class="form-row ">

                <label>
                    <span>Phone Number</span>
                    <input type="number" name="guardian_num" class="reg_myField">
                </label>

            </div>
        </div><!--guardian_not exist-->

        <div class="form-row">

            <button type="submit" style="cursor: pointer;">Enter Form</button>

        </div>
    <?php echo form_close(); ?> <!--form-->