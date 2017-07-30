<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Acad_change_Acc extends CI_Model{

		function __construct(){

			parent::__construct();
		}

		public function get_acadInfo(){

			$acad_id = $this->session->userdata('acad_id');
			$Q = $this->db->get_where('admin_account_tbl', array(' admin_account_id' => $acad_id));

			if ($Q) {
				
				return $Q->result();
			}
			else{

				return NULL;
			}
		}

		public function change_acad_data(){

			$acad_id = $this->session->userdata('acad_id');
			$new_srname = $this->input->post('new_Username');
			$new_pass = $this->input->post('new_pass');

			$updateAcad = array(

				'admin_account_id' => $acad_id,
				'admin_username' => $new_srname,
				'admin_password' => md5($new_pass)

				);
			
			$Q = $this->db->replace('admin_account_tbl', $updateAcad);

			if ($Q) {
				
				return TRUE;
			}
			else{

				return FALSE;
			}

			//return "Hello from the model";
		}



	}