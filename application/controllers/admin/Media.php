<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_Controller {
	
	public $data = array();

	var $table = "media";
		
	function __construct()
	{	
		parent::__construct();
		$this->load->model(array('admin/login_model'));
		$this->login_model->auth_user();
	}

	public function index($offset=0)
	{	
		$this->data['mode'] = 'add';
		$this->data['current_id'] = '0';

		$filters = array("type !="=>"Youtube");
		$this->data['find_type'] = $this->input->get("type");
		if($this->data['find_type']) {
			$filters['type'] = $this->data['find_type'];
		}

		$this->data['rows'] = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>15, 'offset'=>$offset), $filters);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#media/index/", 15, 4);
		$this->batch_model->render_page("admin/addons/media/media", $this->data);
	}

	public function manage($mode='add', $id=0, $offset=0)
	{
		$data = array();
		$valid_modes = array('add','edit','delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';
		$data['mode'] = $mode;
		$data['current_id'] = $id;
		$data['module'] = 'media';
		$input_type = $this->input->post('type');
		$input_title = $this->input->post('title');
		$title = strtolower(url_title($input_title));
		$input_status = $this->input->post('status');

		$this->form_validation->set_rules('title', 'Title', 'trim|required');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
			if(isset($_FILES['userfile'])) {
				$this->load->library('upload');
				$ext = @pathinfo($_FILES['userfile']['name']);
				if(isset($ext['extension'])) {
					$fileExt = $ext['extension'];

					$config['overwrite'] = TRUE;
					$type_dirname = strtolower(str_replace(' ', '_', $input_type));
					if($type_dirname == 'client_logo') {
						$config['upload_path'] = './uploads/media/client_logo/';
						$config['allowed_types'] = 'png|jpg';
						$config['file_name']  = "{$title}.{$fileExt}";
					}
					else if($type_dirname == 'slider_image') {
						$config['upload_path'] = './uploads/media/slider_image/';
						$config['allowed_types'] = 'jpg|png';
						$config['file_name']  = "{$title}.{$fileExt}";
					}
					else if($type_dirname == 'home_page') {
						$config['upload_path'] = './uploads/media/home_page/';
						$config['allowed_types'] = 'jpg|png';
						$config['file_name']  = "{$title}.{$fileExt}";
					}
					else if($type_dirname == 'page_banner') {
						$config['upload_path'] = './uploads/media/page_banner/';
						$config['allowed_types'] = 'jpg|png';
						$config['file_name']  = "{$title}.{$fileExt}";
					}
					else if($type_dirname == 'news') {
						$config['upload_path'] = './uploads/media/news/';
						$config['allowed_types'] = 'jpg|png';
						$config['file_name']  = "{$title}.{$fileExt}";
					}
					else if($type_dirname == 'portfolio') {
						$config['upload_path'] = './uploads/media/portfolio/';
						$config['allowed_types'] = 'jpg|png';
						$config['file_name']  = "{$title}.{$fileExt}";
					}
					else if($type_dirname == 'photo_gallery') {
						$config['upload_path'] = './uploads/media/photo_gallery/';
						$config['allowed_types'] = 'jpg|png';
						$config['file_name']  = "{$title}.{$fileExt}";
					}
					if(isset($config['upload_path']) && file_exists($config['upload_path'].$config['file_name'])) $config['file_name']  = "{$title}-1.{$fileExt}";	

					$this->upload->initialize($config);
					if (!$this->upload->do_upload()) {
						ajax_json_encode(array('upload_error'=>1));
						return;
					}
					else {
						$upload_data = $this->upload->data();
						$config['image_library'] = 'gd2';
						$config['source_image'] = "./uploads/media/{$upload_data['file_name']}";
						$config['create_thumb'] = FALSE;
						$config['maintain_ratio'] = TRUE;
						if($type_dirname == 'client_logo') { 
							$config['width'] = $this->config->item('client_logo_width');
							$config['height'] = $this->config->item('client_logo_height');
						} 
						else if($type_dirname == 'slider_image'){ 
							$config['width'] = $this->config->item('slider_width');
							$config['height'] = $this->config->item('slider_height');
						}

						else if($type_dirname == 'home_page'){ 
							$config['width'] = $this->config->item('home_page_width');
							$config['height'] = $this->config->item('home_page_height');
						}
		
						else if($type_dirname == 'page_banner'){ 
							$config['width'] = $this->config->item('page_banner_width');
							$config['height'] = $this->config->item('page_banner_height');
						}
		
						else if($type_dirname == 'news'){ 
							$config['width'] = $this->config->item('news_image_width');
							$config['height'] = $this->config->item('news_image_height');
						}
		
						else if($type_dirname == 'portfolio'){ 
							$config['width'] = $this->config->item('portfolio_image_width');
							$config['height'] = $this->config->item('portfolio_image_height');
						}
		
						else if($type_dirname == 'photo_gallery'){ 
							$config['width'] = $this->config->item('photogallery_image_width');
							$config['height'] = $this->config->item('photogallery_image_height');
						}
																						
						$this->load->library('image_lib', $config);			
						$this->image_lib->resize();
					}
				}
			}
			else {
              	if($mode == 'add') { ajax_json_encode(array('mcontent'=>'Please select a image for upload!', 'data_mode'=>"edit", 'zone_id'=>$id)); return; }
			}

			$parsed_data['title'] = $input_title;
			$title = strtolower(url_title($parsed_data['title']));
			$parsed_data['type'] = $input_type;
            $parsed_data['other_link'] = $this->input->post("other_link");
            $parsed_data['page_id'] = $this->input->post("page_id");
            $parsed_data['position'] = $this->input->post("position");
            $parsed_data['details'] = $this->input->post("details");
            $parsed_data['status'] = $this->input->post("status");
			if(isset($upload_data['file_name'])) $parsed_data['url'] = "uploads/media/{$type_dirname}/{$upload_data['file_name']}";

			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save($this->table, $parsed_data, $comparison_fields);
		
			if($mode == 'add') $id = $db_status;
			//success msg
			ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"edit", 'zone_id'=>$id), 1);
			return;
			//success msg
		}
		else {
			if(validation_errors()) {
				ajax_json_encode(array('validation_errors'=>1)); return;
			}
		}

		if($mode == 'delete') {
			$return_media_data = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1), array('id'=>$id));
			if(isset($return_media_data['url'])) {
				@unlink("./{$return_media_data['url']}");
			}

			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table, $comparison_fields);
			echo 1; return;
		}

		if($mode == 'edit') {
			$return_data = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1), array('id'=>$id));
			if(isset($return_data['id'])) $data['row_data'] = $return_data;
			else { $data['mode'] = 'add'; }
		}		

		$this->batch_model->render_page("admin/addons/media/manage-media", $data);
	}

}