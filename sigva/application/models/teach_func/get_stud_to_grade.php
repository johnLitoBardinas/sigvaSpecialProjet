<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Get_stud_to_grade extends CI_Model{

		/* dapat inside iya ka class*/
		var $tab_view = 'stud_grade_view';
		var $col_order = array('stud_id', 'sched_id', 'stud_name', 'pr_g', ' md_g', 'pf_g', 'f_g', 'sub_g', 'eq', 'remarks', 'guardian_num');
		var $col_search = array('stud_name');
		var $order = array('stud_name' => 'asc');

		var $tab_update = 'student_grade_tbl';

		function __construct(){

			parent::__construct();

		}

		private function get_dataTable_q(){

			$sched_id = $this->session->userdata('c_sched_id');
			$ctr = 0;
			$this->db->from($this->tab_view);
			$this->db->where(array('sched_id' => $sched_id));
			
			
			/* yung mga nakalagay sa POST[key][value] chenicheck lang kung true yung laman nun*/
			foreach ($this->col_search as $key) {
				
				/*input type = [key_search][ele_value] in the POST Array*/
				if ($_POST['search']['value']) {
					
					/* strictly equal including the data type*/
					if ($ctr === 0) {
						
						$this->db->group_start(); // grouping_start

						$this->db->like($key, $_POST['search']['value']);
					}
					else{

						$this->db->or_like($key, $_POST['search']['value']);
					}

					//last loop
							// lenght - 1
					if (count($this->col_search) - 1 == $ctr) {
						
						$this->db->group_end(); // grouping_endded
					}
				}
				$ctr = $ctr + 1; // $ctr++

				/*ordering the data*/
				if (isset($_POST['order'])) {
					
					/* 
					col_oder[key][value][?]= inserting
					
					order_by('odr', 'str_pos');
					*/
					$this->db->order_by($this->col_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

				}
				else if(isset($this->col_order)){

					$order = $this->order;

					/*key() - return the key of the array*/
					$this->db->order_by(key($order), $order[key($order)]);
				}

			}//e_foreach

		}//e()


		function get_dTables_stud_to_grade(){

			/* execute the dtable query */
			$this->get_dataTable_q();

			if ($_POST['length'] != -1) {
									
									// dropbox lenght, 1
				$this->db->limit($_POST['length'], $_POST['start']);

				/*select all the data being ask*/
				$Q = $this->db->get();

				return $Q->result();// return the result with its method result() whose gonna give the data (array of object) can be fitch using the foreach
			}
		}//e()


		/* getting * data from the database table*/
		function count_filtered_stud_to_grade(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows();
		}


		// count all the return row of the tbl
		public function count_all_stud_to_grade(){

			$this->db->from($this->tab_view);

			return $this->db->count_all_results();
		}
// end for the dtables

		/* getting a specific row by its stud_grade_id*/
		public function get_by_id_stud_grade($stud_grade_id){

			$this->db->from($this->tab_update); //from
			$this->db->where('student_grade_id', $stud_grade_id); //where

			$Q = $this->db->get();// select *

			return $Q->row(); // returbn the specific row
		}


		/* updating a certain row at the table using the where=id, data is an array*/
		public function update_stud_grade($where){

			/* var stud */

			/*$stud_name = $this->input->post('stud_name');
			$stud_subj = $this->session->userdata('subj_name');*/

			/* grade var */
			$pr = $this->input->post('prelim');
			$md = $this->input->post('midterm');
			$pf	= $this->input->post('pre_final');
			$f	= $this->input->post('final');
			$sub_g = $this->input->post('sub_grade');
			$eq = $this->input->post('eq');
			$rmks = $this->input->post('remarks');

				$dataIn = array(

				'prelim_grade' => $pr,
				'midterm_grade' => $md,
				'pre_finals_grade' => $pf,
				'finals_grade' => $f,
				'subject_grade' => $sub_g,
				'equivalent' => $eq,
				'remarks' => $rmks,
				);

			/*('tab_name', 'arr:data', 'where', 'lmt')*/
			$X = $this->db->update($this->tab_update, $dataIn, $where);


			$stud_name = $this->input->post('stud_name');
			$teach_name = $this->session->userdata('teach_name');
			
			$dataMsg = array(

				/* 
				student name
				subject 
				*/
				'Student: '=> $stud_name,
				'Subject: '=> $this->session->tempdata('sub_code'),
				'Section: '=> $this->session->tempdata('sec_name'),
				'Prelim: ' => $pr,
				'Midterm: ' => $md,
				'Prefinals: ' => $pf,
				'Finals: ' => $f,
				'Subject Grade: ' => $sub_g,
				'Equivalent: ' => $eq,
				'Remarks: ' => $rmks,
				'-teacher: ' => strtolower($teach_name)
				);




			/* this is what the above array will be sent */
			$P = $this->sendGrade_Msg($dataMsg);

				//return $this->db->affected_rows(); // returns the int of 
			
			if ($X) {
				
				$this->session->unset_tempdata('sub_code');
				$this->session->unset_tempdata('sec_name');
				return TRUE;

			}
			else{

				return FALSE;
			}
			
			
		}


		private function sendGrade_Msg($data_Grade){

			$this->load->model('teach_func/chika_api_model', 'shk_model');
			$P = $this->shk_model->sendGrade_Msg($data_Grade);

		}

	}// class

/* the grade sucessfully send and iam satisfied
	9 - 17 - 2016
*/