<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Get_teach_sched_dat extends CI_Model{

		/* global variables */
		/* class instance var */
		/* var kailangan para gumana ang mga member variable sa baba :)*/
		var $tab_name = 'teach_sched_view';
		var $col_order = array('sec_name', 'sub_code', 'room', 'date_time');
		var $col_search = array('sec_name', 'sub_code', 'room', 'date_time');
		var $order = array('sched_id' => 'desc');


		function __construct(){

			parent::__construct();
		}


		/* get private data tables ajax methods view*/
		private function get_dataTable_q(){
			$t_id = $this->session->userdata('teach_id');
			$ctr = 0;
			$this->db->from($this->tab_name);
			$this->db->where(array('teach_id' => $t_id));
			
			
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

		// public for outputing in the controller

		/* getting data to output in the dtable */
		function get_dTables_t_sub_sched(){

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

		// filtered the data in the datatables
		/* getting * data from the database table*/
		function count_filtered_t_sub_sched(){

			/* mga list of Q*/
			$this->get_dataTable_q();

			/*taga select nung mga Q*/
			$Q = $this->db->get();
			return $Q->num_rows();
		}

		
		// count all the return row of the tbl
		public function count_all_t_sub_sched(){

			$this->db->from($this->tab_name);

			return $this->db->count_all_results();
		}


	}