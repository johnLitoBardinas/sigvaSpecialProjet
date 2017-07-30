<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Acad_subjects extends CI_Model{

		/* member()*/
		var $tab_name = 'subject_tbl';
		var $tab_nameT = 'subject_prerequisite_tbl';
		var $col_order = array('subject_code', 'subject_description', 'subject_units');
		var $col_search = array('subject_code', 'subject_description');
		var $order = array('subject_id' => 'desc');
		/* constructor()*/
		function __construct(){

			parent::__construct();
		}

		private function get_dataTable_q(){
			$ctr = 0; 
			$this->db->from($this->tab_name);
			
			/* yung mga nakalagay sa POST[key][value] chenicheck lang kung true yung laman nun*/
			foreach ($this->col_search as $key) {
				
				if ($_POST['search']['value']) {
					
					if ($ctr === 0) {
						
						$this->db->group_start(); // grouping_start

						$this->db->like($key, $_POST['search']['value']);
					}
					else{

						$this->db->or_like($key, $_POST['search']['value']);
					}

					//last loop
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

		function get_dTables(){

			/* execute the dtable query */
			$this->get_dataTable_q();

			if ($_POST['length'] != -1) {
				
				$this->db->limit($_POST['length'], $_POST['start']);

				/*select all the data being ask*/
				$Q = $this->db->get();

				return $Q->result();
			}
		}//e()


		function count_filtered(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows();
		}


		public function count_all(){

			$this->db->from($this->tab_name);

			return $this->db->count_all_results();
		}


		public function get_by_id($subject_id){

			$this->db->from($this->tab_name);
			$this->db->where('subject_id', $subject_id);

			$Q = $this->db->get();

			return $Q->row();
		}

		public function save($data){ // parameter of array

			$this->db->insert($this->tab_name, $data);
			return $this->db->insert_id();
		}


		public function update($where, $data){

			/*('tab_name', 'arr:data', 'where', 'lmt')*/
			$this->db->update($this->tab_name, $data, $where);

			return $this->db->affected_rows();
		}

		public function del_by_id($subject_id){

			$this->db->where('subject_id', $subject_id);

			$this->db->delete($this->tab_name);
		}
	}// e_class