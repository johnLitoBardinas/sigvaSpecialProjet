<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Acad_teach_subject extends CI_Model{

		var $tab_name = 'teacher_subject_view';
		var $tab_name_main = 'teacher_subject_tbl';
		var $col_order = array('teacher_lname', 'teacher_fname', 'subject_code', 'subject_description');
		var $col_search = array('teacher_lname', 'teacher_fname', 'subject_code');
		var $order = array('teacher_subject_id' => 'desc');

		/* class constructor */
		function __construct(){

			parent::__construct();
		}


		/* getting all the data at the teacher_subject_view*/
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



		/* getting the list of available subjects */
		function get_subjects(){

			$Q = $this->db->query('call sproc_sub_list()');

			return $Q->result();
		}


		/* getting the name of available teacher */
		function get_teachers(){

			$Q = $this->db->query('call sproc_sub_teachlist()');

			return $Q->result();
		}	

		/* gettin the data for the dtables latter */
		function get_dTables_teach_sub(){

			/* execute the dtable query */
			$this->get_dataTable_q();

			if ($_POST['length'] != -1) {
									
									// dropbox lenght, 1
				$this->db->limit($_POST['length'], $_POST['start']);

				/*select all the data being ask*/
				$Q = $this->db->get();

				return $Q->result();// return the result with its method result() whose gonna give the data (array of object) can be fitch using the foreach
			}
		}


		/* getting * data from the table*/
		function count_filtered_teach_sub(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows();
		}


		/* counting all the result query */
		public function count_all_teach_sub(){

			$this->db->from($this->tab_name);

			return $this->db->count_all_results();
		}


		/* getting a certain teacher subject row by its id */
		public function get_by_id_teach_sub($teacher_subject_id){

			$this->db->from($this->tab_name); //from
			$this->db->where('teacher_subject_id', $teacher_subject_id); //where

			$Q = $this->db->get();// select *

			return $Q->row(); // returbn the specific row
		}


		/* inserting new row teacher subject */
		public function save_teach_sub($data){ // parameter of array

			$this->db->insert($this->tab_name_main, $data);
			return $this->db->insert_id(); // get the last id generated from the table
		}


		/* updating the teach subject*/
		public function update_teach_sub($where, $data){

			/*('tab_name', 'arr:data', 'where', 'lmt')*/
			$this->db->update($this->tab_name_main, $data, $where);

			return $this->db->affected_rows(); // returns the int of affected row by the query
		}


		/* deleting a teach_subject row by its unique id */
		public function del_by_id_teach_sub($teacher_subject_id){

			$this->db->where('teacher_subject_id', $teacher_subject_id);

			$this->db->delete($this->tab_name_main);
		}
		
	}