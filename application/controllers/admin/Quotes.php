<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes extends CI_Controller {

	var $data = array();

	var $table = "quotes";

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model', 'quotes_model'));
		$this->login_model->auth_user();
        $this->config->load_db_items();
	}

	public function index($offset=0)
	{
		$limit = 15;
		$sql_properties = $this->quotes_model->sql_properties($limit, $offset);
		$filters = array();

		$this->data['rows'] =$this->batch_model->get_rows($sql_properties, $filters);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#quotes/index/", $limit, 4);
		$this->batch_model->render_page("admin/quotes/list", $this->data);
	}

	public function manage($mode='add', $id=0, $offset=0)
	{
		$valid_modes = array('add', 'edit', "view", 'delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if ($mode == 'bulk_delete') {
			$ids = $this->input->post("bulk_delete");
			$this->batch_model->delete_rows($this->table, NULL, $ids);
			echo 1; return;
		}

		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;

         $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
         $this->form_validation->set_rules('email', 'E-mail', 'valid_email|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data['first_name'] = $this->input->post('first_name');
			$parsed_data['last_name'] = $this->input->post('last_name');
			$parsed_data['contact_number'] = $this->input->post('contact_number');
			$parsed_data['phone'] = $this->input->post('phone');
			$parsed_data['email'] = $this->input->post('email');
			$parsed_data['street_address'] = $this->input->post('street_address');
			$parsed_data['suburb'] = $this->input->post('suburb');
			$parsed_data['state'] = $this->input->post('state');
			$parsed_data['postcode'] = $this->input->post('postcode');
			$parsed_data['roof_type'] = $this->input->post('roof_type');
			$parsed_data['stories'] = $this->input->post('stories');
			$parsed_data['system_size'] = $this->input->post('system_size');
			if($mode == "add") {
				$parsed_data['time'] = time();
				$parsed_data['ip'] = $this->input->ip_address();
				$parsed_data['browser'] = $this->input->user_agent();
			}
			$parsed_data['enabled'] = $this->input->post('enabled');

			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;			
			}
			$db_status = $this->batch_model->save($this->table, $parsed_data, $comparison_fields);	

			if($mode == 'add') $id = $db_status;

			if($db_status) {
				ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!'), 1); return;
			}
			else {
              	ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!')); return;
			}
		}
		else {
			if(validation_errors()) {
				ajax_json_encode(array('validation_errors'=>1)); return;
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
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else $this->data['mode'] = 'add';
		}

		elseif($mode == 'view') {
			$return_data = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1),array('id'=>$id));
			if(isset($return_data['id'])) {
				$this->data['row_data'] = $return_data;
				$this->batch_model->render_page("admin/quotes/view", $this->data);
				return;
			}
			else $this->data['mode'] = 'add';
		}

		$this->batch_model->render_page("admin/quotes/manage", $this->data);
	}

	public function reply($quote_id=0)
	{
        $this->form_validation->set_rules('sender_email', 'Sender Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('cc', 'CC', 'trim|valid_email');
        $this->form_validation->set_rules('bcc', 'BCC', 'trim|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
        	$this->load->model("feedback_model");
            $status = $this->feedback_model->reply();
            if($status) {
                $this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Mail sent successfully!'), 1); return;
            }
            else {
                $this->batch_model->ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'Mail send failed!')); return;
            }
        }
        else {
            if(validation_errors()) {
                $this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
            }           
        }

		$this->data['current_id'] = $quote_id;
		$sql_properties = $this->quotes_model->sql_properties($limit=1);
		$this->data['row_data'] =$this->batch_model->get_rows($sql_properties, $filters=array("id"=>$quote_id));
		$this->batch_model->render_page("admin/quotes/reply", $this->data);
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