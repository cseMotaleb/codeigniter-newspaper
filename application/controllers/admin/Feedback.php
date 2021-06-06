<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller {

	public $data = array();

	private $table = 'feedback';

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
		$this->load->model(array('admin/login_model', 'cms/feedback_model'));
		$this->login_model->auth_user();
	}

	public function index($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if ($mode == 'bulk_delete') {
			$ids = $this->input->post("bulk_delete");
			$this->batch_model->delete_rows($this->table, NULL, $ids);
			echo 1; return;
		}

		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table, $comparison_fields);
			echo 1; return;
		}

		$limit = 15;
		$filters = array();
		$sql_properties = $this->feedback_model->sql_properties($limit, $offset);

		if(isset($_GET)) {
			$this->data['name'] = $this->input->get("name");
			if($this->data['name']) {
				$sql_properties["like"][] = "{$this->table}.name";
				$sql_properties["like_value"][] = $this->data['name'];
			}
			$this->data['email'] = $this->input->get("email");
			if($this->data['email']) {
                $filters["{$this->table}.email"] = $this->data['email'];
			}
			$this->data['date_timestamp'] = $this->input->get("date_timestamp");
			if($this->data['date_timestamp']) {
				$sql_properties["like"][] = "{$this->table}.date_timestamp";
				$sql_properties["like_value"][] = $this->data['date_timestamp'];
			}
		}

		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#feedback/index/show/0/", $limit, 6, $total_results);
		$this->batch_model->render_page("admin/addons/feedback/feedback", $this->data);
	}

    public function reply($id=0)
    {
        $this->data['current_id'] = $id;

        $this->form_validation->set_rules('sender_email', 'Sender Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('cc', 'CC', 'trim|valid_email');
        $this->form_validation->set_rules('bcc', 'BCC', 'trim|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $status = $this->feedback_model->reply();
            if($status) {
                $this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Mail sent successfully!', 'return_id'=>$id), 1);
                return;
            }
            else {
                ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'Mail send failed!', 'return_id'=>$id));
                return;
            }
        }
        else {
            if(validation_errors()) {
                $this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
            }           
        }
        
        $sql_properties = $this->feedback_model->sql_properties($limit=1);
        $this->data['row_data'] = $this->batch_model->get_rows($sql_properties, array("id"=>$id));
        $this->batch_model->render_page("admin/addons/feedback/reply-feedback", $this->data);
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