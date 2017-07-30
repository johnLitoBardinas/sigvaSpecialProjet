<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Reg_add_guardian_stud_model extends CI_Model{

		var $tab_stud ='student_tbl';
		var $tab_guardian ='guardian_tbl';
		var $tab_guardian_stud ='guardian_student_tbl';


		function __construct(){

			parent::__construct();
		}

		/* return the last query id generated */
		private function add_stud_rec(){

			/* getting the key at the POST array */
			$stud_code = $this->input->post('stud_grade_code');
			$stud_Lname = $this->input->post('stud_last');
			$stud_Fname = $this->input->post('stud_first');
			$stud_Mname = $this->input->post('stud_middle');
			$stud_Status = $this->input->post('stud_status');
			//$stud_Term = $this->input->post('stud_sY_year');
			$stud_Program = $this->input->post('stud_program');

				/*

	------------------------+-----------------------------
	 Field                  | Type
	------------------------+-----------------------------
	 student_id             | int(11)
	 stud_access_grade_code | varchar(9)
	 stud_lname             | tinytext
	 stud_fname             | tinytext
	 stud_mname             | tinytext
	 status                 | enum('regular','irregular')
	 term                   | varchar(15)
	 program                | char(10)
	------------------------+-----------------------------
				*/
			$data = array(

				'stud_access_grade_code' => $stud_code,
				'stud_lname' => $stud_Lname,
				'stud_fname' => $stud_Fname,
				'stud_mname' => $stud_Mname,
				'stud_status' => $stud_Status,
				'program' => $stud_Program,
				);

			
			$Q = $this->db->insert($this->tab_stud, $data);

			if ($Q) {
				
				return $this->db->insert_id();
			}
			else{

				return FALSE;
			}
		}

		/* same here*/
		private function add_guardian_rec(){

			/*
			+------------------+--------------+
			| Field            | Type         |
			+------------------+--------------+
			| guardian_id      | int(11)      |
			| guardian_lname   | tinytext     |
			| guardian_fname   | tinytext     |
			| guardian_mname   | tinytext     |
			| guardian_address | varchar(100) |
			| phone_number     | char(11)     |
			+------------------+--------------+
			*/

			$data = array(

				'guardian_lname' => $this->input->post('guardian_last'),
				'guardian_fname' => $this->input->post('guardian_first'),
				'guardian_mname' => $this->input->post('guardian_middle'),
				'guardian_address' => $this->input->post('guardian_addr'),
				'phone_number'=> $this->input->post('guardian_num')
			);
			

			$Q = $this->db->insert($this->tab_guardian, $data);

			if ($Q) {
				
				return $this->db->insert_id();
			}
			else{

				return FALSE;
			}
		}


		/* insert the 2 ids generated at the private and add it at the guardian_student_tb*/
		public function add_new_record(){

			$listed = $this->input->post('listed_guardian');

			if ($listed === "none") {
				
				$stud_rec_id = $this->add_stud_rec();
				$guardian_rec_id = $this->add_guardian_rec();

				/*
					+---------------------+---------+
					| Field               | Type    |
					+---------------------+---------+
					| guardian_student_id | int(11) |
					| guardian_id         | int(11) |
					| student_id          | int(11) |
					+---------------------+---------+
				*/

				$data = array(

					'guardian_id' => $guardian_rec_id,
					'student_id' => $stud_rec_id
					);

				$Q = $this->db->insert($this->tab_guardian_stud, $data);

				if ($Q) {
					
					return TRUE;
				}
				else{

					return FALSE;
				} // inner if_else

			}
			else{

				$stud_rec_id_exist = $this->add_stud_rec();
				$guardian_rec_id = $listed;


				$data_exist = array(

					'guardian_id' => $guardian_rec_id,
					'student_id' => $stud_rec_id_exist
					);

				$Q = $this->db->insert($this->tab_guardian_stud, $data_exist);

				if ($Q) {
					
					return TRUE;
				}
				else{

					return FALSE;
				}
			}
		}

	} // class