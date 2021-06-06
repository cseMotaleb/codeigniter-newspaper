<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polls extends CI_Controller {

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

	public function index($offset=0)
	{
		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

        $this->data['page'] = array(
                                "meta_title" => "Opinion Poll || " . $this->config->item("company_name"),
                                "meta_keyword" => "Opinion Poll || " . $this->config->item("company_name"),
                                "meta_description" => "Opinion Poll || " . $this->config->item("company_name"),
                                "url" => "polls"
                            );
		$this->data['breadcrumb'] = "<a href=\"#\" class=\"btn btn-default\">অনলাইন জরিপ</a>";

		$return_data = $this->polls_model->get_rows(array("enabled"=>1), $limit=50, $offset);
		$this->data['poll_rows'] = $return_data['rows'];
		$this->data['segment'] = "poll/list";
		$this->load->view('template', $this->data);
	}
}
