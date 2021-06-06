<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls extends CI_Controller {

	var $data = array();

	var $table = 'polls';

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model', "polls_model"));
		$this->login_model->auth_user();
	}

	public function index($offset=0)
	{
		$rows = $this->polls_model->get_rows($filters=array(), $limit=15, $offset);
		$this->data['rows'] = $rows['rows'];
		$this->data['pagination'] = $rows['pagination'];
		$this->batch_model->render_page("admin/polls/list", $this->data);
	}

	public function manage($mode='add', $id=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('search', 'add', 'edit', 'delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		$this->form_validation->set_rules('poll', 'Details', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Status', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$db_status = $this->polls_model->save($mode, $id);

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
			$this->polls_model->delete($id);
			echo 1; return;
		}

		elseif($mode == 'edit') {
			$return_data = $this->polls_model->get_rows(array("polls.id"=>$id), 1);
			if(isset($return_data['rows']['id'])) $this->data['row_data'] = $return_data['rows'];
			else $this->data['mode'] = 'add';
		}

		$this->batch_model->render_page("admin/polls/manage", $this->data);
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