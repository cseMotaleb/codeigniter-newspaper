<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

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

	public function index($news_id=0, $url="")
	{
		if(!is_numeric($news_id)) { redirect(base_url()); return; }

		$return_data = $this->blog_model->get_blogs(array("blog.id"=>$news_id, "blog.enabled"=>1), 1, 0, array("details"=>TRUE));
		if(!isset($return_data['blogs']['id'])) { redirect(base_url()); return; }
		$blog_data = $return_data['blogs'];

		if($_POST) {
			$user_id = $this->session->userdata("user_id");
			$this->form_validation->set_rules('comment', 'Comment', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$parsed_data['reply_id'] = $this->input->post("reply_id");;
				$parsed_data['customer_id'] = $user_id;
				$parsed_data['blog_id'] = $blog_data['id'];
				$parsed_data['date'] = date("Y-m-d");
				$parsed_data['time'] = time();
				$parsed_data['comment'] = $this->input->post("comment");
				$parsed_data['enabled'] = 1;
				$db_status = $this->batch_model->save("blog_comments", $parsed_data);
                if($db_status) {
                    $this->data['error'] = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button><strong> Congratulations! </strong>Your comment was submitted successfully.</div><br />';
                }
                else {
                    $this->data['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button><strong> Error! </strong>Comment saved failed, Please try again.</div><br />';
                }
			}
			else {
				if(validation_errors()) $this->data['error'] = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> '.validation_errors().'</div>';
			}
		}

		$check_category = $this->batch_model->get_rows(array("table"=>"blog_groups", "limit"=>1), array("id"=>$blog_data['category_id']));
		$this->data['category_data'] = $check_category;
		if(isset($check_category['id'])) {
			if(isset($blog_data['parent_id']) && $blog_data['parent_id']) {
				$cat_url = site_url("category/{$check_category['category_url']}");
				$this->data['breadcrumb'] = "<a href=\"{$cat_url}\" class=\"btn btn-default\">{$check_category['category']}</a>";
			}
			else $this->data['breadcrumb'] = "<a href=\"#\" class=\"btn btn-default\">{$check_category['category']}</a>";
		}

		if(isset($blog_data['parent_id']) && $blog_data['parent_id']) {
			$check_pcategory = $this->batch_model->get_rows(array("table"=>"blog_groups", "limit"=>1), array("id"=>$blog_data['parent_id']));
			if(isset($check_pcategory['id'])) $this->data['breadcrumb'] .= "<a href=\"#\" class=\"btn btn-default\">{$check_pcategory['category']}</a>";
		}

		//popularity
		$this->batch_model->set(array("id"=>$blog_data['id']), array("table"=>"blog", "set_field"=>"popularity"));

        $this->data['page'] = array(
                                "meta_title" => $blog_data['title'],
                                "meta_keyword" => $blog_data['meta_keyword'],
                                "meta_description" => $blog_data['meta_description'],
                                "url" => "article/{$news_id}",
                                "meta_image" => $blog_data['default_image']
                            );

		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

		$this->data['releted_blog'] = $this->blog_model->releted_blog($blog_data, $limit=9);
		$this->data['most_readed'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog_categories.category_id"=>$blog_data['category_id'], "blog.id !="=>$blog_data['id']), $limit=6);
		$this->data['more_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog_categories.category_id"=>$blog_data['category_id'], "blog.id !="=>$blog_data['id']), $limit=12, array('more_news'=>TRUE));
		$this->data['latest_news'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog_categories.id !="=>$blog_data['id']), $limit=12, array('latest_news'=>TRUE));
		$this->data['more_news_category'] = $this->blog_model->most_readed(array("blog.enabled"=>1, "blog_categories.category_id"=>$blog_data['category_id'], "blog.id !="=>$blog_data['id'], "blog.type"=>"Gallery"), $limit=24, array('more_news'=>TRUE));
		$this->data['right_side'] = "blog/right-side";

		$this->data['blog_data'] = $blog_data;
		$this->data['segment'] = "blog/details";

		$print = $this->input->get("print");
		if($print) {
			$this->load->view("blog/print-blog", $this->data);
			return;
		}

		$this->load->view('template', $this->data);
	}
}