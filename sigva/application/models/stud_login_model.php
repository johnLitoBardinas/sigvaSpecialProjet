<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Stud_login_model extends CI_Model{

		var $tab_name = 'student_tbl';
		function __construct(){

			parent::__construct();
		}

		/*

			kuonon ko na muna so id 

			tas pag kaka kuku ko.. 
		*/
		public function validate_stud($stud_code){

			$Q = $this->db->get_where('student_tbl', array('stud_access_grade_code' => $stud_code));

			if ($Q->num_rows() == 1) {
				
				return TRUE;
			}
			else{

				return FALSE;
			}

		}
	}// end class