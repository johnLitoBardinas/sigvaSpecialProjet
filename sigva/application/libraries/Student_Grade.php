<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Student_Grade{

		// member variables

		var $c;
		var $stud_grade = array();


		// constructor
		function Student_Grade(){

			if ( ! class_exists('Student_Grade'))
	        {
	            require_once(APPPATH.'libraries/Student_Grade'.EXT);
	        }
	        else{
	        	$this->c = new Student_Grade();
	        }
	        
		}

		// member functions


		// mutators
		function set_Grade($stud_grade_dat){

			foreach ($stud_grade_dat as $row => $val) {
				
				$stud_grade[] = $val; 
			}

		}

		// accessor
		function get_Grade(){

			return $stud_grade;
		}
	}// class