<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', 1); ini_set('log_errors', 0); ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); error_reporting(E_ALL);

class Form extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('form');
	}

	public function get_authToken()
	{
		$this->load->model('test_model');

		$token = md5(uniqid(rand(), true));

		$flag = $this->test_model->save_authToken($token);

		if($flag)
			echo json_encode(array('authToken' => $token));

		return false;
	}

	public function sendForm()
	{
		$this->load->model('test_model');

		foreach ($this->input->post() as $key => $value) {
			${$key} = $value;
		}
		

		$flag = $this->test_model->check_authToken($authToken);

		if($flag)
		{
			echo "true";
		}

		return false;

	}
}

?>