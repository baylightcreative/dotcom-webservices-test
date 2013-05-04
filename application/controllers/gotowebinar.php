<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/REST_Controller.php';

class Gotowebinar extends REST_Controller {

	function __construct() {
		parent::__construct();
	}

	function ajax_all_webinars_get() {

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
		
		$this->load->model('gotowebinar_model');

		$webinars = array();

		$startdate = date("Y-m-d", time());

		$webinars = $this->gotowebinar_model->get_upcoming_webinars($startdate);

		if(sizeof($webinars > 0)) {
			$this->response(array("webinars" => $webinars), 200);
		} else {
			$this->response(array("error" => "No webinars to display"), 400);
		}

		return false;
	}

	public function ajax_register_post() {

		// Allow from any origin
		if (isset($_SERVER['HTTP_ORIGIN'])) {
		    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		    header('Access-Control-Allow-Credentials: true');
		    header('Access-Control-Max-Age: 86400');    // cache for 1 day
		    header('Host: pfhq.practicefusion.com:1020');
		}

		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

		    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
		        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
  

		    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
		        header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

		    exit(0);
		}

		$first_name = $this->post('firstName');
		$last_name 	= $this->post('lastName');
		$email 		= $this->post('email');
		$webinar_key = $this->post('webinar_key');
		$organizerkey = "5159991923163147272";

		$url = "https://api.citrixonline.com/G2W/rest/organizers/".$organizerkey."/webinars/".$webinar_key."/registrants";

		$headers = array(
			"HTTP/1.1",
			"Content-type: application/json",
			"Accept: application/json",
			"Authorization: OAuth oauth_token=2e8b6837082d75ed5d0f5e7299750140"
		);

		$postData = array('firstName' => $first_name, 'lastName' => $last_name, 'email' => $email);

		$ch = curl_init();

	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	    $data = curl_exec($ch);

	    if (curl_errno($ch)) {
	    	curl_close($ch);
	        $data = curl_error($ch);
	    }

	    curl_close($ch);

		$this->response(array("result" => $data), 200);
	}

}