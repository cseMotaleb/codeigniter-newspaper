<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$rows = $this->batch_model->get_rows(array("table"=>"blog_groups", "limit"=>10000), array("parent_id !="=>0));
		foreach ($rows as $key => $row) {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $row['id'];
			$this->batch_model->delete_rows("blog_groups", $comparison_fields);
		}
	}
}