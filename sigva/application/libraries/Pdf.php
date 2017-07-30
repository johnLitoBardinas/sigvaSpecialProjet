<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH .'\third_party\tcpdf\tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }


    public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.base_url('assets/img/favicon.ico');
		$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 15, '<< SIGVA Grades Summary >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
	}
}


/* this code from the tutsway */