<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 1); ini_set('log_errors', 0); ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); error_reporting(E_ALL);	

class Test extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//
	}

	function send_data()
	{
		$books = array(
			1 => array('id' => 1, 'name' => 'varun'),
			2 => array('id' => 2, 'name' => 'khushi')
		);

		return $books;
	}
}


?>