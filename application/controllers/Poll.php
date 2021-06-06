<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poll extends CI_Controller {

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

	public function index($poll_id=0, $url='')
	{
		if(!$poll_id && !$url) { redirect(site_url("polls")); return; }

		$url = urldecode($url);
		$return_data = $this->polls_model->get_rows(array("enabled"=>1, "id"=>$poll_id), 1);
		$poll_row = $return_data['rows'];
		if(!isset($poll_row['id'])) { redirect(site_url("polls")); return; }

		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

        $this->data['page'] = array(
                                "meta_title" => "{$poll_row['poll']} || " . $this->config->item("company_name"),
                                "meta_keyword" => "{$poll_row['poll']} || " . $this->config->item("company_name"),
                                "meta_description" => "{$poll_row['poll']} || " . $this->config->item("company_name"),
                                "url" => "poll/{$poll_id}/{$url}"
                            );
		$this->data['breadcrumb'] = "<a href=\"".site_url("polls")."\" class=\"btn btn-default\">অনলাইন জরিপ</a>";
		$this->data['segment'] = "poll/details";
		$this->data['poll_row'] = $poll_row;

		$return_data = $this->polls_model->get_rows(array("enabled"=>1), $limit=10);
		$this->data['poll_rows'] = $return_data['rows'];
		$this->load->view('template', $this->data);
	}
}