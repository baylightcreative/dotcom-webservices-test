<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_mentions extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$url = "http://meltwaternews.com/magenta/xml/html/25/49/143953.html.XML";

		$xml = simplexml_load_file($url);

		echo "<pre>"; print_r($xml); echo "</pre>"; exit();

		$this->load->view('news_mentions.html');
	}
}


?>