<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archive extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
		$this->load->helper("news");
		$this->load->library("news_library");
		$this->load->model(array("blog/blog_model"));
        $this->data['company_config'] = all_config();
	}

	public function index($year="", $month="", $date="")
	{
		$year = (int)$year;
		$month = (int)$month;
		$date = (int)$date;
		if(!$year && !$month && !$date) { redirect(base_url()); return; }

		$urldate = date('Y-m-d',mktime(0,0,0,$month,$date,$year));

		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

		$this->data['latest_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1), $limit=12, array('latest_news'=>TRUE));
		$this->data['right_side'] = "blog/right-side";
		$this->data['category_rows'] = $this->blog_model->list_with_category(array("parent_id"=>0), array("limit"=>1500, "news_limit"=>1800, "date"=>$urldate));

		$this->data['segment'] = "blog/archive";
		$this->load->view('template', $this->data);
	}
}