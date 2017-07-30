<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Acad_login extends CI_Model{

		function __construct(){

			parent::__construct();
		}

		public function if_exist_Account(){

			$acad_username = $this->input->post('acad_user');
			$acad_pass = $this->input->post('acad_pass');

			$Q = $this->db->get_where('admin_account_tbl', array('admin_username' => $acad_username, 'admin_password' => md5($acad_pass)));

			if ($Q->num_rows() == 1) {
				
				return TRUE;
			}
			else{

				return FALSE;
			}
		}

	}