<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Photo extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
		$this->load->helper("news");
		$this->load->library("news_library");
		$this->load->model("blog/blog_model");
        $this->data['company_config'] = all_config();
	}

	public function index()
	{
		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

        $this->data['page'] = array(
                                "meta_title" => "ফটো গ্যালারি - " . $this->config->item("company_name"),
                                "meta_keyword" => "ফটো গ্যালারি - " . $this->config->item("company_name"),
                                "meta_description" => "ফটো গ্যালারি - " . $this->config->item("company_name"),
                                "url" => "photo"
                            );

		$this->data['most_readed'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog.type"=>"Gallery"), $limit=6);
		$this->data['more_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog.type"=>"Gallery"), $limit=12, array('more_news'=>TRUE));
		$this->data['latest_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1), $limit=12, array('latest_news'=>TRUE));
		$this->data['right_side'] = "blog/right-side";
		$this->data['segment'] = "blog/photo-list";
		$this->data['breadcrumb'] = "<a href=\"#\" class=\"btn btn-default\">ফটো গ্যালারি</a>";

		$return_data = $this->blog_model->get_blogs(array("blog.type"=>"Gallery", "blog.slider"=>1, "blog.enabled"=>1), $limit=6);
		$this->data['slider_news'] = $return_data['blogs'];

		$this->data['category_rows'] = $this->blog_model->list_with_category(array("parent_id"=>0), array("news_limit"=>12, 'blog_type'=>"Gallery", "limit"=>100));
		//print_r($this->data['category_rows']);
		$this->load->view('template', $this->data);
	}
}
