<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
        $this->data['company_config'] = all_config();
	}

	public function index()
	{
		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}

		$meta_data = $this->batch_model->get_rows(array("table"=>"pages", "limit"=>1), array("url"=>"blog", "status"=>"Private"));
        if(isset($meta_data['id'])) {
	        $this->data['page'] = array(
	                                "meta_title" => $meta_data['meta_title'],
	                                "meta_keyword" => $meta_data['meta_keyword'],
	                                "meta_description" => $meta_data['meta_description'],
	                                "url" => "contact-us"
	                            );
		}

		$this->data['segment'] = "blog/list";
		$this->data['quotes'] = TRUE;

		$this->load->view('template', $this->data);
	}
}