<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_builder extends CI_Controller {
	
	var $data = array();

	var $table = "menu";

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model', 'cms/menu_model'));
		$this->login_model->auth_user();
	}

	public function index($offset=0)
	{
		$limit = 15;
		$sql_properties = $this->menu_model->sql_properties($limit, $offset);
		$filters = array();
		$site_url = "#menu_builder/index/";
		$uri_segment = 4;

		if(isset($_GET['search'])) {
			$this->data['name'] = $this->input->get("name");
			if($this->data['name']) {
				$sql_properties["like"] = "name";
				$sql_properties["like_value"] = $this->data['name'];
			}
			$this->data['menu_id'] = $this->input->get("menu_id");
			if($this->data['menu_id']) {
				$sql_properties["like"] = "menu_id";
				$sql_properties["like_value"] = $this->data['menu_id'];
			}
			$this->data['menu_class'] = $this->input->get("menu_class");
			if($this->data['menu_class']) {
				$sql_properties["like"] = "menu_class";
				$sql_properties["like_value"] = $this->data['menu_class'];
			}
			$this->data['enabled'] = $this->input->get("enabled");
			if($this->data['enabled'] != '') {
				$filters["{$this->table}.enabled"] = $this->data['enabled'];
			}
		}
		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, $site_url, 15, $uri_segment);
		$this->batch_model->render_page("admin/contents/menu-builder/list", $this->data);
	}
	
	public function manage($mode='add', $id=0, $offset=0)
	{
		$valid_modes = array('add', 'edit', 'delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';
		
		if ($mode == 'bulk_delete') {
			$ids = $this->input->post("bulk_delete");
			$this->batch_model->delete_rows($this->table, NULL, $ids);
			echo 1; return;
		}

		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$this->data['langs'] = "";

		$this->form_validation->set_rules('name', 'Menu Name', 'required|trim|callback_check_name');
		$this->form_validation->set_rules('enabled', 'Status', 'required|trim');
		$this->form_validation->set_rules('menuid', 'Menu ID', 'required|trim');
		$this->form_validation->set_rules('mymenu', 'Menu Content', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data = $this->menu_model->parsed_data();
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;		
			}
			$db_status = $this->batch_model->save($this->table, $parsed_data, $comparison_fields);

			if($mode == 'add') $id = $db_status;

			if($db_status) {
				ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"edit", 'zone_id'=>$id), 1);
				return;
			}
			else {
              	ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>"edit", 'zone_id'=>$id));
				return;
			}
		}
		else {
			if(validation_errors()) {
				ajax_json_encode(array('validation_errors'=>1));
				return;
			}			
		}

		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table, $comparison_fields);
			echo 1; return;
		}

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1),array('id'=>$id));
			if(isset($return_data['id'])) $this->data['menu'] = $return_data;
			else $this->data['mode'] = 'add';
		}

		$this->batch_model->render_page("admin/contents/menu-builder/manage", $this->data);
	}

	public function check_name($name)
	{
		$id = $this->input->post('id');
		if($id) $filters = array('name'=>$name, 'id !='=>$id);
		else $filters = array('name'=>$name);
		$exists = $this->batch_model->row_counter($filters, $this->table);
		if($exists) {
			$this->form_validation->set_message('check_name', 'Menu Name already is being used. Please try with another Menu Name.');
			return FALSE;
		}
		else { return TRUE; }
	}
	
	public function ajax_status_update()
	{
		$db_status = $this->batch_model->ajax_single_update($this->table);
		if($db_status) {
			$this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1); return;
		}
		else {
			$this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!")); return;
		}
	}	
}