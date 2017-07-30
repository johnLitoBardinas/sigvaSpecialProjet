<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Stud_page_get_pdf_grades extends CI_Model{

		var $view_name = 'stud_page_grades_summary';
		function __construct(){

			parent::__construct();
		}

		public function get_grades_pdf(){

			$access_code = $this->session->userdata('stud_access_code');

			$condition = array(
				'grade_code' => $access_code,
				'sem' => '1st',
				'school_year' => '2016-2017'
				);
			
			$Q = $this->db->get_where($this->view_name, $condition);

			if ($Q) {
				
				return $Q->result();
			}
			else{

				return NULL;
			}

		}

	}