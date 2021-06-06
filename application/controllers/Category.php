<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
        $this->data['company_config'] = all_config();
		$this->load->helper("news");
		$this->load->library("news_library");
		$this->load->model("blog/blog_model");
	}

	public function index($url="", $parent_url="")
	{
		if(!$url) { redirect(base_url()); return; }
		$url = urldecode($url);
		$parent_url = urldecode($parent_url);
		
		$type = $this->input->get("type");

		$check_category = $this->batch_model->get_rows(array("table"=>"blog_groups", "limit"=>1), array("category_url"=>$url, "enabled"=>1));
		if(!isset($check_category['id'])) { redirect(base_url()); return; }

        $this->data['page'] = array(
                                "meta_title" => $check_category['meta_title'],
                                "meta_keyword" => $check_category['meta_keyword'],
                                "meta_description" => $check_category['meta_description'],
                                "url" => "category/{$url}"
                            );

		$this->data['breadcrumb'] = "";
		if($type) {
			$type_text = ($type == "photo") ? 'ফটো গ্যালারি' : 'ভিডিও গ্যালারি';
			$type_url = ($type == "photo") ? site_url("photo") : site_url("video");
			$this->data['breadcrumb'] .= "<a href=\"{$type_url}\" class=\"btn btn-default\">{$type_text}</a>";
		}
		$this->data['breadcrumb'] .= "<a href=\"#\" class=\"btn btn-default\">{$check_category['category']}</a>";
		$this->data['category_data'] = $check_category;

		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}
		$this->data['segment'] = "blog/list";
		if($url && $parent_url) {
			$this->parent_details($this->data, $parent_url, $url); return;
		}


		$this->data['most_readed'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog_categories.category_id"=>$check_category['id']), $limit=6);
		$this->data['more_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog_categories.category_id"=>$check_category['id']), $limit=12, array('more_news'=>TRUE));
		$this->data['latest_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1), $limit=12, array('latest_news'=>TRUE));
		$this->data['right_side'] = "blog/right-side";

		$filters = array("blog.enabled"=>1, "blog_categories.category_id"=>$check_category['id'], "highlight_blog.page"=>"Category");
		if($type == "photo") $filters["blog.type"] = "Gallery";
		elseif($type == "video") $filters["blog.type"] = "Video";
		
		$this->data['news_rows'] = $this->blog_model->get_highlight_blogs($filters, $limit=10);
		$total_news = count($this->data['news_rows']);
		$limit = (17 - $total_news);


		$properties = array();
		$ids = array();
		foreach ($this->data['news_rows'] as $key => $row) {
			$ids[] = $row['id'];
		}
		if(count($ids) > 0) {
			$properties['where_not_in'] = "blog.id";
			$properties['where_not_in_array'] = $ids;
		}


		unset($filters['highlight_blog.page']);
		$news_rows = $this->blog_model->get_blogs($filters, $limit, 0, $properties);
		$this->data['other_news_rows'] = $news_rows['blogs'];
		$this->data['news_rows'] = @array_merge($this->data['news_rows'], $this->data['other_news_rows']);
//print_r($this->data['news_rows']);
		$this->load->view('template', $this->data);
	}

	public function parent_details($data=array(), $parent_url="", $url="")
	{
		$data['breadcrumb'] = "<a href=\"".site_url("category/{$url}")."\" class=\"btn btn-default\">{$data['category_data']['category']}</a>";
		$check_category = $this->batch_model->get_rows(array("table"=>"blog_groups", "limit"=>1), array("category_url"=>$parent_url, "enabled"=>1));
		if(!isset($check_category['id'])) { redirect(base_url()); return; }
		$data['breadcrumb'] .= "<a href=\"#\" class=\"btn btn-default\">{$check_category['category']}</a>";

		$type = $this->input->get("type");

        $data['page'] = array(
                                "meta_title" => $check_category['meta_title'],
                                "meta_keyword" => $check_category['meta_keyword'],
                                "meta_description" => $check_category['meta_description'],
                                "url" => "category/{$url}/{$parent_url}"
                            );
		$data['parent_category_data'] = $check_category;

		$data['most_readed'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog_categories.parent_id"=>$check_category['id']), $limit=6);
		$data['more_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog_categories.parent_id"=>$check_category['id']), $limit=12, array('more_news'=>TRUE));
		$data['latest_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1), $limit=12, array('latest_news'=>TRUE));
		$data['right_side'] = "blog/right-side";


		$filters = array("blog.enabled"=>1, "blog_categories.parent_id"=>$check_category['id']);
		if($type == "photo") $filters["blog.type"] = "Gallery";
		elseif($type == "video") $filters["blog.type"] = "Video";
		$news_rows = $this->blog_model->get_blogs($filters, $limit=17);
		$data['news_rows'] = $news_rows['blogs'];


		$this->load->view('template', $data);
	}
}