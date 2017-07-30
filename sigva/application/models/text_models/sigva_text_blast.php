<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Sigva_text_blast extends CI_Model{

		function __construct(){

			parent::__construct();
			$this->load->library('sample_class');
		}

	public function get_Grades_Send(){

		/* for the demonstration purpose the sample subject is the one who make the text blast during the defense */
		//$Q = $this->db->get_where(stud_page_grades_summary, array(subject_name => 'Sample Subject'));

		$sql = "SELECT grade_code, stud_name, subject_name, pr_grade, md_grade, pf_grade, finals, sub_grade, gen_ave, remarks, sec, guardian_num FROM stud_page_grades_summary";

		$Q = $this->db->query($sql);
		return $Q->result();
	}

	public function get_Select_Subject(){

		//select distinct subject_name from stud_page_grades_summary
		$sql = "SELECT distinct subject_name FROM stud_page_grades_summary";

		$Q = $this->db->query($sql);

		return $Q->result();
	}

	/* these function have a logical error regarding at sending multiple grades at a time. */
	public function send_Text_Grades(){

		/* always returning TRUE hayst*/

		$json = $this->input->post('outJsonSend');

		$arr = json_decode($json);

		$format_Arr = array("Code: ", "Name: ", "Subject: ", "Prelim :", "Midterm :", "Pre-finals: ", "Finals :", "Subject Grade :", "Gen. Average :", "Remarks :", "Section :", "Guardian Num:");

			$ln = count($format_Arr);
			$last = $ln - 1; // get the last index

			/* kunin mo sa object tapos e lop mo sila pariho tas pag natapos na si sa format arr. e send mo na sa chikka and gawa kana ulit ng panibagong format  para mag send ka. */
			$out_Grade = "--Student Grade Summary--";

				for($i =0; $i < count($arr); $i++){
				
					for($x= 0; $x < count($arr[$i]); $x++){

							$out_Grade .= $format_Arr[$x]. $arr[$i][$x]. "\n";
						}

						 //sending process here
						$unique_send_id = date("Y0m0d0H0msu", time());
						$send = $this->sample_class->sendText($unique_send_id, $arr[$i][$last], $out_Grade);

				}//2



	
	}// end function


	/* for inserting new logs upon releasing the subject grades */
	public function insert_newSendLogs($sub_name){

		$table_name = 'send_grades_logs';
		
		// date
		date_default_timezone_set('asia/manila');
		$less_day =  strtotime('-1 day', time());
		$logs_date = date("Y-m-d H:m:s", $less_day);

		$dataSet = array(

				'subject_name' => $sub_name,
				'sem' => '1st',
				'school_year' => '2016-2017',
				'sended_dateTime' => $logs_date
			);

		//$dataSet = array();

		$Q = $this->db->insert($table_name, $dataSet);

		if ($Q) {
			
			return TRUE;
		}
		else{

			return FALSE;
		}


	}// end of the function

}// e_class