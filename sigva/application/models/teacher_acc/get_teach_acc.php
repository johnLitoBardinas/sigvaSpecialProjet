<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Get_teach_acc extends CI_Model{

		function __construct(){

			parent::__construct();
		}

		public function get_teach_dat($teach_id){

			$q = $this->db->query("call sproc_get_teach_dat($teach_id)");

			if ($q) {
				
				return $q->result();
			}
			else{

				return NULL;
			}
		}
	}// class