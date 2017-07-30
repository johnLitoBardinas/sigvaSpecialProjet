<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Academic extends CI_Controller {

	function __construct(){

		parent::__construct();

		
		$this->load->model('acad_logIn', 'acd_l');
		$this->load->model('acad_function_models/acad_change_Acc', 'acd_func');
		$this->load->model('acad_function_models/acad_subjects', 'acd_subject');
		$this->load->model('acad_function_models/acad_teachers', 'acd_teacher');
		$this->load->model('acad_function_models/acad_sections', 'acd_section');
		$this->load->model('acad_function_models/acad_teach_subject', 'acd_teach_sub');
		$this->load->model('acad_function_models/acad_sub_sched', 'acd_sub_sched');

	}

	/* login page */	
	public function index(){
		/*$this->session->sess_destroy();*/ // destroy dapat buksan mo utro ahh browser mo

		/*$this->session->unset_userdata('acad_id');*/

		//$data['title_page'] = " Academic | Login";
		//$this->load->view('acad/login_page_acad', $data);

		//$this->load->view('acad/f_main_page');
	}

	/*ajax_validate_acount*/
	public function validate_acad(){

		$this->form_validation->set_rules('acad_user', 'Username', 'trim|callback_validAccount');
		$this->form_validation->set_rules('acad_pass', 'Password', 'trim');

		$this->form_validation->set_message('validAccount', 'Invalid Username or Password');

		if (! $this->input->is_ajax_request()) {

			exit('Request not Found');
		}
		
		if ($this->form_validation->run()) {

				echo "1";
		}
		else{

			echo "<div>
					<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  					<strong>Warning!</strong>".validation_errors()
				."</div>";
			
		}

	}

	/*home page*/
	public function home(){

		$data['title_page'] ="Academic | Home";
		$data['acad'] = $this->acd_func->get_acadInfo();
		$this->load->view('acad/home_page', $data);
	}//e_home

	//ajax_changeAdmin
	public function changeAdmin(){

		$this->form_validation->set_rules('new_Username', 'Username', 'trim|is_unique[admin_account_tbl.admin_username]');
		$this->form_validation->set_rules('old_pass', 'Old Password', 'trim');
		$this->form_validation->set_rules('new_pass', 'New Password', 'trim|differs[old_pass]');
		$this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'trim|matches[new_pass]');

		$this->form_validation->set_message('is_unique', 'The Username already taken');

		if ($this->form_validation->run()) {
			
			$this->acd_func->change_acad_data();
			echo "Successfully Updated";
		}
		else{

			echo "<div>".validation_errors()."</div>";
			/*echo "Not success in validation";*/
		}

	}//e_()



