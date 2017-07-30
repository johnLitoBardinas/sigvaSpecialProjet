<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Send_grades extends CI_Controller{

		function __construct(){

			parent::__construct();

			$this->load->model('text_models/sigva_text_blast', 'this_model');
		}

		private function die_r($inArr){

			echo "<pre>";

				print_r($inArr);
			echo "</pre>";

			die();
		}
	/*

		make the text blast by. subject the sample subject.
		1. create the model
		2. create the controller 

		3. finalize the view
	*/


	/* 
		then so magiging logs niya kung baga file nalang sa e application ko sari raw pwedi yan na i butang
	*/
	 
	public function index(){

		$this->load->view('send_grades/main_page');
		
	}

	/* all data in the stud_page_grades_summary*/
	public function ajax_get_subjects_all(){

		$S = $this->this_model->get_Grades_Send();

		echo json_encode($S);
	}

	public function ajax_get_select_subject(){

		$Q = $this->this_model->get_Select_Subject();

		echo json_encode($Q);
	}

	/* the text blast for the chikka*/
	public function text_Blast(){

		/* this one line make the text blast of sigva(registrar)*/
		$Q = $this->this_model->send_Text_Grades();

		//$Q = true;
		//if ($Q) {
			
			echo json_encode(array('status' => true));
		/*}
		else {

			echo json_encode(array('status' => false));
		}*/
	}


	/* for saving the logs by their subjects */
	public function save_textBlast_Logs($sub_name){

		$Q = $this->this_model->insert_newSendLogs($sub_name);

		if ($Q) {
			
			return json_encode(array('status' => true));
		}
		else{

			return json_encode(array('status' => false));
		}
	}

}