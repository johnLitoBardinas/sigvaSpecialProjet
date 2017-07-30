<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

 class Error extends CI_Controller{

 	function __construct(){

 		parent::__construct();
 	}

 	public function index(){

 		echo "Page is not found";
 		echo "<a href='".base_url()."'> Go back</a>";
 	}

 }//e_class