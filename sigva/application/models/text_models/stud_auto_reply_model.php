<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Stud_auto_reply_model extends CI_Model{

		function __construct(){

			parent::__construct();

			$this->load->library('ChikkaSMS');
		}

	public function get_stud_grade_auRep($acess_code, $sem, $school_year){

		$sql = "call sproc_auto_reply_grade(?, ?, ?)";

		$condition = array(

				'grade_code' => $acess_code,
				'sem' => $sem,
				'school_year' => $school_year
			);

		$Q = $this->db->query($sql, $condition);

		if ($Q) {
			
			return $Q->result();
		}
		else{

			return NULL;
		}
		
	}

} // e_class