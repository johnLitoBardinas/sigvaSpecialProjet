<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Student extends CI_Controller{

		protected $term = '';
		function __construct(){

			/* any constructed initialization 
			for the controller class*/
			parent::__construct();

			$this->load->model('stud_login_model', 'login_model');
		}

		public function index(){

			$this->session->unset_userdata('stud_access_code');

			$data['title_page'] = 'Student | Login';
			$this->load->view('stud/stud_page_login.php', $data);
		}

		public function validate_student($stud_code){
			
			$Q = $this->login_model->validate_stud($stud_code);

			//$Q = true;
			if ($Q) {
				
				$this->session->set_userdata('stud_access_code', $stud_code);

				echo json_encode(array('status' => true));
			}
			else{

				echo json_encode(array('status'=> false));
			}

		}


		/* 

		 	Distint student_data
		*/
		public function student_home(){

			$this->load->model('student_function_models/student_get_grades_studInfo_model', 'stud_model');
			/* functio model = student_get_grades_model.php*/
			$acess_code = $this->session->userdata('stud_access_code');

			if (isset($acess_code)) {
				// proced
				$data['student_grades_article'] = $this->stud_model->student_article_grades();

				//echo $acess_code;
				$data['title_page'] = "Student | Home";
				$this->load->view('stud/stud_page_home', $data);
			}
			else{

				redirect(site_url('student'));
			}

		}


		/*
			+ output the data on the article_grades using student_id

			1st create the model for this function this will be a plain text response waiting to be .inject at the stud_page_home.. for more dynamically
		*/

		/* model muna  */
		/* gibo na sa controller */
		/* gibo na ko view */


		public function ajax_grades_article(){

		$this->load->model('student_function_models/stud_page_get_pdf_grades', 'grades_article');
		
		$code = $this->session->userdata('stud_access_code');
		
		/* foreach na student grades na naka butang sadto ehh query 
			mig loop lang adi sadi ehh  div.well na adi ibat ibang data lang a ma ibubutang niya ta naka loop na iya


			sato ehh model mig gibo ko sa stored procedure na ahh iluluwas lang niya so puon sadto ehh sec
		*/

		$Q = $this->grades_article->get_grades_pdf($code);


		$this->session->set_userdata('stud_grade_data', $Q);
		//$sub_name = 'Algebra';


		/* #8b0000
			#e6e600
			#CCCC00
		*/

		
		echo "<div class='panel panel-default' style='background-color: #dcf5de;
'>";
		foreach ($Q as $row) {

		$this->term = $row->sem." semester ".$row->school_year;
			
		$teach_name = $row->teach_name;
		$sched = 'Room: '. $row->room .'/ '.$row->date_sched;
		$sec = $row->sec;

		$sub_name = $row->subject_name;
		$sub_desc = $row->description;

		/* individuals grades */
		$pr_g = $row->pr_grade;
		$md_g = $row->md_grade;
		$pf_g = $row->pf_grade;
		$f_g = $row->sub_grade;
		$sub_g = $row->sub_grade;
		$gen_ave = $row->gen_ave;
		$remarks = $row->remarks;
		
		$htmlOut = <<<EOD
		
                <div id="individual_grades" class="col-xs-12" style="border-bottom:thin solid gray; border:thin solid darkred; margin-top:2%; cursor:pointer" >
                    
                    <h2 style="margin-top:3%; width: 129px;"> $sub_name </h2> <span> $sub_desc </span><br>
                    
                    

                    <table class="table table-default table-responsive table-primary" width="100%" style="display:none">

                    	<tr>
							<td> <b> Section </b> </td>
							<td> $sec </td>
							
                    	</tr>

                    	<tr>
							<td> <b> Prelim </b> </td>
							<td> $pr_g </td>
								
                    	</tr>

                    	<tr>
							<td> <b> Midterm </b> </td>
							<td> $md_g </td>
								
                    	</tr>

                    	<tr>
							<td> <b> Pre-Finals </b> </td>
							<td> $pf_g </td>
							
                    	</tr>

                    	<tr>
							<td> <b> Finals </b> </td>
							<td> $f_g  </td>
							
                    	</tr>

                    	<tr>
							<td> <b> Subject Grade </b> </td>
							<td> $sub_g </td>
							
                    	</tr>

                    	<tr>
							<td> <b> General Average </b> </td>
							<td> $gen_ave  </td>
							
                    	</tr>

                    	<tr>
							<td> <b> Teacher Remarks </b> </td>
							<td> $remarks  </td>
							
                    	</tr>
                    </table>
                    <div class="text-center">
                        <a href="#" title="$sched"><i class="fa fa-list"></i>Schedule </a>
                        <a href="#" title="$teach_name"><i class="fa fa-circle"></i> Teacher </a>
                    </div>

    			</div>
EOD;

	//$this->htmlOut .= "";
			echo $htmlOut;
		}// end of the foreach
		echo 'School Year: '. $this->term . "<hr>";
		echo "</div>";
		//print_r($Q);
		}

	}