<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	public $data = array();
	
	var $user_type;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/login_model');	
		$this->config->load_db_items();
		$this->login_model->auth_user();
		
		$this->user_type = $this->session->userdata("user_type");
		if($this->user_type != "Admin") { echo "Invalid token!"; exit; }
	}

	public function userlist($oofset=0)
	{
		$limit = 15;
		$filters = array();
		$this->data['rows'] = $this->batch_model->get_rows(array("table"=>"users", "limit"=>$limit), $filters);
		$this->data['pagination'] = $this->batch_model->pagination("users", $filters, "#users/userist/", $limit, 4);
		$this->batch_model->render_page("admin/users/list", $this->data);
	}

	public function manage($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('add', 'edit', 'delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|callback_check_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Status', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$additional_data = array(
                                'user_type' => $this->input->post('user_type'),
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'email'      => strtolower($this->input->post('email')),
				'password'   => $this->input->post('password'),
				'enabled'    => $this->input->post('enabled')
			);
			if($mode == "add") $additional_data['user_type'] = "Employee";
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save("users", $additional_data, $comparison_fields);	

			if($mode == 'add') $id = $db_status;

	        if($id && isset($_FILES['userfile']['name'])) {
	            $ext = @pathinfo($_FILES['userfile']['name']);
	            if(isset($ext['extension'])) {
	                $fileExt = $ext['extension'];

	                $config['overwrite'] = TRUE;
	                $config['upload_path'] = "./uploads/agents/";
	                $config['allowed_types'] = 'jpg|png|jpeg';
	                $config['file_name']  = "{$id}.{$fileExt}";
	                $this->load->library('upload', $config);
	                if ($this->upload->do_upload()) {
	                    $upload_data = $this->upload->data();
	                    $config['overwrite'] = TRUE;
	                    $config['image_library'] = 'gd2';
	                    $config['source_image'] = "./uploads/agents/{$upload_data['file_name']}";
	                    $config['create_thumb'] = FALSE;
	                    $config['maintain_ratio'] = FALSE;
	                    $this->load->library('image_lib', $config);         
	                    $this->image_lib->resize();

						$comparison_fields['name'] = 'id';
						$comparison_fields['value'] = $id;
	                    $parsed_data['image'] = $upload_data['file_name'];
	                    $db_status1 = $this->batch_model->save('users', $parsed_data, $comparison_fields);
	                    
						$db_status = ($db_status) ? $db_status : $db_status1;
	                }
	            }
	        }

			if($db_status) {
				$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"add", 'return_id'=>0), 1); return;
			}
			else {
              	$this->batch_model->ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>"")); return;
			}
		}
		else {
			if(validation_errors()) {
				$this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
			}			
		}

		if($mode == 'delete') {
			$check_agent = $this->batch_model->get_rows(array("table"=>"users", "limit"=>1), array("id"=>$id));
			if(isset($check_agent['image'])) { @unlink("./uploads/agents/{$check_agent['image']}"); }

			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows("users", $comparison_fields);
			echo 1; return;
		}   

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows(array("table"=>"users", "limit"=>1), array("id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		}

		$this->batch_model->render_page("admin/users/manage", $this->data);
	}

	function index($mode='add', $id=0)
	{
		$valid_modes = array('add','edit','delete','show');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if($this->input->post('oper') == 'edit') {
			$id = $this->input->post('id');
		}

		if(!$id && $mode == 'edit') $mode = 'add';

		if($mode == 'show') {
			$this->show();
			return;
		}
		else if($mode == 'delete' || $this->input->post('oper') == 'del') {
			$id = $this->input->post('id');
			if(!empty($id)) $this->delete($id);
			return;
		}

		if($mode == 'add' || $mode == 'edit') {
			$comparison_fields = NULL;
			
			if($mode == 'edit') {
				$filters = array('users.id'=>$id);	
				
				$return_data = $this->batch_model->get_rows(array("select"=>"users.*", 'table'=>'users', 'limit'=>1), $filters);
				if(count($return_data) < 1) {
					ajax_json_encode(array('mcontent'=>'Invalid request. If you see this message by any error, please refresh page.'));
					return;
				}

				$comparison_fields['name'][] = 'id';
				$comparison_fields['value'][] =	$id;										
			}
			//validate form input

			$this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
			$this->form_validation->set_rules('email', 'E-mail', 'required|trim|valid_email|callback_check_email');
			$this->form_validation->set_rules('password', 'Password', 'required|trim');
			$this->form_validation->set_rules('enabled', 'Status', 'required|trim');
			if ($this->form_validation->run() == true) {
				$additional_data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),
					'enabled' => $this->input->post('enabled')
				);
				$status = $this->batch_model->save('users', $additional_data, $comparison_fields);

				if($mode == 'add') $id = $status;

				if($status) {
					ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"edit", 'zone_id'=>$id), 1);
				}
				else {
					ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>"edit", 'zone_id'=>$id));
				}
				return;
			}
			else {	
				$this->data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
				if(validation_errors()) {
					ajax_json_encode(array('validation_errors'=>1));
					return;
				}

				$this->data['first_name'] = array(
					'name'  => 'first_name',
					'id'    => 'first_name',
					'type'  => 'text',
					'value' => ($mode == 'edit') ? ((isset($return_data['first_name']) ?  $return_data['first_name'] : $this->form_validation->set_value('first_name'))) : $this->form_validation->set_value('first_name')
				);
				$this->data['last_name'] = array(
					'name'  => 'last_name',
					'id'    => 'last_name',
					'type'  => 'text',
					'value' => ($mode == 'edit') ? ((isset($return_data['last_name']) ?  $return_data['last_name'] : $this->form_validation->set_value('last_name'))) : $this->form_validation->set_value('last_name')
				);
				$this->data['email'] = array(
					'name'  => 'email',
					'id'    => 'email',
					'type'  => 'text',
					'value' => ($mode == 'edit') ? ((isset($return_data['email']) ?  $return_data['email'] : $this->form_validation->set_value('email'))) : $this->form_validation->set_value('email')
				);
				$this->data['password'] = array(
					'name'  => 'password',
					'id'    => 'password',
					'type'  => 'password',
					'value' => ($mode == 'edit') ? ((isset($return_data['password']) ?  $return_data['password'] : $this->form_validation->set_value('password'))) : $this->form_validation->set_value('password')
				);
				$this->data['enabled'] = array(
					'name'  => 'enabled',
					'id'    => 'enabled',
					'value' => ($mode == 'edit') ? ((isset($return_data['enabled']) ?  $return_data['enabled'] : $this->form_validation->set_value('enabled'))) : $this->form_validation->set_value('enabled')
				);
				$this->data['cur_id'] = $id;
				$this->data['mode'] = $mode;
				$this->batch_model->render_page("admin/profile/user-manage", $this->data);
			}	
		}
	}

	public function show()
	{
		$this->batch_model->render_page("admin/profile/user-list"); return;
	}

	public function cdata()
	{
		$this->batch_model->cdata('users', array());
		return;
	}

	public function delete($ids=0)
	{
		if(!$ids) return FALSE;

		$ids = explode(',', $ids);
		foreach($ids as $key => $id) {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows('users', $comparison_fields);
		}
		return TRUE;
	}

	public function check_email_json()
	{
		$email = $this->input->get('email');
		$json['status'] = $this->batch_model->existing_json(array('table'=>'users', 'where'=>'email', 'where_value'=>$email));
		echo json_encode($json);
		return;
	}
	
	public function check_email($email)
	{
		$exists = $this->batch_model->row_counter(array('email'=>$email, 'id !='=>$this->input->post('id')), 'users');
		if($exists) {
			$this->form_validation->set_message('check_email', 'E-mail already is being used. Please try with another E-mail.');
			return FALSE;
		}
		else { return TRUE; }
	}
}