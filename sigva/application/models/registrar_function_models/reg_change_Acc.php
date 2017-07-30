<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Reg_change_acc extends CI_Model{


		function __construct(){

			parent::__construct();
		}

			/*+--------------------+-------------+
			| Field              | Type        |
			+--------------------+-------------+
			| registrar_acc_id   | int(11)     |
			| registrar_username | varchar(25) |
			| registrar_pass     | varchar(40) |
			+--------------------+-------------+
			*/
		public function update_reg_acc(){
			$reg_id = 1;

			$encrpt_pss = md5($this->input->post('confirm_pass_rg'));
			$update_Reg = array(

				'registrar_acc_id' => $reg_id,
				'registrar_username' => $this->input->post('new_Username_rg'),
				'registrar_pass' => $encrpt_pss
				);

			$Q = $this->db->replace('registrar_account_tbl', $update_Reg);

			if ($Q) {
				
				return TRUE;
			}
			else{

				return FALSE;
			}

		}



		/* extra functions :) */
		public function out_teach_select(){

			$Q = $this->db->query('call sproc_guard_list');

			return $Q->result();
		}


	}//class