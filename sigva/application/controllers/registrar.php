<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Registrar extends CI_Controller{


		function __construct(){

			parent::__construct();

			$this->load->model('registrar_login_model','reg_login');
			$this->load->model('registrar_function_models/reg_add_guardian_stud_model','reg_add_records');
			$this->load->model('registrar_function_models/reg_view_subject_schedule','reg_sub_sched_list');
			$this->load->model('registrar_function_models/reg_add_stud_sub_sched_tbl','reg_add_sub_sched');
			$this->load->model('registrar_function_models/reg_change_Acc','reg_changeAcc');
		}


		/* imdex page */
		public function index(){

			$this->session->unset_userdata('reg_id');
			$data['title_page'] = "Registrar | Login";
			$this->load->view('registrar/registrar_login_page', $data);
		}


		/* validating the account of academic */
		public function validate_registrar(){

			$this->form_validation->set_rules('reg_user', 'Username', 'trim|callback_if_exist_Account_reg');
			$this->form_validation->set_rules('reg_pass', 'Password', 'trim');

			$this->form_validation->set_message('if_exist_Account_reg', 'Invalid Username or Password');

			if ($this->form_validation->run()) {

					$this->session->set_userdata('reg_id', 1);
					echo "1";
			}
			else{

				echo "<div>

						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	  					<strong>Warning!</strong>".validation_errors()
					."</div>";
				
			}
		}



		/* registrar home page */
		public function home(){

			$data['title_page'] = "Registrar | Homepage";
			$this->load->view('registrar/home_page', $data);
		}



		/* registrar adding new guardian_student */
		public function validate_guardian_student_data(){

			$Q = $this->reg_add_records->add_new_record();

			//$Q = true;
			if ($Q) {
				
				//echo "Data been inserted :)";
				echo json_encode(array('status' => true));
				
			}
			else{

				//echo "Data has not been inserted :( ";
				echo json_encode(array( 'status' => false));

			}
		}



		/* showing the current list of subject_student*/
		//ajax_list for the teacher
		/*reg_sub_sched_list - model*/
		public function ajax_list_stud_sub_sched(){

		$list = $this->reg_sub_sched_list->get_dTables_sub_sched_list();
		$data = array();
		$no = $_POST['start'];


			/*
					+--------------+--------------+
					| Field        | Type         |
					+--------------+--------------+
					| sub_sched_id | int(11)      |
					| sub_code     | varchar(15)  |
					| sub_desc     | varchar(100) |
					| sub_require  | varchar(15)  |
					| teacher_name | text         |
					| section      | varchar(15)  |
					| room         | varchar(15)  |
					| schedule     | varchar(50)  |
					+--------------+--------------+
			*/

		foreach ($list as $stud_sub_sched) {
			
			$no = $no + 1;

			$row = array();

			$row[] = $stud_sub_sched->sub_code;
			$row[] = $stud_sub_sched->sub_desc;
			//$row[] = $stud_sub_sched->sub_require;
			$row[] = $stud_sub_sched->teacher_name;
			$row[] = $stud_sub_sched->section;
			$row[] = $stud_sub_sched->room;
			$row[] = $stud_sub_sched->schedule;


			$row[] = '<label style="font-size:20px; text-align:center"><input style="width: 40px;height: 40px; margin-left: 12px;" type="checkbox" name="subject_sched_id[]" value="'.$stud_sub_sched->sub_sched_id.'"></label>';

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->reg_sub_sched_list->count_all_sub_sched_list(),
				"recordsFiltered" => $this->reg_sub_sched_list->count_filtered_sub_sched_list(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}


	/* drop box of the student */
	public function ajax_stud_list(){

		$data = $this->reg_sub_sched_list->ajax_select_stud();

		echo json_encode($data);
	}


	/* dropbox for the guardian who listed na*/
	public function out_guardian_list(){

		$data = $this->reg_changeAcc->out_teach_select();

		echo json_encode($data);
	}

	
	/* adding new student subject schedule */
	public function add_stud_sub_sched($stud_id, $subject_sched_id, $sem, $sy){

		$data = array(

			'student_id' => $stud_id,
			'subject_schedule_id' => $subject_sched_id,
			'sem' => $sem,
			'school_year' => $sy
		);
		
		$Q = $this->reg_add_sub_sched->add_new_stud_sub($data);

		//$Q = true;
		if ($Q) {
			
			echo json_encode(array('status' => "saved"));
		}else{

			echo json_encode(array('status' => "not saved"));
		}

	}


	/* function to show the stud_sub_sched_view to the user to show */
	public function out_stud_sub_sched_view(){

		$list = $this->reg_add_sub_sched->out_stud_sub_sched_view();
		$data = array();
		$no = $_POST['start'];


			/*
					mysql> desc stud_sub_sched_view;
					+------------------+--------------+
					| Field            | Type         |
					+------------------+--------------+
					| stud_grade_id    | int(11)      |
					| stud_access_code | varchar(9)   |
					| stud_name        | text         |
					| sub_code         | varchar(15)  |
					| sub_desc         | varchar(100) |
					| teach_name       | text         |
					| sec_name         | varchar(15)  |
					| room_no          | varchar(15)  |
					| sched            | varchar(50)  |
					+------------------+--------------+
			*/

		foreach ($list as $out_stud_sched) {
			
			$no = $no + 1;

			$row = array();

			$row[] = $out_stud_sched->stud_access_code;
			$row[] = $out_stud_sched->stud_name;
			$row[] = $out_stud_sched->sub_code;
			$row[] = $out_stud_sched->sub_desc;
			$row[] = $out_stud_sched->teach_name;
			$row[] = $out_stud_sched->sec_name;
			$row[] = $out_stud_sched->room_no;
			$row[] = $out_stud_sched->sched;


			/*$out_stud_sched->stud_grade_id*/
			$row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete Sir" onclick="delete_stud_sched('."'".$out_stud_sched->stud_grade_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->reg_add_sub_sched->count_all_st_sb_sched(),
				"recordsFiltered" => $this->reg_add_sub_sched->count_filtered_st_sb_sched(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}

	/* deleting stud_schedule*/
	public function del_stud_sched($stud_grade_id){

		$Q = $this->reg_add_sub_sched->del_stud_sched($stud_grade_id);

		if ($Q) {
			
			echo json_encode(array('status' => true));
		}
		else{

			echo json_encode(array('status' => false));
		}
	}



	/* changing the accout of the registrar*/

	public function change_acc_reg(){

		$this->form_validation->set_rules('new_Username_rg', 'Username', 'trim|is_unique[admin_account_tbl.admin_username]');
		$this->form_validation->set_rules('old_pass_rg', 'Old Password', 'trim');
		$this->form_validation->set_rules('new_pass_rg', 'New Password', 'trim|differs[old_pass_rg]');
		$this->form_validation->set_rules('confirm_pass_rg', 'Confirm Password', 'trim|matches[new_pass_rg]');

		$this->form_validation->set_message('is_unique', 'The Username already taken');

		if ($this->form_validation->run()) {
			
			$this->reg_changeAcc->update_reg_acc();
			echo "Successfully Updated";
		}
		else{

			echo '<strong>'.validation_errors().' </strong>';
			/*echo "Not success in validation";*/
		}
	}

/* iframe for the site */

	function iframe_main_reg(){

		$this->load->view('registrar/reg_sections/iframe_main_reg');
	}

	function iframe_student_list(){

		$this->load->view('registrar/reg_sections/iframe_student_list');
	}


	function iframe_register_newStud(){

		$this->load->view('registrar/reg_sections/iframe_main_reg/');
	}


/* custom callback functions here*/
	  function if_exist_Account_reg(){

		$Q = $this->reg_login->if_exist_Account_reg();

		if ($Q) {
			
			return TRUE;
		}
		else{

			return FALSE;
		}
	}



}//class