<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

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
                                "meta_title" => "ভিডিও গ্যালারি - " . $this->config->item("company_name"),
                                "meta_keyword" => "ভিডিও গ্যালারি - " . $this->config->item("company_name"),
                                "meta_description" => "ভিডিও গ্যালারি - " . $this->config->item("company_name"),
                                "url" => "video"
                            );

		$this->data['most_readed'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog.type"=>"Video"), $limit=6);
		$this->data['more_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog.type"=>"Video"), $limit=12, array('more_news'=>TRUE));
		$this->data['latest_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1), $limit=12, array('latest_news'=>TRUE));
		$this->data['right_side'] = "blog/right-side";
		$this->data['segment'] = "blog/video-list";
		$this->data['breadcrumb'] = "<a href=\"#\" class=\"btn btn-default\">ভিডিও গ্যালারি</a>";

		$return_data = $this->blog_model->get_blogs(array("blog.type"=>"Video", "blog.slider"=>1, "blog.enabled"=>1), $limit=6);
		$this->data['slider_news'] = $return_data['blogs'];

		$this->data['category_rows'] = $this->blog_model->list_with_category(array("parent_id"=>0), array("news_limit"=>12, 'blog_type'=>"Video", "limit"=>100));
		$this->load->view('template', $this->data);
	}
}
