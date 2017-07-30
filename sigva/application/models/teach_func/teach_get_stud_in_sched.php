<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Teach_get_stud_in_sched extends CI_Model{

		function __construct(){

			parent::__construct();
		}



	/* get the sub_code, sub_name, num_of_student */
	public function get_stud_list_in_sched($sched_id){

		$sql = "call sproc_stud_grade_sched({$sched_id})";
		$Q = $this->db->query($sql);

		if ($Q) {
			
			return $Q->result();
		}
		else{

			return NULL;
		}


	}


}// class