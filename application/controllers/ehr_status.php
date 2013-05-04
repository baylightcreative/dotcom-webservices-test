<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Ehr_status extends REST_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function ajax_status_get()
	{
		// Allow from any origin
		if (isset($_SERVER['HTTP_ORIGIN'])) {
		    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		    header('Access-Control-Allow-Credentials: true');
		    header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}

		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

		    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
  

		    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		        header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

		    exit(0);
		}

		$this->load->model('ehr_status_model');

		$status_feeds 		= array();
		$status_message		= array();

		$status_feeds 	= $this->ehr_status_model->get_status_feed(10);
		$status_message = $this->ehr_status_model->get_status_message();

		if( (sizeof($status_feeds) > 0) && (sizeof($status_message) > 0) )
		{
			$status_obj = array(
				'feeds' 			=> $status_feeds,	
				'status_message'	=> $status_message
			);

			$this->response(array("status" => $status_obj), 200);
		}
		else
		{
			$this->response(array("error" => "No Results"), 400);
		}
		return false;
	}
}




?>