<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	class Auto_save_tbl extends CI_Model{

		protected $tab_edit = 'student_grade_tbl';

		function __construct(){

			parent::__construct();
		}
	public function auto_update(){

		$json = $this->input->post('out_put');

		$lenght = strlen($json);
		substr($json, 1, $lenght-1);
		$obj_json = json_decode($json);

		foreach ($obj_json as $row) {
			
		$where = "student_grade_id = ". $row->grade_id;

		$set = array(

				'prelim_grade' => $row->pr_g,
				'midterm_grade' => $row->md_g,
				'pre_finals_grade' => $row->pf_g,
				'finals_grade' => $row->f_g,
				'subject_grade' => $row->s_g,
				'equivalent' => $row->sub_eq,
				'remarks' => $row->remarks,


			);


		$Q = $this->db->update($this->tab_edit, $set, $where);
		}
		
		return TRUE;

	}


	public function ajax_get_student_grades($sched_id){

		$sql = "call sproc_ajax_get_student_grades(?)";

			$Q = $this->db->query($sql, array('sched_id' => $sched_id));
		//$Q = $this->db->query("SELECT * FROM stud_grade_view WHERE sched_id = 5");

			return $Q->result();

		
	}

}