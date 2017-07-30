<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Teach_acc_reg extends CI_Model{

		function __construct(){

			parent::__construct();
		}


		/*
			mysql> desc teacher_account_tbl;
			+------------------+-------------+
			| Field            | Type        |
			+------------------+-------------+
			| teacher_id       | int(11)     |
			| teacher_username | varchar(50) |
			| teacher_pass     | varchar(50) |
			+------------------+-------------+
		*/
		public function create_Acc(){

			#var to process
			$teacher_id = $this->input->post('teacher_id');
			$teacher_username = $this->input->post('username');
			$pass = $this->input->post('c_pass');
			$teacher_pass = md5($pass);

			$data = array(

				'teacher_id' => $teacher_id,
				'teacher_username' => $teacher_username,
				'teacher_pass' => $teacher_pass
				);


			$Q = $this->db->insert('teacher_account_tbl', $data);

			if ($Q) {

				// change the teacher_tbl to be y
				$this->db->where('teacher_id', $teacher_id);
				$X = $this->db->update('teacher_tbl',array('teach_account' => 'y'));

				if ($X) {
					
					return TRUE;
				}
				else{

					return FALSE;
				}

			}
			
		}
	}// class