<?php 
// there is no send grade logs tbl;
defined('BASEPATH') OR exit('No direct script access allowed');

	class Grades_txt_logs extends CI_Model{

		var $tab_name_send = 'send_grades_logs';
		var $tab_col_order = array('sended_dateTime', 'subject_name', 'sem', 'school_year');
		var $col_to_search = array('subject_name', 'sem', 'school_year', 'sended_dateTime');
		var $order_by = array('sended_dateTime' => 'asc');//asc up desc down

		function __construct(){

			parent::__construct();
		}

		// private function to make the datatable
		private function get_dataTable_q(){
			$ctr = 0; 
			$this->db->from($this->tab_name_send);
			
			/* yung mga nakalagay sa POST[key][value] chenicheck lang kung true yung laman nun*/
			foreach ($this->col_to_search as $key) {
				

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
					if (count($this->col_to_search) - 1 == $ctr) {
						
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
					$this->db->order_by($this->tab_col_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);

				}
				else if(isset($this->tab_col_order)){

					$order = $this->order_by;

					/*key() - return the key of the array*/
					$this->db->order_by(key($order), $order[key($order)]);
				}

			}//e_foreach
		}//e()


		function get_dTables_send_grades_logs(){

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


		// filtered grades_log
		function count_filtered_send_grades_logs(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows();
		}


		/*count all the subject in the query*/
		public function count_all_send_grades_logs(){

			$this->db->from($this->tab_name_send);

			return $this->db->count_all_results();
		}

		
}// e_class