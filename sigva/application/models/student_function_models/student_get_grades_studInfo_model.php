<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	/* this class is for returning the information of the student based on their unique access_code */
	class Student_get_grades_studInfo_model extends CI_Model{

		var $tab_name = 'stud_page_stud_grades';
		
		function __construct(){

			parent::__construct();
		}/* constructor */

		public function student_article_grades(){

			$access_code = $this->session->userdata('stud_access_code');

			/* pitfall = array('' => '')*/

			$sql = "CALL sproc_get_stud_grade_info(?)";

			$Q = $this->db->query($sql, array('grade_code' => $access_code));
			//$Q = $this->db->get_where($this->tab_name, array('grade_code' => $acess_code));

			if ($Q) {
				
				return $Q->result();
			}
			else{

				return NULL;
			}

		}// student_article_grades()

	}