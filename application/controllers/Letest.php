<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Letest extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
		$this->load->helper("news");
		$this->load->library("news_library");
		$this->load->model(array("blog/blog_model", "polls_model"));
        $this->data['company_config'] = all_config();
	}

	public function index()
	{
		$this->load->view("letest-news", $this->data);
	}
}