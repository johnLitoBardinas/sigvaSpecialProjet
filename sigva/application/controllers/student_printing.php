<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Student_printing extends CI_Controller{

		//protected $guardian_info = array();
		//protected $stud_info = array();

		var $gwa = 0;

		function __construct(){

			parent::__construct();
			$this->load->model('student_function_models/stud_page_get_pdf_grades', 'pdf_model');
		}

	    private function stud_grades_subjects(){

	    	$total_units = 0;
	    	$total_g_gwa = 0;
	    	
	     	$Q = $this->pdf_model->get_grades_pdf();

			$return = ''; 
			
	     	foreach ($Q as $row) {
	     		
	     		$return .= '<tr style="font-size:10px">';
	     				$return .= '<td align="left">'.$row->subject_name.'</td>';
					$return .= '<td align="left">'.$row->description.'</td>';
					$return .= '<td align="left">'.$row->sub_units.'</td>';
					$return .= '<td align="left">'.$row->gen_ave.'</td>';
	     		$return .= '</tr>';

	     		$total_units = $total_units + $row->sub_units;

	     		$total_g_gwa = $total_g_gwa + ($row->gen_ave * $row->sub_units);

	     		if (($this->gwa - $this->gwa) === 0) {
	     			# code...
	     			$gwa = $this->gwa;
	     			$this->gwa= sprintf("%0.2f",$gwa);
	     		}
	     		else{

	     			$this->gwa = $total_g_gwa / $total_units;	
	     		}
	     		
	     	}
	     	
	     	return $return;
	     }


	     public function index(){

	     	$grades = array();
	     	$html;
	     	/* create ng sariling model para ma kuha na yung mga grades summary ng estudyante */

	     	/* kunin nalang yung current student access code session para mapag habingan */
	     	

	     	$Q = $this->pdf_model->get_grades_pdf();

	     	foreach ($Q as $row) {
	     		
	     		$guardian_info['guard_name'] = $row->guard_name;
	     		$guardian_info['guard_address'] = $row->guard_address;

	     	}


	     	foreach ($Q as $row) {
	     		
	     		$stud_info['stud_name'] = $row->stud_name;
	     		$stud_info['stud_status'] = $row->stud_status;
	     		$stud_info['stud_t_y'] = $row->sem ." ".$row->school_year;
	     		$stud_info['stud_program'] = $row->program;

	     	}
	     		

	     			 	/* 
	 	sample pass variable here 


		1. student_guardian
		2. 
	 	*/

		/* the formatted date: advance in 1 day */
		//date_default_timezone_set('asia/manila');
		//$time_two = strtotime('-1 day', time());
		$php_timestamp_date = date("F d, Y", time());


		//print_r(getdate());
		$guardian_name = strtoupper($guardian_info['guard_name']);
	 	$guardian_adress = $guardian_info['guard_address'];

	 	$school_address = 'Central Business District (CBD) II, Brgy. Triangulo, Naga City';

	 	$id = '12';
	 	$stud_name = strtoupper($stud_info['stud_name']);
	 	$status = $stud_info['stud_status'];
	 	$term = $stud_info['stud_t_y'];
	 	$program = strtoupper($stud_info['stud_program']);

	 	/* how tcpdf works */
	 	/*
		=> create the pdf object

		=> set the appropriate member data of the object and member functions in short setting of the object 

		=> output the object using the Output(filename, I=in browser to display)


		addPage = pang add sa page 
	 	*/


		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

		$pdf->Header();
		$pdf->Footer();
		/* pdf basic structure */
		$pdf->SetTitle('Grade Summary');
		$pdf->SetHeaderMargin(20);
		$pdf->SetTopMargin(15);
		$pdf->setFooterMargin(0);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('SIGVA');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->Write(5, 'CodeIgniter TCPDF Integration');

		/* setting the header and footer null*/
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);

		/* setting the beautoful fonts */
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->setCellHeightRatio(1.5);

		/* actual na docu*/
		$pdf->AddPage();

		/* butang sadto pdf na an */
		//$html = '<h1> Hello World!! </h1>';

		/*'F d, Y'
<p align="right" style="margin:0"> date('F d, Y')</p>

		*/

	$logo_sti = base_url('assets/pdf/images/logo_sti.png');
	$grades = $this->stud_grades_subjects();
	$f_gwa = round($this->gwa, 2);
		
		$html = <<<EOD
		<img src="$logo_sti"  width="90" height="50" style="margin-top:0"><br>
		<p align="right" style="margin:0"> $php_timestamp_date</p>

		<table border="" cellspacing="3" cellpadding="4"> 

			<tr> 
				<td colspan="4" align="left">
				<h3 style="color:bluegreen">GUARDIAN INFORMATION: </h3>
				</td>
			</tr>
			
			<tr>
				<td width="50%"> Guardian Name: <br>
				<strong align="left"> $guardian_name </strong> 
				</td>

				<td width="50%"> Address: <br><strong align="left">$guardian_adress</strong>
				</td>
			</tr>
		</table>

		<table border="" cellspacing="3" cellpadding="4">

			<tr> 
				<td colspan="4" align="left"><h3 style="color:bluegreen">STUDENT INFORMATION: </h3></td>
			</tr>
			
			<tr>
				<td width="40%"> Name: <br><strong style="text-transform:capitalize">$stud_name</strong></td>
				<td width="15%"> Status: <br><strong >$status</strong></td>
				<td width="30%"> Term/ School Year: <br><strong >$term</strong></td>
				<td width="15%"> Program: <br><strong >$program</strong></td>
			</tr>

			
		
		</table>

		<br>
		<br>
		<br>

		<table border="" cellspacing="3" cellpadding="4" style="border: thin solid gray">

			<tr> 
				<td colspan="4" align="center"><h3 style="color:bluegreen; letter-spacing:3px;"> GRADE SUMMARY </h3></td>
			</tr>
			
			<tr>
				<td width="20%" align="center" style="font-weight:bold; letter-spacing:1px; border-right:thin solid gray; border-top: thin solid darkgreen; border-bottom: thin solid darkgreen"> Code </td>
				<td width="40%" align="center" style="font-weight:bold; letter-spacing:1px; border-right:thin solid gray; border-top: thin solid darkgreen; border-bottom: thin solid darkgreen"> Course </td>
				<td width="20%" align="center" style="font-weight:bold; letter-spacing:1px; border-right:thin solid gray; border-top: thin solid darkgreen; border-bottom: thin solid darkgreen"> Units </td>
				<td width="20%" align="center" style="font-weight:bold; letter-spacing:1px; border-top: thin solid darkgreen; border-bottom: thin solid darkgreen"> Gen. Ave </td>
			</tr>

			$grades

			<br>
			<br>
			<br>
			<tr style="font-size:9px">
				<td> <strong>GWA :</strong> $f_gwa</td>
			</tr>
		</table>
EOD;


		$pdf->writeHTML($html, true, false, true, false, '');
		

		$tbl = <<<EOD

		<table cellspacing="1" cellpadding="1" border="">
    		<tr>
	        	<td width="25%" rowspan="3" style="font-size:7px; font-spacing:5px">GRADING SYSTEM
		        	<br>
		        	<br> 1.00 = 98.00 - 100 %  Excelent
		        	<br> 1.25 = 95.00 - 97.00 % Very Good
		        	<br> 1.50 = 92.00 - 94.00 % Very Good
		        	<br> 1.75 = 89.00 - 91.00 % Very Good
	        	</td>

				<td width="4"> </td>
	        	<td width="25%" rowspan="3" style="font-size:7px; font-spacing:5px;" dir="ltr">
		        	<br> 
		        	<br>
					<br> 2.00 = 86.00 - 88.00 %  Satisfactory
		        	<br> 2.25 = 83.00 - 85.00 %  Satisfactory
		        	<br> 2.50 = 80.00 - 82.00 %  Satisfactory
		        	<br> 2.75 = 77.00 - 79.00 %  Fair
	        	</td>
				
				<td width="4"> </td>
	        	<td width="25%" rowspan="3" style="font-size:7px; font-spacing:5px">
		        	<br> 
		        	<br>
					<br> 3.00 = 75.00 - 76.00 %  Fair
		        	<br> 5.00 =     0 - 74.00 %  Failed
		        	<br> FAIL =     0 -     0 %  Failed
		        	<br> INC  =     0 -     0 %  Incomplete 
	        	</td>

	        	<td width="25%" style="font-size:7px; font-spacing:5px;" dir="ltr">

	        		<br> 
		        	<br>
					<br> DRP = 0 %  Officially Dropped
		        	<br> PASS = 0 %  Passed
		        	<br> TRF = 0 %  Transfer
		        	<br>
	        	</td>
    		</tr>

		</table>

		<p style="text-indent:25px">I certify to the veracity of the above records of $stud_name</p>


		<table border="">
			<tr>
				<td> </td>
				<td> </td>
			</tr>

			<tr>
				<td> </td>
				<td> </td>
			</tr>

			<tr>
				<td> </td>
				<td> </td>
			</tr>

			<tr>
			<td width="80%"></td>
			<td width="20%" align="center">
				<u> Marion P. Arlante </u>
				<strong> Registrar </strong>
			</td>
			</tr>
		</table>

EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
	
		$out_name = $stud_info['stud_name'].' Grades.pdf';
		/* this is the final ouput of the pdf*/
		$pdf->Output($out_name, 'I');

			//echo dirname(__FILE__) \tcpdf\tcpdf.php';

     }// e_index


}