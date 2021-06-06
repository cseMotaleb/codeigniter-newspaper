<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller {

	public $data = array();

	private $table = "config";

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('core/config_model', 'admin/login_model'));
		$this->login_model->auth_user();
		$this->config->load_db_items();		
	}

	public function index($offset=0)
	{
		$this->batch_model->render_page("admin/config/config", $this->data);
	}
	
	public function manage()
	{
        $this->form_validation->set_rules('option', 'Option', 'trim|required|callback_check_option');
        $this->form_validation->set_rules('group', 'Group', 'trim|required');
        $this->form_validation->set_rules('value', 'Value', 'trim|required');
		if ($this->form_validation->run('config') == TRUE) {
			$db_status = $this->config_model->save_config();
			if($db_status) {

				$response['mcode'] = 200;
				$response['mtitle'] = "Saved!";
				$response['mcontent'] = "Your form was submitted and information saved successfully!";
				$response['mcolor'] = "#5F895F";
				$response['data_mode'] = "edit";
				$response['miconSmall'] = "fa fa-success shake animated";
				echo json_encode($response);				  			
			}			
		}
		else {
			if(validation_errors()) {
				$response['mcode'] = 500;
				$response['mtitle'] = "Error Raised!";
				$response['mcontent'] = validation_errors();
				$response['mcolor'] = "#C46A69";
				$response['miconSmall'] = "fa fa-warning shake animated";
				echo json_encode($response);
			}
		}

		return;
	}

	public function check_option($option)
	{
		$exists = $this->batch_model->row_counter(array('option'=>$option), $this->table);
		if($exists) {
			$this->form_validation->set_message('check_option', 'Option already is being used. Please try with another Option.');
			return FALSE;
		}
		else { return TRUE; }
	}

	public function get_config($filters=array(), $limit=10, $offset=0)
	{
		 return $this->config_model->get_config($filters, $limit, $offset);
	}

	public function ajax_update()
	{
		$db_status = $this->config_model->update_ajax();		
		if($db_status) {
			$response['mcode'] = 200;
			$response['mtitle'] = "Saved!";
			$response['mcontent'] = "Your form was submitted and information saved successfully!";
			$response['mcolor'] = "#5F895F";
			$response['data_mode'] = "edit";
			$response['miconSmall'] = "fa fa-success shake animated";
			echo json_encode($response);
		}
		else {
			$response['mcode'] = 500;
			$response['mtitle'] = "Error Raised!";
			$response['mcontent'] = validation_errors();
			$response['mcolor'] = "#C46A69";
			$response['miconSmall'] = "fa fa-warning shake animated";
			echo json_encode($response);
		}
	}		
	
	public function delete()
	{
		$config_id = $this->input->get('id');
		if($config_id) {
			
			$configs = get_rows(array('table'=>$this->table, 'limit'=>1), array('id'=>$config_id));
			$delete = isset($configs['delete']) ? $configs['delete'] : 0;
			if($delete == 1) {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $config_id;
				$this->batch_model->delete_rows('config', $comparison_fields);
				echo 1; return;		
			}
		}
		echo 0; return;	
	}

//site languages
	public function languages($mode='add', $id=0, $offset=0)
	{
		$valid_modes = array('add', 'edit', 'delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		$this->data['mode'] = $mode;
		$this->data['lan_id'] = $id;

		$this->form_validation->set_rules('key', 'Key', 'required|trim|callback_check_key');
		$this->form_validation->set_rules('language', 'Language', 'required|trim');
		$this->form_validation->set_rules('set', 'Set', 'required|trim');
		$this->form_validation->set_rules('text', 'Text', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data['key'] = $this->input->post('key');
			$parsed_data['language'] = $this->input->post('language');
			$parsed_data['set'] = $this->input->post('set');
			$parsed_data['text'] = $this->input->post('text');

			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save($this->language_table, $parsed_data, $comparison_fields);	

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
				ajax_json_encode(array('validation_errors'=>1)); return;
			}			
		}

		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->language_table, $comparison_fields);
			echo 1; return;
		}

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows(array('table'=>$this->language_table, 'limit'=>1), array('id'=>$id));
			if(isset($return_data['id'])) {
				$this->data['lang_data'] = $return_data;
			}
			else { $this->data['mode'] = 'add'; }
		}

		$filters = array();
		$sql_properties = array('table'=>$this->language_table, 'limit'=>15, 'offset'=>$offset, "order_by"=>"id", "order_type"=>"desc");
		if($_GET) {
			$key = $this->input->get("key");
			if($key) {
				$filters['key'] = $key;
			}
			$lang = $this->input->get("language");
			if($lang) {
				$filters['language'] = $lang;
			}
			$set = $this->input->get("set");
			if($set) {
				$filters['set'] = $set;
			}
			$text = $this->input->get("text");
			if($text) {
				$sql_properties['like'][] = "text";
				$sql_properties['like_value'][] = $text;
			}
		}

		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->language_table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($filters, $this->language_table, "#config/languages/show/0/", 15, 6, $total_results);

		$this->batch_model->render_page("admin/config/language", $this->data);
	}

	public function check_key($key)
	{
		$lan = $this->input->post("language");
		$set = $this->input->post("set");
		$exists = $this->batch_model->row_counter(array('key'=>$key, 'language'=>$lan, 'set'=>$set, 'id !='=>$this->input->post('id')), $this->language_table);
		if($exists) {
			$this->form_validation->set_message('check_key', 'Key already is being used. Please try with another Key.');
			return FALSE;
		}
		else { return TRUE; }
	}

}