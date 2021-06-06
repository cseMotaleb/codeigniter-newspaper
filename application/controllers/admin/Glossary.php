<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Glossary extends CI_Controller {

	var $data = array();

	var $table = 'glossary';

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model'));
		$this->login_model->auth_user();
	}

	public function index($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('search', 'add', 'edit', 'delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('details', 'Details', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Enabled', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data['title'] = $this->input->post("title");
			$parsed_data['details'] = $this->input->post("details");
			$parsed_data['enabled'] = $this->input->post("enabled");
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save($this->table, $parsed_data, $comparison_fields);	

			if($mode == 'add') $id = $db_status;

			if($db_status) {
				$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!'), 1); return;
			}
			else {
              	$this->batch_model->ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!')); return;
			}
		}
		else {
			if(validation_errors()) {
				$this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
			}			
		}


		$limit = 15;
		$filters = array();
		$site_url = "#glossary/index/show/0/";
		$uri_segment = 6;
		$sql_properties["table"] = $this->table;
		$sql_properties["limit"] = $limit;
		$sql_properties["offset"] = $offset;
		$sql_properties["order_by"] = "title";
		$sql_properties["order_type"] = "asc";
		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table, $comparison_fields);
		}   

		elseif($mode == 'edit') {
			$sql_properties["limit"] = 1;
			$sql_properties["offset"] = 0;
			$return_data = $this->batch_model->get_rows($sql_properties, array("{$this->table}.id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else $this->data['mode'] = 'add';
		}

		if($mode == "search") {
			$site_url = "#glossary/index/search/0/";
			$this->data['title'] = $this->input->get("title");
			if($this->data['title']) {
				$sql_properties["like"] = "title";
				$sql_properties["like_value"] = $this->data['title'];
			}

			$this->data['enabled'] = $this->input->get("enabled");
			if($this->data['enabled'] != '') {
				$filters["{$this->table}.enabled"] = $this->data['enabled'];
			}
		}

		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, $site_url, $limit, $uri_segment, $total_results);
		$this->batch_model->render_page("admin/addons/glossary", $this->data);
	}

	public function ajax_status_update()
	{
		$db_status = $this->batch_model->ajax_single_update($this->table);
		if($db_status) $this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1);
		else $this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!"));
		return;
	}	
}