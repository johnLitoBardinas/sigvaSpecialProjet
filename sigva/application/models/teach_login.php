<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Teach_login extends CI_Model{

		var $tab_name = 'teacher_account_tbl';
		var $return;
		function __construct(){

			parent::__construct();
		}


		/*
			+------------------+-------------+
			| Field            | Type        |
			+------------------+-------------+
			| teacher_id       | int(11)     |
			| teacher_username | varchar(50) |
			| teacher_pass     | varchar(50) |
			+------------------+-------------+
		*/

		/* for the login of the teacher*/
		public function validate_teach($usename, $pass){

			/* pit the encruption of pass */
			$data = array(
					'teacher_username' => $usename,
					'teacher_pass' => md5($pass)
				);


			$Q = $this->db->get_where('teacher_account_tbl', $data);

			if ($Q->num_rows() == 1) { 
				
				return TRUE;
				
			}
			else{

				return FALSE;
			}

		}

		/*
			+------------------+-------------+
			| Field            | Type        |
			+------------------+-------------+
			| teacher_id       | int(11)     |
			| teacher_username | varchar(50) |
			| teacher_pass     | varchar(50) |
			+------------------+-------------+
		*/
		public function get_sess_teach_id(){

			$teach_passs = $this->input->post('teach_password');
			$datain = array(

				'teacher_username' => $this->input->post('teach_username'),
				'teacher_pass' => md5($teach_passs),
				);

			
			//here we select just the age column
			$this->db->select('teacher_id');
			$this->db->where($datain);
			$q = $this->db->get($this->tab_name);


			if ($q) {
				
				return $q->result_array();
			}
			else{

				return NULL;
			}
						
		}

		/* check the id of teacher if it is correct*/
		public function chk_teach_id(){

			$process_id = $this->input->post('teacher_id');

			$Q = $this->db->get_where($this->tab_name, array('teacher_id' => $process_id));

			if ($Q->num_rows() == 1) {
				
				return TRUE;
			}
			else{

				return FALSE;
			}
		}

	}