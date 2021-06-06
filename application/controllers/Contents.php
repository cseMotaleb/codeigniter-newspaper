<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contents extends CI_Controller {

    var $data = array();

    function __construct()
    {
        parent::__construct();
        $this->config->load_db_items();
		$this->load->helper("news");
		$this->load->library("news_library");
        $this->data['company_config'] = all_config();
        $this->load->model(array("cms/content_model", "blog/blog_model"));
    }

    public function index($page_url="")
    {
        if(!$page_url) { redirect(base_url()); }
        $sql_properties = $this->content_model->sql_properties($limit=1);
        $row_data = $this->batch_model->get_rows($sql_properties, array('pages.url'=>$page_url, 'pages.status'=>'Public'));
        if(!$row_data['id']) { redirect(base_url()); }

		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

        $this->data['page'] = array(
                                "meta_title" => $row_data['meta_title'],
                                "meta_keyword" => $row_data['meta_keyword'],
                                "meta_description" => $row_data['meta_description'],
                                "url" => $page_url,
                                "image" => ($row_data['page_banner']) ? $row_data['page_banner'] : "assets/images/banner.jpg"
                            );

        $this->data['row_data'] = $row_data;
        $this->data['right_side'] = FALSE;
        $this->data['segment'] = "contents/contents";
        $this->load->view('template', $this->data);
    }
}