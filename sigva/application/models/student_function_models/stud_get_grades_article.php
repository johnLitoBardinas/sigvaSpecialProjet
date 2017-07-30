<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Stud_get_grades_article extends CI_Model{

		function __construct(){

			/* class constructor */
			parent::__construct();
		}

		public function get_stud_articles_grades(){

			/* get the session access_code of the student*/
			$access_code = $this->session->userdata('stud_access_code');

			/* communicate at the database for the output to be process in the constroller */

			$sql = "call sproc_get_stud_article_grades(?)";

			$Q = $this->db->query($sql, array('grade_code' => $access_code));

			if ($Q) {
				
				return $Q->result();
			}
			else{

				return NULL;
			}

		}

	}//e_class