<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Sigva extends CI_Controller {

		function __construct(){

			parent::__construct();
		}

		public function index(){

			$data['title_page'] = 'WELCOME TO SIGVA';
			$this->load->view('main/main_page', $data);
		}

	}//e_class
