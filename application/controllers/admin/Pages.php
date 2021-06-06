<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	var $data = array();

	var $table = "pages";

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model', 'cms/content_model'));
		$this->login_model->auth_user();
	}

	public function index($offset=0)
	{
		$limit = 15;
		$sql_properties = $this->content_model->sql_properties($limit, $offset);
		$filters = array();
		$site_url = "#pages/index/";
		$uri_segment = 4;

		if(isset($_GET['search'])) {
			$this->data['page'] = $this->input->get("page");
			if($this->data['page']) {
				$sql_properties["like"] = "page";
				$sql_properties["like_value"] = $this->data['page'];
			}
			$this->data['meta_title'] = $this->input->get("meta_title");
			if($this->data['meta_title']) {
				$sql_properties["like"] = "meta_title";
				$sql_properties["like_value"] = $this->data['meta_title'];
			}
			$this->data['type_id'] = $this->input->get("type_id");
			if($this->data['type_id']) {
				$filters["{$this->table}.type_id"] = $this->data['type_id'];
			}
			$this->data['status'] = $this->input->get("status");
			if($this->data['status'] != '') {
				$filters["{$this->table}.status"] = $this->data['status'];
			}
		}

		$this->data['rows'] =$this->batch_model->get_rows($sql_properties, $filters);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, $site_url, $limit, $uri_segment);
		$this->batch_model->render_page("admin/pages/pages", $this->data);
	}

	public function manage($mode='add', $id=0, $offset=0)
	{
		$valid_modes = array('add', 'edit', 'delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if ($mode == 'bulk_delete') {
			$ids = $this->input->post("bulk_delete");
			$this->batch_model->delete_rows($this->table, NULL, $ids);
			echo 1; return;
		}

		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;

        if($mode == "add") $this->form_validation->set_rules('page', 'Page', 'required|trim|callback_check_page');
		else $this->form_validation->set_rules('page', 'Page', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data['page'] = $this->input->post('page');
			$url = strtolower(non_english_url_title($parsed_data['page']));
			$parsed_data['url'] = $url;
			$parsed_data['meta_title'] = $this->input->post('meta_title');
			$parsed_data['meta_keyword'] = $this->input->post('meta_keyword');
			$parsed_data['meta_description'] = $this->input->post('meta_description');
			$parsed_data['content'] = $this->input->post('content2');
			$parsed_data['status'] = $this->input->post('status');
			$parsed_data['tags'] = $this->input->post('tags');
			$parsed_data['page_banner'] = $this->input->post('page_banner');

			if($parsed_data['status'] == 'Public') {
				$route_data['slug'] = $parsed_data['url'];

				$route_data['controller'] = "contents/index/{$url}";
				$routes =$this->batch_model->get_rows(array('table'=>'routes', 'limit'=>1),array('slug' => $route_data['slug']));
				$route_comparison_fields = NULL;
				if(isset($routes['slug'])) {
					$route_comparison_fields['name'] = 'slug';
					$route_comparison_fields['value'] = $route_data['slug'];
				}

				$this->batch_model->save('routes', $route_data, $route_comparison_fields);
			}

			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;			
			}
			$db_status = $this->batch_model->save('pages', $parsed_data, $comparison_fields);	

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
			$this->batch_model->delete_rows('pages', $comparison_fields);
			echo 1; return;
		}

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1),array('id'=>$id));
			if(isset($return_data['id'])) $this->data['page'] = $return_data;
			else $this->data['mode'] = 'add';
		}

		$this->batch_model->render_page("admin/pages/manage-page", $this->data);
	}

	public function check_page($page)
	{
		$exists = $this->batch_model->row_counter(array('page'=>$page, 'id !='=>$this->input->post('id')), 'pages');
		if($exists) {
			$this->form_validation->set_message('check_page', 'Page Name already is being used. Please try with another Page Name.');
			return FALSE;
		}
		else { return TRUE; }
	}

    //page types
    public function types($mode='add', $id=0, $offset=0)
    {
        $this->data['mode'] = $mode;
        $this->data['current_id'] = $id;
        $valid_modes = array('add', 'edit', 'delete', 'bulk_delete');
        if(!in_array($mode, $valid_modes)) $mode = 'add';

        if ($mode == 'bulk_delete') {
            $ids = $this->input->post("bulk_delete");
            $this->batch_model->delete_rows("page_types", NULL, $ids);
            echo 1; return;
        }

        $this->form_validation->set_rules('type', 'Type', 'required|trim|callback_check_type');
        $this->form_validation->set_rules('enabled', 'Status', 'required|trim');
        if ($this->form_validation->run() == TRUE) {
            $parsed_data['type'] = $this->input->post("type");
            $parsed_data['enabled'] = $this->input->post("enabled");
            $comparison_fields = NULL;
            if($mode == 'edit') {
                $comparison_fields['name'] = 'id';
                $comparison_fields['value'] = $id;  
            }
            $db_status = $this->batch_model->save("page_types", $parsed_data, $comparison_fields);  

            if($mode == 'add') $id = $db_status;

            if($db_status) {
                $this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"edit", 'return_id'=>$id), 1);
                return;
            }
            else {
                ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>$mode, 'lang_id'=>$id));
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
            $this->batch_model->delete_rows("page_types", $comparison_fields);
            echo 1; return;
        }
        elseif($mode == 'edit') {
            $return_data = $this->batch_model->get_rows(array('table'=>'page_types', 'limit'=>1), array("{$this->table}.id"=>$id));
            if(isset($return_data['id'])) { $this->data['row_data'] = $return_data; }
            else { $this->data['mode'] = 'add'; }
        }

        $filters = array();
        $limit = 15;
        $this->data['rows'] = $this->batch_model->get_rows(array('table'=>'page_types', 'limit'=>$limit, "offset"=>$offset), $filters);
        $this->data['pagination'] = $this->batch_model->pagination("page_types", $filters, "#pages/types/show/0/", $limit, 6);
        $this->batch_model->render_page("admin/pages/types", $this->data);
    }

    public function check_type($type)
    {
        $filters = array('type'=>$type);
        $id = $this->input->post('id');
        if($id) $filters['id !='] = $id;
        $exists = $this->batch_model->row_counter($filters, 'page_types');
        if($exists) {
            $this->form_validation->set_message('check_type', 'Page Type already is being used. Please try with another Page Type.');
            return FALSE;
        }
        else { return TRUE; }
    }

    public function type_ajax_status_update()
    {
        $db_status = $this->batch_model->ajax_single_update("page_types");
        if($db_status) {
            $this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1); return;
        }
        else {
            $this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!")); return;
        }
    }
}