<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', 1); ini_set('log_errors', 0); ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); error_reporting(E_ALL);

require APPPATH.'libraries/REST_Controller.php';

class API extends REST_Controller 
{
	function user_get()
	{

	    if(!$this->get('id'))
	    {
	    	$this->response(NULL, 400);
	    }

		$users = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array('hobbies' => array('fartings', 'bikes'))),
		);
		
		$user = @$users[$this->get('id')];
		
	    if($user)
	    {
	        $this->response($user, 200); // 200 being the HTTP response code
	    }

	    else
	    {
	        $this->response(array('error' => 'User could not be found'), 404);
	    }
	}

	function users_get()
	{
		$users = array(
			1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
			2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
			3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array('hobbies' => array('fartings', 'bikes'))),
		);

		if($users)
	    {
	        $this->response($users, 200); // 200 being the HTTP response code
	    }

	    else
	    {
	        $this->response(array('error' => 'Users could not be found'), 404);
	    }
	}

	function user_post()
	{
		$message = array('id' => $this->get('id'), 'name' => $this->post('name'), 'email' => $this->post('email'), 'message' => 'ADDED user');

		$this->response($message, 200);
	}

	function books_get()
	{
		$this->load->model('test_model');
		
		$books = $this->test_model->send_data();

		$this->response($books, 200);

	}

}