<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Faqs extends CI_Controller {

	var $data = array();

	var $table = 'faqs';

	var $table_group = 'faq_groups';
   
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model', 'cms/faqs_model'));
		$this->login_model->auth_user();
	}

	public function index($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('search', 'add', 'edit', 'delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if ($mode == 'bulk_delete') {
			$ids = $this->input->post("bulk_delete");
			$this->batch_model->delete_rows($this->table, NULL, $ids);
			echo 1; return;
		}

		$this->form_validation->set_rules('question', 'Question', 'required|trim');
		$this->form_validation->set_rules('group_id', 'Group id', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Enabled', 'required|trim');
		$this->form_validation->set_rules('answer', 'Answer', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data = $this->faqs_model->parsed_data();
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

		$this->data['langs'] = "";
		$sql_properties = $this->faqs_model->sql_properties(1);
		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table, $comparison_fields);
		}   

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows($sql_properties, array("{$this->table}.id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else $this->data['mode'] = 'add';
		}

		$limit = 15;
		$filters = array();
		$site_url = "#faqs/index/show/0/";
		$uri_segment = 6;
		$sql_properties = $this->faqs_model->sql_properties($limit, $offset);

		if($mode == "search") {
			$site_url = "#faqs/index/search/0/";
			$this->data['question'] = $this->input->get("question");
			if($this->data['question']) {
				$sql_properties["like"] = "question";
				$sql_properties["like_value"] = $this->data['question'];
			}

			$this->data['group_id'] = $this->input->get("group_id");
			if($this->data['group_id']) {
				$filters["{$this->table}.group_id"] = $this->data['group_id'];
			}

			$this->data['enabled'] = $this->input->get("enabled");
			if($this->data['enabled'] != '') {
				$filters["{$this->table}.enabled"] = $this->data['enabled'];
			}
		}

		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, $site_url, $limit, $uri_segment, $total_results);
		$this->batch_model->render_page("admin/addons/faqs/faqs", $this->data);
	}
	
	public function groups($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('search', 'add', 'edit', 'delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if ($mode == 'bulk_delete') {
			$ids = $this->input->post("bulk_delete");
			$this->batch_model->delete_rows($this->table_group, NULL, $ids);
			echo 1; return;
		}

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Enabled', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data = $this->faqs_model->parsed_group_data();
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save($this->table_group, $parsed_data, $comparison_fields);	

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

		$sql_properties = $this->faqs_model->group_sql_properties(1);
		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table_group, $comparison_fields);
			echo 1; return;
		}   

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows($sql_properties, array("{$this->table_group}.id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else $this->data['mode'] = 'add';
		}

		$limit = 15;
		$filters = array();
		$site_url = "#faqs/groups/show/0/";
		$uri_segment = 6;
		$sql_properties = $this->faqs_model->group_sql_properties($limit, $offset);

		if($mode == "search") {
			$site_url = "#faqs/groups/search/0/";
				
			$this->data['name'] = $this->input->get("name");
			if($this->data['name']) {
				$sql_properties["like"] = "name";
				$sql_properties["like_value"] = $this->data['name'];
			}

			$this->data['enabled'] = $this->input->get("enabled");
			if($this->data['enabled'] != '') {
				$filters["{$this->table_group}.enabled"] = $this->data['enabled'];
			}
		}

		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table_group, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table_group, $filters, $site_url, $limit, $uri_segment, $total_results);
		$this->batch_model->render_page("admin/addons/faqs/group", $this->data);
	}
	
	public function ajax_status_update($group = 0)
	{
		$db_status = $this->batch_model->ajax_single_update(($group) ? $this->table_group : $this->table);
		if($db_status) {
			$this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1); return;
		}
		else {
			$this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!")); return;
		}
	}	
}