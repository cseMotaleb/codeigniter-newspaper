<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Widgets extends CI_Controller {

	public $data = array();
   
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model', 'widgets_model'));
		$this->login_model->auth_user();
	}

	public function index($offset=0)
	{
		$limit = 25;
		$filters = array();

		$return_data = $this->widgets_model->get_rows($filters, $limit, $offset);
		$this->data['rows'] = $return_data['rows'];
		$this->data['pagination'] = $return_data['pagination'];
		$this->load->view("admin/widgets/list", $this->data);
	}

	public function manage($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('add', 'edit', 'delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('description', 'Description', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$filters = array();
			if($mode == "edit" && $id) $filters = array("id"=>$id);
			$db_status = $this->widgets_model->save($filters, $mode, $id);	

			if($mode == 'add') $id = $db_status;

			if($db_status) {
				$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"add", 'return_id'=>0), 1);
				return;
			}
			else {
              	$this->batch_model->ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>"", 'lang_id'=>$id));
				return;
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
			$this->widgets_model->delete_rows("widgets", $comparison_fields);
			echo 1; return;
		}
		elseif ($mode == 'edit') {
			$return_data = $this->widgets_model->get_rows(array("widgets.id"=>$id), 1);
			if(isset($return_data['rows']['id'])) $this->data['widget'] = $return_data['rows'];
			else $mode = "add";
		}

		$this->load->view("admin/widgets/manage", $this->data);
	}

	public function ajax_status_update()
	{
		$db_status = $this->widgets_model->ajax_single_update("widgets");
		if($db_status) {
			$this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1); return;
		}
		else {
			$this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!")); return;
		}
	}
}