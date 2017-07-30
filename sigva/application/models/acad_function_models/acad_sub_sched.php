<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Acad_sub_sched extends CI_Model{

		/* ci_4 version */
		var $tab_name = 'subject_schedule_view'; // view;
		var $tab_name_in = 'subject_schedule_tbl'; // input
		var $col_order = array('subject_code', 'TeacherName', 'section_name', 'room', 'date_time');
		var $col_search = array('subject_code', 'TeacherName', 'section_name', 'room', 'date_time');
		var $order = array('subject_schedule_id' => 'desc');

		function __construct(){

			parent::__construct();
		}



		/* the sproc_teach_sub */
		function sproc_teach_sub(){

			$Q = $this->db->query('call sproc_teach_sub');

			return $Q->result(); // return an array of object
		}



		/* the list of section */
		function sec_list_select(){

				 $this->db->order_by('section_name');
			$Q = $this->db->get('section_tbl');

			return $Q->result();
		}



		/* the ajaxs*/
		/* query to get the data in the view for the data table*/
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



		/* data to store in the dtable*/
		function get_dTables_sub_sched(){

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



		/* return the number of row in items section */
		function count_filtered_sub_sched(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows();
		}



		/* all the result of query will be returned */
		public function count_all_sub_sched(){

			$this->db->from($this->tab_name);

			return $this->db->count_all_results();
		}


		/* saving the new sub_sched tbl*/
		public function save_sub_sched($data){ // parameter of array

			$this->db->insert($this->tab_name_in, $data);
			return $this->db->insert_id(); // get the last id generated from the table
		}



		/* deleting the subject schedule in subject_tbl*/
		public function del_by_id_sub_sched($subject_schedule_id){

			$this->db->where('subject_schedule_id', $subject_schedule_id);

			$this->db->delete($this->tab_name_in);
		}



		/* for editing the data in the subject_tbl*/
		public function get_by_id_sub_sched($subject_schedule_id){

			$this->db->from($this->tab_name_in);
			$this->db->where('subject_schedule_id', $subject_schedule_id);

			$Q = $this->db->get();

			return $Q->row();
		}


		public function update_sub_sched($where, $data){

			/*('tab_name', 'arr:data', 'where', 'lmt')*/
			$this->db->update($this->tab_name_in, $data, $where);

			return $this->db->affected_rows();
		}

	}// end_class
