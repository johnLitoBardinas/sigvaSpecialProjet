<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Chika_api_model extends CI_Model{

		public function __construct(){

			parent::__construct();
			$this->load->helper('string');
		}

		private function arr_to_str($arr){

			$str = "";
			
			$str .= "-Grade Summary-". "\n";
			foreach ($arr as $key => $value) {

				$str .= $key." ".$value. " \n";
			}

			return $str;
		}


		private function chkAPi($grade_credin, $phone_num, $msg_id){

					/* create a associative array to get ready to past in a function */
		    $arr_post_body = array(
		        "message_type" => "SEND",
		        "mobile_number" => $phone_num,//09487548332
		        "shortcode" => "2929007247", // the schort code at your dashboard 
		        "message_id" => $msg_id, // dapat kada send mo.. nag babago dapat ading number na adi
		        "message" => $grade_credin, // serialise message=string_val
		        "client_id" => "d8b838a4ec0e45c6f2d700296add15cef374a9020e3d764f316413773a83d59c",// your own client id in the dashboard
		        "secret_key" => "59d6675d69ed6fa1238ec68ee8781c6be0e04d9849308f3ff7524c401bc58532" // your secret key at your dashboard
		    );

		    $query_string = "";

		    /* sa kada arr_post_body ,- row  tas so value as $key kadto bilang $frow*/
		    foreach($arr_post_body as $key => $frow)
		    {
		        $query_string .= '&'.$key.'='.$frow; // create a query string ready to sent
		    }

		    $URL = "https://post.chikka.com/smsapi/request?"; // own chika website to send the $query_string

		    //echo $URL.$query_string;
		    $curl_handler = curl_init();
		    curl_setopt($curl_handler, CURLOPT_URL, $URL);
		    curl_setopt($curl_handler, CURLOPT_POST, TRUE);//count($arr_post_body)
		    curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
		    curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
		    
		    if (curl_exec($curl_handler) === false) {
		       
		        //echo 'Curl error: '. curl_error($curl_handler);
		        return curl_error($curl_handler);
		        //return FALSE;

		    }
		    else{

		        //echo 'Operation Complete without error';

		        //$response = curl_exec($curl_handler);

		       // echo $response;
		    	return TRUE;
		    }
		    curl_close($curl_handler);

		    exit(0);
		}

		/* t or f*/
		public function sendGrade_Msg($dataIn){

			$str_msg  = $this->arr_to_str($dataIn);

			$guardian_num = $this->input->post('guardian_num');

			$msg_id = random_string('nozero', 30);

			$send = $this->chkAPi($str_msg, $guardian_num, $msg_id);

			if ($send) {
				
				return TRUE;
			}
			else{

				return FALSE;
			}

		}

	}// class