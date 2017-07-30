<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Registrar_login_model extends CI_Model{

		function __construct(){

			parent::__construct();
		}


		public function if_exist_Account_reg(){

			$reg_user = $this->input->post('reg_user');
			$reg_pass = $this->input->post('reg_pass');

			$data = array(

				'registrar_username' => $reg_user, 
				'registrar_pass' => md5($reg_pass)
				);
			$Q = $this->db->get_where('registrar_account_tbl', $data);

			if ($Q->num_rows() == 1) { 
				
				return TRUE;
				
			}
			else{

				return FALSE;
			}
		}

	}// class