/*
	These set of functions are for the Subject panel
*/
// subject datatables
	public function ajax_list(){

		$list = $this->acd_subject->get_dTables();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $subjects) {
			
			$no = $no + 1;

			$row = array();

			$row[] = $subjects->subject_code;
			$row[] = $subjects->subject_description;
			$row[] = $subjects->subject_units;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_subject('."'".$subjects->subject_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete Sir" onclick="delete_subject('."'".$subjects->subject_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],
				"recordsTotal" => $this->acd_subject->count_all(),
				"recordsFiltered" => $this->acd_subject->count_filtered(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}

	//ajax_edit_subject
	public function ajax_edit_sub($subject_id){

		$data = $this->acd_subject->get_by_id($subject_id);
		echo json_encode($data); // change the data to a json formatted string to be parse inthe javascript using he JSON.parse(mthod_to_response)
	}

	//ajax_add_subj
	public function ajax_add_subject(){

		$data = array(

			'subject_code' => $this->input->post('subject_code'),
			'subject_description' => $this->input->post('subject_description'),
			'subject_units' => $this->input->post('subject_units')
			);

		$insert = $this->acd_subject->save($data);
		echo json_encode(array("status" => TRUE)); // pag json dapat naka "" bukong ''
	}


	//ajax_final_update_subj
	public function ajax_update_subject(){

		$data = array(

			'subject_code' => $this->input->post('subject_code'),
			'subject_description' => $this->input->post('subject_description'),
			'subject_units' => $this->input->post('subject_units')
			);

		$subject_id = $this->input->post('subject_id');
		/*$data*/
		$this->acd_subject->update(array('subject_id' => $subject_id), $data);

		echo json_encode(array("status" => TRUE));
	}

	//ajax_delete_subj
	public function ajax_delete_subject($subject_id){

		$this->acd_subject->del_by_id($subject_id);

		echo json_encode(array("status" => TRUE));
	}
//end subject panel


/*
	These set of functions are for the School teacher panel

	acd_teacher - model


	new function 

	1. get_dataTable_q = query to get data from the database

	2. get_dTables_teach = function to get all data from the database to show in the dtable

	3. count_filtered_teach = get the number of rows that the 1 q executed

	4. count_all_teach = count all the resulted data from query 1 

	5. get_by_id_teach = getting the row of teacher by its id

	6. save_teach = saving the new row of teacher in the table

	7. update_teach = update the teacher row by its id as argument

	8. del_by_id_teach = deleting the teacher by its id



	mysql> describe teacher_tbl;
	+---------------+---------------+------+-----+---------+----------------+
	| Field         | Type          | Null | Key | Default | Extra          |
	+---------------+---------------+------+-----+---------+----------------+
	| teacher_id    | int(11)       | NO   | PRI | NULL    | auto_increment |
	| teacher_lname | tinytext      | NO   |     | NULL    |                |
	| teacher_fname | tinytext      | NO   |     | NULL    |                |
	| teacher_mname | tinytext      | YES  |     | NULL    |                |
	| teach_account | enum('y','n') | YES  |     | n       |                |
	+---------------+---------------+------+-----+---------+----------------+
*/


 //ajax_list for the teacher
	public function ajax_list_teach(){

		$list = $this->acd_teacher->get_dTables_teach();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $teachers) {
			
			$no = $no + 1;

			$row = array();

			$row[] = $teachers->teacher_id;
			$row[] = $teachers->teacher_lname;
			$row[] = $teachers->teacher_fname;
			$row[] = $teachers->teacher_mname;
			$row[] = $teachers->teach_account;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_teacher('."'".$teachers->teacher_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete Sir" onclick="delete_teacher('."'".$teachers->teacher_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],
				"recordsTotal" => $this->acd_teacher->count_all_teach(),
				"recordsFiltered" => $this->acd_teacher->count_filtered_teach(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}

	//ajax_edit_teach
	public function ajax_edit_teach($teacher_id){

		$data = $this->acd_teacher->get_by_id_teach($teacher_id);
		echo json_encode($data); // change the data to a json formatted string to be parse inthe javascript using he JSON.parse(mthod_to_response)
	}


	//ajax_add_teach
	public function ajax_add_teach(){

		$data = array(

			'teacher_lname' => $this->input->post('teacher_lname'),
			'teacher_fname' => $this->input->post('teacher_fname'),
			'teacher_mname' => $this->input->post('teacher_mname'),
			);

		$insert = $this->acd_teacher->save_teach($data);
		echo json_encode(array("status" => TRUE)); // pag json dapat naka "" bukong ''
	}


	//ajax_final_update_subj
	public function ajax_update_teach(){

		$data = array(

			'teacher_lname' => $this->input->post('teacher_lname'),
			'teacher_fname' => $this->input->post('teacher_fname'),
			'teacher_mname' => $this->input->post('teacher_mname'),
			);

		$teacher_id = $this->input->post('teacher_id');
		/*$data*/
		$this->acd_teacher->update_teach(array('teacher_id' => $teacher_id), $data);

		echo json_encode(array("status" => TRUE));
	}


	//ajax_delete_teach
	public function ajax_delete_teach($teacher_id){

		$this->acd_teacher->del_by_id_teach($teacher_id);

		echo json_encode(array("status" => TRUE));
	}
//end teacher panel


/* The set of function will be at the section panel

	_sec = unique extension for this model
	acd_section = model class
*/

	//ajax_list for the teacher
	public function ajax_list_sec(){

		$list = $this->acd_section->get_dTables_sec();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $sections) {
			
			$no = $no + 1;

			$row = array();

			$row[] = $sections->section_name;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_section('."'".$sections->section_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete Sir" onclick="delete_section('."'".$sections->section_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->acd_section->count_all_sec(),
				"recordsFiltered" => $this->acd_section->count_filtered_sec(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}


	/* getting the row*/
	public function ajax_edit_sec($section_id){

		$data = $this->acd_section->get_by_id_sec($section_id);
		echo json_encode($data); // change the data to a json formatted string to be parse inthe javascript using he JSON.parse(mthod_to_response)
	}


	/* adding new section */
	public function ajax_add_sec(){

		$data = array(

			'section_name' => $this->input->post('section_name'),
			);

		$insert = $this->acd_section->save_sec($data);
		echo json_encode(array("status" => TRUE)); // pag json dapat naka "" bukong ''
	}


	/*updating existing data in dtable*/
	public function ajax_update_sec(){

		$data = array(

			'section_name' => $this->input->post('section_name'),
			);

		$section_id = $this->input->post('section_id');
		/*$data*/
		$this->acd_section->update_sec(array('section_id' => $section_id), $data);

		echo json_encode(array("status" => TRUE));
	}


	/* deleting section row by its id*/
	public function ajax_delete_sec($section_id){

		$this->acd_section->del_by_id_sec($section_id);

		echo json_encode(array("status" => TRUE));
	}
//end of section panel


/* 

	The following methods are for the teacher_subject panel
*/


	/* getting data to put in the data table for teach_subject*/
	public function ajax_list_teach_sub(){

		$list = $this->acd_teach_sub->get_dTables_teach_sub();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $teacher_subjects) {
			
			$no = $no + 1;

			$row = array();

			$row[] = $teacher_subjects->teacher_lname;
			$row[] = $teacher_subjects->teacher_fname;
			$row[] = $teacher_subjects->subject_code;
			$row[] = $teacher_subjects->subject_description;

			$row[] = '
				  <a class="btn btn-sm btn-danger" style="width:100%"href="javascript:void(0)" title="Delete Sir" onclick="delete_teacher_subject('."'".$teacher_subjects->teacher_subject_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->acd_teach_sub->count_all_teach_sub(),
				"recordsFiltered" => $this->acd_teach_sub->count_filtered_teach_sub(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}


	/* getting the available subjects */
	public function ajax_out_list_sub(){

		$data = $this->acd_teach_sub->get_subjects();

		echo json_encode($data); // return a json formatted string
	}


	/* getting the available teachers */
	public function ajax_out_list_teach(){

		$data = $this->acd_teach_sub->get_teachers();

		echo json_encode($data);
	}


	/* adding new foreign key at the teacher_subject tbl not view */
	public function ajax_add_teach_sub(){

		$data = array(

			'teacher_id' => $this->input->post('teacher_id'),
			'subject_id' => $this->input->post('subject_id'),
			);

		$insert = $this->acd_teach_sub->save_teach_sub($data);
		echo json_encode(array("status" => TRUE)); // pag json dapat naka "" bukong ''
	}



	/* deleting the teacher_subject*/
	public function ajax_delete_teach_sub($teacher_subject_id){

		$this->acd_teach_sub->del_by_id_teach_sub($teacher_subject_id);

		echo json_encode(array("status" => TRUE));
	}



/*

	the following function will be at the subject_schedule panel
*/

	public function ajax_list_sub_sched(){

		$list = $this->acd_sub_sched->get_dTables_sub_sched();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $subject_schedules) {
			
			$no = $no + 1;

			$row = array();

			/*
				mysql> describe subject_schedule_view;
				+---------------------+--------------+------+-----+---------+-------+
				| Field               | Type         | Null | Key | Default | Extra |
				+---------------------+--------------+------+-----+---------+-------+
				| subject_schedule_id | int(11)      | NO   |     | 0       |       |
				| subject_code        | varchar(15)  | NO   |     | NULL    |       |
				| TeacherName         | varchar(511) | NO   |     |         |       |
				| section_name        | varchar(15)  | NO   |     | NULL    |       |
				| room                | varchar(15)  | NO   |     | NULL    |       |
				| date_time           | varchar(20)  | NO   |     | NULL    |       |
				+---------------------+--------------+------+-----+---------+-------+
			*/

			$row[] = $subject_schedules->subject_code;
			$row[] = $subject_schedules->TeacherName;
			$row[] = $subject_schedules->section_name;
			$row[] = $subject_schedules->room;
			$row[] = $subject_schedules->date_time;

			$row[] = '<a class="btn btn-sm btn-primary""href="javascript:void(0)" title="Edit" onclick="edit_sub_sched('."'".$subject_schedules->subject_schedule_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete Sir" onclick="delete_subject_schedule('."'".$subject_schedules->subject_schedule_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->acd_sub_sched->count_all_sub_sched(),
				"recordsFiltered" => $this->acd_sub_sched->count_filtered_sub_sched(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}



	/* out the list of teacher subjects */
	public function out_list_teach_sub(){

		$data = $this->acd_sub_sched->sproc_teach_sub();

		echo json_encode($data);
	}


	/* return the list of available sections */
	public function out_list_sec(){

		$data = $this->acd_sub_sched->sec_list_select();

		echo json_encode($data);
	}


	/* adding new row in subject_schedule*/
	public function ajax_add_sub_sched(){

		$data = array(

				'teacher_subject_id' => $this->input->post('teacher_subject_id'),
				'section_id' => $this->input->post('section_id'),
				'room' => $this->input->post('room'),
				'date_time' => $this->input->post('date_time')

			);

		$insert = $this->acd_sub_sched->save_sub_sched($data);

		echo json_encode(array('status' => true));
	}



	/* deleting row in the subject_schedule */
	public function ajax_delete_sub_sched($subject_schedule_id){

		$this->acd_sub_sched->del_by_id_sub_sched($subject_schedule_id);

		echo json_encode(array("status" => TRUE));
	}



	/* editing the subject_schedule */

	/*
	
		changable 
			* section
			* room
			* date & time 

	*/
	public function ajax_edit_sub_sched($subject_schedule_id){

		$data = $this->acd_sub_sched->get_by_id_sub_sched($subject_schedule_id);
		echo json_encode($data); // change the data to a json formatted string to be parse inthe javascript using he JSON.parse(mthod_to_response)
	}

	/*updating existing data in dtable*/
	public function ajax_update_sub_sched(){

		$data = array(

				'teacher_subject_id' => $this->input->post('v_teacher_subject_id'),
				'section_id' => $this->input->post('v_section_id'),
				'room' => $this->input->post('v_room'),
				'date_time' => $this->input->post('date_time')

			);

		$subject_schedule_id = $this->input->post('v_subject_schedule_id');
		/*$data*/
		$this->acd_sub_sched->update_sub_sched(array('subject_schedule_id' => $subject_schedule_id), $data);

		echo json_encode(array("status" => TRUE));
	}



	
//iframe of panel section
	/*change account*/
	function iframe_changeAcc(){

		$this->load->view('acad/functions_acad/changeAcc');
	}


	/* subject panel*/
	function iframe_subject_section(){

		$this->load->view('acad/functions_acad/subject_section');
	}


	/* teacher panel*/
	function iframe_teacher_section(){

		$this->load->view('acad/functions_acad/teacher_section');
	}


	/* section panel*/
	function iframe_section_section(){

		$this->load->view('acad/functions_acad/sec_section');
	}


	/* teacher_subject panel*/
	function iframe_teacher_subject(){

		$this->load->view('acad/functions_acad/teach_sub_section');
	}


	/* subject_schedule panel*/
	function iframe_subject_schedule(){

		$this->load->view('acad/functions_acad/sub_sched_section');
	}





// custom callback function 
	function validAccount(){

		$Q = $this->acd_l->if_exist_Account();

		if ($Q) {
			
			return TRUE;
		}
		else{

			return FALSE;
		}

	}// e_callback

}