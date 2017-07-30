<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

 class Acad_teachers extends CI_Model{

 	/* member()*/
		var $tab_name = 'teacher_tbl';
		var $col_order = array('teacher_id', 'teacher_lname', 'teacher_fname', 'teacher_mname', 'teach_account');//no_id needed
		var $col_search = array('teacher_lname', 'teacher_fname', 'teach_account');
		var $order = array('teacher_id' => 'desc');

		/* constructor()*/
		function __construct(){

			parent::__construct();
		}


		/*getDtables*/
		/* only in the model existing*/
		private function get_dataTable_q(){
			$ctr = 0; 
			$this->db->from($this->tab_name);
			
			/* yung mga nakalagay sa POST[key][value] chenicheck lang kung true yung laman nun*/
			foreach ($this->col_search as $key) {
				
				if ($_POST['search']['value']) {
					
					if ($ctr === 0) {
						
						$this->db->group_start(); // grouping_start

						$this->db->like($key, $_POST['search']['value']); //and
					}
					else{

						$this->db->or_like($key, $_POST['search']['value']); //or
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

		}//dtable_q()


		/*get_Dtables*/
		function get_dTables_teach(){

			/* execute the dtable query */
			$this->get_dataTable_q();

			if ($_POST['length'] != -1) {
				
				//limit, start
				$this->db->limit($_POST['length'], $_POST['start']);

				/*select all the data being ask*/
				$Q = $this->db->get();

				return $Q->result();
			}
		}//g_dTables


		/* filtering_count */
		function count_filtered_teach(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows(); // return the number of rows

		}//e_c_fill


		/*counting_all*/
		public function count_all_teach(){

			$this->db->from($this->tab_name);

			return $this->db->count_all_results();
		}


		/* get_row_by_id */
		public function get_by_id_teach($teacher_id){

			$this->db->from($this->tab_name);
			$this->db->where('teacher_id', $teacher_id);

			$Q = $this->db->get();

			return $Q->row();
		}//e_getrowID


		/* saving new row in teacher_tbl */
		public function save_teach($data){ // parameter of array

			$this->db->insert($this->tab_name, $data);
			return $this->db->insert_id();
		}//e_save


		/* updating row */
		public function update_teach($where, $data){

			/*('tab_name', 'arr:data', 'where', 'lmt')*/
			$this->db->update($this->tab_name, $data, $where);

			return $this->db->affected_rows();
		}//update


		/* deleting row */
		public function del_by_id_teach($teacher_id){

			$this->db->where('teacher_id', $teacher_id);

			$this->db->delete($this->tab_name);
		}
 }//e_class