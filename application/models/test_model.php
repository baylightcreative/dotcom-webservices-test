<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_Model extends CI_Model
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

	function save_authToken($token)
	{
		if($token)
		{
			$data = array('tokens' => $token);
			$this->db->insert('auth_tokens', $data);
		}

		return true;
	}

	function check_authToken($token)
	{
		$flag = false;

		if($token)
		{
			$this->db->where('tokens', $token);
			$this->db->limit(1);
			$query = $this->db->get('auth_tokens');

			if($query->num_rows() > 0)
				$flag = true;
		}

		return $flag;
	}
}


?>