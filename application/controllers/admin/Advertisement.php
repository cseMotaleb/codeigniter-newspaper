<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement extends CI_Controller {

	var $data = array();

	var $table = "advertisement";

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model'));
		$this->login_model->auth_user();
        $this->config->load_db_items();
	}

	public function index($offset=0)
	{
		$limit = 10;
		$filters = array();

		$this->data['rows'] =$this->batch_model->get_rows(array("table"=>"advertisement", "limit"=>$limit, "offset"=>$offset), $filters);
		$this->data['pagination'] = $this->batch_model->pagination("advertisement", $filters, "#advertisement/index/", $limit, 4);
		$this->batch_model->render_page("admin/advertisement/list", $this->data);
	}

	public function manage($mode='add', $id=0, $offset=0)
	{
		$valid_modes = array('add', 'edit', "view", 'delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;

         $this->form_validation->set_rules('position', 'Position', 'required|trim');
         $this->form_validation->set_rules('enabled', 'Status', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data['name'] = $this->input->post('name');
			$parsed_data['url'] = $this->input->post('url');
			$parsed_data['position'] = $this->input->post('position');
			$parsed_data['enabled'] = $this->input->post('enabled');

			if(isset($_FILES['userfile']['name'])) {
				$ext = @pathinfo($_FILES['userfile']['name']);
				if(isset($ext['extension'])) {
	                $fileExt = strtolower($ext['extension']);
	                $image_name = time();

					$config['overwrite'] = TRUE;
					$config['upload_path'] = "./uploads/media/advertisement/";
					$config['allowed_types'] = 'jpg|png|jpeg|gif';
					$config['file_name']  = "{$image_name}.{$fileExt}";
					$this->load->library('upload', $config);
					if ($this->upload->do_upload()) {
						$upload_data = $this->upload->data();
						$config['overwrite'] = TRUE;
						$config['image_library'] = 'gd2';
						$config['source_image'] = "./uploads/media/advertisement/{$upload_data['file_name']}";
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = FALSE;
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						$parsed_data['image'] = $upload_data['file_name'];

						//delete older
						if($mode == "edit") {
							$check_image = $this->batch_model->get_rows(array("table"=>"advertisement", "limit"=>1), array("id"=>$id));
							if(isset($check_image['id'])) @unlink("./uploads/media/advertisement/{$check_image['image']}");
						}
					}
				}
			}

			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;			
			}
			$db_status = $this->batch_model->save("advertisement", $parsed_data, $comparison_fields);	

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
			$check_image = $this->batch_model->get_rows(array("table"=>"advertisement", "limit"=>1), array("id"=>$id));
			if(isset($check_image['id'])) @unlink("./uploads/media/advertisement/{$check_image['image']}");

			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows("advertisement", $comparison_fields);
			echo 1; return;
		}

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows(array('table'=>"advertisement", 'limit'=>1),array('id'=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else $this->data['mode'] = 'add';
		}

		$this->batch_model->render_page("admin/advertisement/manage", $this->data);
	}

    public function ajax_status_update()
    {
        $db_status = $this->batch_model->ajax_single_update("advertisement");
        if($db_status) {
            $this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1); return;
        }
        else {
            $this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!")); return;
        }
    }
}