<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors', 1); ini_set('log_errors', 0); ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); error_reporting(E_ALL);

class Gotowebinar_model extends CI_Model {

	public function get_upcoming_webinars($startdate="")
	{
		$this->db->where('start_date >', $startdate);

		$query = $this->db->get('gotowebinars');

		$result = array();

		foreach ($query->result_array() as $row) {
			$result[] = $row;
		}

		$query->free_result();

		return $result;
	}

}


?>