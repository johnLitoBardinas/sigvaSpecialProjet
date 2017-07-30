<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Teacher extends CI_Controller
{

		/* constructor of the class*/
		function __construct(){

			parent::__construct();
			/* models will be loaded here */
			$this->load->model('teach_login', 'teach_lgn');
			$this->load->model('teacher_acc/teach_acc_reg', 'teach_Acc');
			$this->load->model('teacher_acc/get_teach_acc', 'teach_F');

		}



	/* login page for the teacher */
	public function index(){

		$this->session->unset_userdata('teach_id');
		$data['title_page'] = 'Teacher | Login';
		$this->load->view('teach/login_teach', $data);
	}



	public function val_teach_login(){


		/* pitfall always check the field to match the validation*/
		$this->form_validation->set_rules('teach_username', 'Usename', 'trim|callback_validate_teach');
		$this->form_validation->set_rules('teach_password', 'Password', 'trim');


		$this->form_validation->set_message('validate_teach', 'Invalid Username or Password');


		if ($this->form_validation->run()) {
			
			$id = $this->teach_lgn->get_sess_teach_id();

			$this->session->set_userdata('teach_id', $id[0]['teacher_id']);

			echo json_encode(array('status' => true));

		}
		else{

			echo json_encode(array('status' => false));
		}
	}



	/* registering new teacher */
	public function teacher_registration(){

		$data['title_page'] = 'Teacher | Registration';
		$this->load->view('teach/reg_teach', $data);

		/* here is the validation to the form submitted in creating the new teacher_account_tbl;*/

	}



	public function val_reg_teach(){

		/* call back na kung agko na account a id di na pweding ma gibuwan utro*/
		$this->form_validation->set_rules('teacher_id', 'Teacher ID', 'trim|numeric|max_length[25]|callback_chk_teach_id|is_unique[teacher_account_tbl.teacher_id]');
		$this->form_validation->set_rules('username', 'Username', 'trim|alpha_numeric|max_length[100]');
		$this->form_validation->set_rules('pass', 'Password', 'trim');
		$this->form_validation->set_rules('c_pass', 'Confirm Password', 'trim|matches[pass]');

		$this->form_validation->set_message('chk_teach_id', 'Invalid ID');
		$con = $this->form_validation->run();
		if ($con) {
			
			// model inserting the teacher_account to the database
			$Q = $this->teach_Acc->create_Acc();

			if ($Q) {
				echo json_encode(array('status' => true));
			}

			
		}
		else{

			echo json_encode(array('status' => false));
			#echo validation_errors();
		}
	}



	/* home page of the teacher */
	public function home(){

		# this will  be the home of the teacher this session is now global
		$data['title_page'] ='Teacher| Home';
		$id = $this->session->userdata('teach_id');

		if ($id != 0) {

			$data['teach_dat'] = $this->teach_F->get_teach_dat($id);
			$this->load->view('teach/teach_home', $data);
		}
		else{

			redirect(site_url('teacher'));
		}
		
	}



	/*ajax_teach_sched_data_table*/
	public function ajx_teacher_sched(){
		
		// here will be calling the methods in the get_teach_sched_dat
		$this->load->model('teacher_acc/get_teach_sched_dat', 't_sched');

		$list = $this->t_sched->get_dTables_t_sub_sched();
		$data = array();
		$no = $_POST['start'];


		/*

		mysql> desc teach_sched_vie
		+-----------+-------------+
		| Field     | Type        |
		+-----------+-------------+
		| teach_id  | int(11)     |
		| sched_id  | int(11)     |
		| sec_name  | varchar(15) |
		| sub_code  | varchar(15) |
		| room      | varchar(15) |
		| date_time | varchar(50) |
			
		*/
		foreach ($list as $t_sub_sched) {
			
			$no = $no + 1;

			$row = array();

			$row[] = $t_sub_sched->sec_name;
			$row[] = $t_sub_sched->sub_code;
			$row[] = $t_sub_sched->room;
			$row[] = $t_sub_sched->date_time;

			$row[] = '<a class="btn btn-sm btn-success alignCnt" href="javascript:void(0)" title="View Student" onclick="view_students('."'".$t_sub_sched->sched_id."'".')"><i class="glyphicon glyphicon-record"></i> Students </a>';

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->t_sched->count_all_t_sub_sched(),
				"recordsFiltered" => $this->t_sched->count_filtered_t_sub_sched(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}



	/* ajax_get_teach_sub */
	public function ajx_get_tSub(){

		$this->load->model('teacher_acc/get_teach_sub', 't_sub');

		$list = $this->t_sub->get_dTables_t_sub();
		$data = array();
		$no = $_POST['start'];


		foreach ($list as $t_subject) {
			
			$no = $no + 1;

			$row = array();

			$row[] = $t_subject->sub_code;
			$row[] = $t_subject->sub_decs;

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->t_sub->count_all_t_sub(),
				"recordsFiltered" => $this->t_sub->count_filtered_t_sub(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}


/*here*/
	/* function to show the list of student in the schedule */
	public function shw_stud_inSched($sched_id){

		$this->session->set_userdata('c_sched_id', $sched_id);
		$this->load->model('teach_func/teach_get_stud_in_sched', 't_sched_model');	

		$data['sched_dat'] = $Q = $this->t_sched_model->get_stud_list_in_sched($sched_id);


		//echo $data['stud_num'] = $Q[0]['num_stud'] . "<br>";

		//print_r($Q);

		$data['title_page'] = 'STUDENT LIST';
		$this->load->view('teach/teach_functions/view_stud_to_grade', $data);


	}


	/* ajax get the student to grade auto table*/
	/* ajax ready json format */
	public function ajax_get_student_grades(){
		$this->load->model('teach_func/auto_save_tbl', 'this_model');
		$c_sched_id = $this->session->userdata('c_sched_id');
		
		$Q = $this->this_model->ajax_get_student_grades($c_sched_id);
		//$Q = $this->this_model->ajax_get_student_grades();

		$outPut = array();
		foreach ($Q as $row) {
			
			$data['grade_id'] = $row->grade_id;

			$data['stud_name'] = $row->stud_name;
			$data['pr_g'] = $row->pr_g;
			$data['md_g'] = $row->md_g;
			$data['pf_g'] = $row->pf_g;
			$data['f_g'] = $row->f_g;
			$data['sub_g'] = $row->sub_g;
			$data['eq'] = $row->eq;
			$data['remarks'] = $row->remarks;

			//$outPut = $data;
			array_push($outPut, $data);

		}
		echo json_encode($outPut);
	}

	/* this is auto table to grade student */
	public function post_Table_data(){
		$this->load->model('teach_func/auto_save_tbl', 'this_model');

		$Q = $this->this_model->auto_update();
		
		if ($Q) {
			
			echo "Student_grade_updated! :)";
		}

	}


// callback function for the login_teacher
	/* checking if the id exist */
	function chk_teach_id(){

		$Q = $this->teach_lgn->chk_teach_id();

		if ($Q) {
			
			return FALSE;
		}
		else{

			return TRUE;
		}

	}

	/* validdating the teacher_acc*/
	function validate_teach(){

		$username = $this->input->post('teach_username');
		$pass = $this->input->post('teach_password');
		/* these will be the hoe page of teacher*/
		$Q = $this->teach_lgn->validate_teach($username, $pass);

		if ($Q) {
			
			return TRUE;
		}
		else{

			return FALSE;
		}
	}

	
}//class


/* 

	for the SP. this is good but not enough more room to improve 

	:) = 9-17-2016
*/