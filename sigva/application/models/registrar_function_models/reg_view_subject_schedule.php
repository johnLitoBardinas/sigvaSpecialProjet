<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Reg_view_subject_schedule extends CI_Model{

		var $tab_name = 'student_subject_sched_list';
		var $col_order = array('sub_code', 'sub_desc', 'teacher_name', 'section', 'room', 'schedule');
		var $col_search = array('sub_code', 'schedule');
		var $order = array('sub_sched_id' => 'desc');
		

		function __construct(){

			parent::__construct();
		}

		private function get_dataTable_q(){
			$ctr = 0; 
			$this->db->from($this->tab_name);
			
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

		/* getting the current stud_list fro the dropbox*/
		public function ajax_select_stud(){

			$Q = $this->db->query('call sproc_stud_list');

			return $Q->result();
		}

		/* getting data to output in the dtable */
		function get_dTables_sub_sched_list(){

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


		/* getting * data from the table*/
		function count_filtered_sub_sched_list(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows();
		}



		/* counting all the row in the section_tbl*/
		public function count_all_sub_sched_list(){

			$this->db->from($this->tab_name);

			return $this->db->count_all_results();
		}
		

		/* _sub_sched_list */
	}// class