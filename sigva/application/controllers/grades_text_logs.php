<?php 
defined('BASEPATH') OR exit('No direct script access allowed');


	class Grades_text_logs extends CI_Controller{

		// magic construction
		function __construct(){

			parent::__construct();

			$this->load->model('text_models/grades_txt_logs', 'this_model');
		}

	// loading the main view for the part
	public function index(){

		$this->load->view('text_logs/grades_logs_main');
	}


	// the function to be sent via ajax
	public function ajax_list_send_grades_logs(){

		$list = $this->this_model->get_dTables_send_grades_logs();
		$data = array();
		$no = $_POST['start'];

		foreach ($list as $logs) {
			
			$no = $no + 1;

			$row = array();

			$row[] = $logs->sended_dateTime;
			$row[] = $logs->subject_name;
			$row[] = $logs->sem;
			$row[] = $logs->school_year;

			$data[] = $row;

		}//e_f_each

		$output = array(

				"draw" => $_POST['draw'],//key at the array POST name draw
				"recordsTotal" => $this->this_model->count_all_send_grades_logs(),
				"recordsFiltered" => $this->this_model->count_filtered_send_grades_logs(),
				"data" => $data
			);

		echo json_encode($output); // encode the given array to JSON formatted String
	}//e()


}// e_class