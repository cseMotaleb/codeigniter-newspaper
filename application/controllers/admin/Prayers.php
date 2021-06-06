<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prayers extends CI_Controller {

	var $data = array();

	var $table = 'prayers';
   
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model'));
		$this->login_model->auth_user();
	}

	public function index($offset=0)
	{
		$limit = 15;
		$filters = array();
		$sql_properties['table'] = "prayers";
		$sql_properties['limit'] = $limit;
		$sql_properties['offset'] = $offset;
		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#prayers/index/", $limit, 4);
		$this->batch_model->render_page("admin/addons/prayers/list", $this->data);
	}

	public function manage($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('add', 'edit', 'delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		$this->form_validation->set_rules('date', 'Date', 'required|trim');
		$this->form_validation->set_rules('prayer1', 'Prayer', 'required|trim');
		$this->form_validation->set_rules('prayer2', 'Prayer', 'required|trim');
		$this->form_validation->set_rules('prayer3', 'Prayer', 'required|trim');
		$this->form_validation->set_rules('prayer4', 'Prayer', 'required|trim');
		$this->form_validation->set_rules('prayer5', 'Prayer', 'required|trim');
		$this->form_validation->set_rules('default', 'Default', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data['date'] = $this->input->post("date");
			$parsed_data['prayer1'] = $this->input->post("prayer1");
			$parsed_data['prayer2'] = $this->input->post("prayer2");
			$parsed_data['prayer3'] = $this->input->post("prayer3");
			$parsed_data['prayer4'] = $this->input->post("prayer4");
			$parsed_data['prayer5'] = $this->input->post("prayer5");
			$parsed_data['prayer6'] = $this->input->post("prayer6");
			$parsed_data['default'] = $this->input->post("default");
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

		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table, $comparison_fields);
		}   

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows(array("table"=>"prayers", "limit"=>1), array("{$this->table}.id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else $this->data['mode'] = 'add';
		}

		$this->batch_model->render_page("admin/addons/prayers/manage", $this->data);
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