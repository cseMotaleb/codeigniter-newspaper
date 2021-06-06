<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

		$this->data['segment'] = "welcome";
		$this->data['full_width'] = TRUE;
		$this->data['banner'] = TRUE;
		$this->data['top_highlight'] = TRUE;

		$return_data = $this->blog_model->get_blogs(array("blog.enabled"=>1, "blog.slider"=>1), $limit=7);
		$this->data['slider_news'] = $return_data['blogs'];

		$return_data = $this->blog_model->get_blogs(array("blog.enabled"=>1, "blog.homepage"=>1, "blog.type"=>"List"), $limit=12);
		$this->data['homepage_news'] = $return_data['blogs'];
		//$this->data['homepage_news'] = $this->blog_model->get_highlight_blogs(array("blog.enabled"=>1, "highlight_blog.page"=>"home"), $limit=9);

		$this->data['category_rows'] = $this->blog_model->list_with_category(array("parent_id"=>0, "enabled"=>1), array("news_limit"=>12));
		$this->load->view('template', $this->data);
	}
}
