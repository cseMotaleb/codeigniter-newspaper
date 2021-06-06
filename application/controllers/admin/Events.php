<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

	var $data = array();

	var $table = 'events';

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model', 'cms/events_model'));
		$this->login_model->auth_user();
	}

	public function index($offset=0)
	{

		$limit = 15;
		$filters = array();
		$sql_properties = $this->events_model->sql_properties($limit, $offset);

		if($_GET) {
			$this->data['title'] = $this->input->get("title");
			if($this->data['title']) {
				$sql_properties["like"] = "title";
				$sql_properties["like_value"] = $this->data['title'];
			}
			$this->data['event_address'] = $this->input->get("event_address");
			if($this->data['event_address']) {
				$filters["{$this->table}.event_address"] = $this->data['event_address'];
			}
			$this->data['start_date'] = $this->input->get("start_date");
			if($this->data['start_date']) {
				$filters["{$this->table}.start_date"] = $this->data['start_date'];
			}
			$this->data['enabled'] = $this->input->get("enabled");
			if($this->data['enabled']) {
				$filters["{$this->table}.enabled"] = $this->data['enabled'];
			}
		}

		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#events/index/", $limit, 4, $total_results);
		$this->batch_model->render_page("admin/addons/events/list", $this->data);
	}

	public function manage($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('add', 'edit', 'delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if ($mode == 'bulk_delete') {
			$ids = $this->input->post("bulk_delete");
			$this->batch_model->delete_rows($this->table, NULL, $ids);
			echo 1; return;
		}

		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		$this->form_validation->set_rules('event_address', 'Event Address', 'required|trim');
		$this->form_validation->set_rules('start_date', 'Start Date', 'required|trim');
		$this->form_validation->set_rules('end_date', 'End Date', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Status', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data = $this->events_model->parsed_data();
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save($this->table, $parsed_data, $comparison_fields);	

			if($mode == 'add') $id = $db_status;

			if($db_status) {
				$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!'), 1);
				return;
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
			echo 1; return;
		}

		elseif($mode == 'edit') {
			$sql_properties = $this->events_model->sql_properties(1);
			$return_data = $this->batch_model->get_rows($sql_properties, array("{$this->table}.id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else $this->data['mode'] = 'add';
		}

		$this->batch_model->render_page("admin/addons/events/manage", $this->data);
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

	public function search_url()
	{
		$o = $this->input->get('o');
		$t = $this->input->get('t');
		$urls = $this->batch_model->search(array('table'=>'pages', 'limit'=>150, 'like'=>'url', 'keyword'=>$t));
		echo $this->batch_model->search_result_json($urls);
	}	
}