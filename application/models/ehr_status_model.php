<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ehr_status_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_status_message()
	{
		$status_message = array();

		$this->db->select('status_info_id, message, uptime_percentage, uptime_period');
		$this->db->order_by('id', 'desc');
		$this->db->limit(1);

		$query = $this->db->get('status');

		if($query->num_rows() > 0)
		{
			$row = $query->row();

			$status_message['status_info_id'] 		= $row->status_info_id;
			$status_message['message'] 				= $this->unicode_escape_sequences($row->message);
			$status_message['uptime_percentage'] 	= $row->uptime_percentage;
			$status_message['uptime_period'] 		= $row->uptime_period;
			$status_message['datetime'] 			= date("H:i A", time());
		}

		$query->free_result();

		return $status_message;
	}

	function get_status_feed($limit)
	{
		$status_feeds = array();

		$this->db->select('message, datetime');
		$this->db->order_by('id', 'desc');

		if($limit)
			$this->db->limit($limit);
		else 
			$this->db->limit(10);
		
		$query = $this->db->get('status_feed');

		foreach($query->result_array() as $row)
		{
			$status_feeds[] = array(
				'message' 	=> $this->unicode_escape_sequences($row['message']),
				'datetime'	=> date("F j, Y - H:i A", (strtotime($row['datetime'])))
			);
		}

		$query->free_result();

		return $status_feeds;

	}

	function unicode_escape_sequences($str){
		$working = json_encode($str);
		$working = preg_replace('/\\\u([0-9a-z]{4})/', '&#x$1;', $working);
		return json_decode($working);
	}



}


?>