<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Reg_add_stud_sub_sched_tbl extends CI_Model{

		/* insert new sub_sched by stud */
		var $tab_name = 'student_grade_tbl';

		/* view of the stu_sub_sched*/
		var $tab_name_t = 'stud_sub_sched_view';
		var $col_order = array('stud_grade_id', 'stud_access_code', 'stud_name', 'sub_code', 'sub_desc', 'teach_name', 'sec_name', 'room_no', 'sched');
		var $col_search = array('stud_name');
		var $order = array('stud_grade_id' => 'desc');

		function __construct(){

			parent::__construct();
		}

		/*
			mysql> describe student_grade_tbl;
			+------------------+--------------+
			| Field            | Type         |
			+------------------+--------------+
			| student_grade_id | int(11)      |
			| student_id       | int(11)      |
			| subject_sched_id | int(11)      |
			| prelim_grade     | int(3)       |
			| midterm_grade    | int(3)       |
			| pre_finals_grade | int(3)       |
			| finals_grade     | int(3)       |
			| subject_grade    | int(3)       |
			| equivalent       | decimal(3,2) |
			| remarks          | varchar(100) |
			+------------------+--------------+
		*/
		public function add_new_stud_sub($data){
			

				$Q = $this->db->insert($this->tab_name, $data);

				if ($Q) {
					
					return TRUE;
				}
				else{

					return FALSE;
				}
			
		}



		/* show the stud_sub_sched_view to the user with the delete button*/

		private function get_dataTable_q(){
			$ctr = 0; 
			$this->db->from($this->tab_name_t);
			
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


		/* st_sb_sched */
		/* return the table to the controller*/
		public function out_stud_sub_sched_view(){

			/* execute the dtable query */
			$this->get_dataTable_q();

			if ($_POST['length'] != -1) {
									
									// table
				$this->db->limit($_POST['length'], $_POST['start']);

				/*select all the data being ask*/
				$Q = $this->db->get();

				return $Q->result();// return the result with its method result() whose gonna give the data (array of object) can be fitch using the foreach
			}
		}


		/* getting * data from the table*/
		function count_filtered_st_sb_sched(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows();
		}



		/* counting all the row in the section_tbl*/
		public function count_all_st_sb_sched(){

			$this->db->from($this->tab_name_t);

			return $this->db->count_all_results();
		}

		/* deleting the stud_sub_sched */
		public function del_stud_sched($stud_grade_id){

			$this->db->where('student_grade_id', $stud_grade_id);
			$Q = $this->db->delete($this->tab_name);

			if ($Q) {
				
				return TRUE;
			}
			else{

				return FALSE;
			}

		}

		
	}// class