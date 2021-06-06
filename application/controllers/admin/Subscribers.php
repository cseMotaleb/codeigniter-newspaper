<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribers extends CI_Controller {

	var $data = array();

	var $table = 'subscribers';

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model','cms/subscribers_model'));
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

		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Status', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data = $this->subscribers_model->parsed_data();
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

		$sql_properties = $this->subscribers_model->sql_properties(1);
		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table, $comparison_fields);
			echo 1; return;
		}

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows($sql_properties, array("{$this->table}.id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else $this->data['mode'] = 'add';
		}


		$limit = 15;
		$filters = array();
		$site_url = "#subscribers/index/show/0/";
		$uri_segment = 6;
		$sql_properties = $this->subscribers_model->sql_properties($limit, $offset);

		if(isset($_GET)) {
			$search = $this->input->get("search");
			if($search) {
				$this->data['name'] = $this->input->get("name");
				if($this->data['name']) {
					$sql_properties["like"] = "name";
					$sql_properties["like_value"] = $this->data['name'];
				}
				$this->data['email'] = $this->input->get("email");
				if($this->data['email']) {
					$filters["{$this->table}.email"] = $this->data['email'];
				}
				$this->data['enabled'] = $this->input->get("enabled");
				if($this->data['enabled'] != '') {
					$filters["{$this->table}.enabled"] = $this->data['enabled'];
				}
			}
		}

		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, $site_url, $limit, $uri_segment, $total_results);
		$this->batch_model->render_page("admin/addons/subscribers/list", $this->data);
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