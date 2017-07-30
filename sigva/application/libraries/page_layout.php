<?php 

/* alalay lang to na class par ma explore pa ang CI in deep*/
defined('BASEPATH') OR exit('No direct script access allowed');

 class Page_layout{

 	// hold ci_intance
 	private $CI;

 	// title page
 	private $layout_title = null;

 	// desc
 	private $layout_desc = null;

 	// hold the includes_js_cs
 	private $inc_css_js = array();
 	#main layout functions
 	public function __construct(){

 		#return the actual CI object replacing $this to the var holding it
 		$this->CI =& get_instance();
 	}

 	public function set_Title($title){

 		$this->layout_title = $title;
 	}

 	public function set_Desc($desc){

 		$this->layout_desc = $desc;
 	}

 	public function add_inc_js_css($path, $prepend_base_url = true){

 		if ($prepend_base_url) {
 			
 			// alalay
 			$this->CI->load->helper('url');
 			$this->inc_css_js[] = base_url(). $path;
 		}
 		else{

 			$this->inc_css_js[] = $path;
 		}

 		return $this;
 	}


 	public function print_inc(){

 		$f_inc = '';

 		foreach ($this->inc_css_js as $inc) {
 			# code...
 			if (preg_match('/js$/', $inc)) {
 				# code...

 				$f_inc .= "<script>".$inc."</script>";
 			}
 			elseif(preg_match('/css$/', $inc)){

 				$f_inc .= "<link rel='stylesheet' href='".$inc."'/>";
 			}
 		}

 		return $f_inc;
 	}
 	#method call 
 	/*
		1. view name
		2. key=>val () to include in the view
		3. params to pass with key=> value pair
		4. functionality no header and footer
 	*/
 	public function view($view_file, $layouts = array(), $params = array(), $default = true){

 		if (is_array($layouts) && count($layouts >= 1)) {
 			
 			foreach ($layouts as $key => $value) {
 				
 				$params[$key] =$this->CI->load->view($value, $params, true);
 			}
 		}


 		/* including the header and the footer */
 		if ($default) {
 			
 			#setting the title of the page
 			$head_params['page_title'] = $this->layout_title;


 			$head_params['page_desc'] = $this->layout_desc;


 			#def header and the footer 
 			$this->CI->load->view('inc/head', $head_params);

 			#def content
 			$this->CI->load->view($view_file, $params);

 			#def_footer
 			$this->CI->load->view('inc/foot');
 		}
 		else{

 			#no header and footer
 			$this->CI->load->view($view_file, $params)
 		}

 	}
 }//class


 /* these is the library for the paging


	procedure: 

	1. load the library now in the controller


	2. $this->class_name->method(params);
 */
?>