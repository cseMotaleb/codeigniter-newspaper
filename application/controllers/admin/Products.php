<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	public $data = array();

	private $table = 'products';

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model', 'products/products_model'));
		$this->login_model->auth_user();
	}

	public function index($offset=0)
	{
		$limit = 15;
		$filters = array();
		$sql_properties = $this->products_model->sql_properties($limit, $offset);

		if($_GET) {
			$this->data['title'] = $this->input->get("title");
			if($this->data['title']) {
				$sql_properties["like"] = "title";
				$sql_properties["like_value"] = $this->data['title'];
			}
			$this->data['publish_date'] = $this->input->get("publish_date");
			if($this->data['publish_date']) {
				$filters["{$this->table}.publish_date"] = $this->data['publish_date'];
			}
			$this->data['enabled'] = $this->input->get("enabled");
			if($this->data['enabled']) {
				$filters["{$this->table}.enabled"] = $this->data['enabled'];
			}
		}

		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#products/index/", $limit, 4, $total_results);
		$this->batch_model->render_page("admin/products/products", $this->data);
	}

	public function manage($mode='add', $id=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('add', 'edit', 'delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if ($mode == 'bulk_delete') {
			$ids = $this->input->post("bulk_delete");
			if(is_array($ids)) {
				foreach ($ids as $key => $value) {
					$this->_delete_image($value);
				}
			}

			$this->batch_model->delete_rows($this->table, NULL, $ids);
			echo 1; return;
		}

        $this->form_validation->set_rules('product_name', 'Product Name', 'required|trim');
        $this->form_validation->set_rules('category_id', 'Category', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Status', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data = $this->products_model->parsed_data($mode, $id);
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}

			$db_status = $this->batch_model->save($this->table, $parsed_data, $comparison_fields);	

			if($mode == 'add') $id = $db_status;

			if($db_status) {
				$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"add", 'return_id'=>0), 1);
				return;
			}
			else {
              	ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!'));
				return;
			}
		}
		else {
			if(validation_errors()) {
				$this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
			}			
		}

		if($mode == 'delete') {
			$this->_delete_image($id);

			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table, $comparison_fields);
			echo 1; return;
		}

		elseif($mode == 'edit') {
			$sql_properties = $this->products_model->sql_properties(1);
			$return_data = $this->batch_model->get_rows($sql_properties, array("{$this->table}.id"=>$id));
			if(isset($return_data['id'])) { $this->data['row_data'] = $return_data; }
			else { $this->data['mode'] = 'add'; }
		}

		$this->batch_model->render_page("admin/products/manage-product", $this->data);
	}

	public function _delete_image($id=0)
	{
		$return_data = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1), array('id'=>$id));
		if(isset($return_data['image'])) { @unlink("./uploads/products/{$return_data['image']}"); }
		return;
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

	//product categories
    public function categories($mode='add', $id=0, $offset=0)
    {
        $this->data['mode'] = $mode;
        $this->data['current_id'] = $id;
        $valid_modes = array('add', 'edit', 'delete', 'bulk_delete');
        if(!in_array($mode, $valid_modes)) $mode = 'add';

        if ($mode == 'bulk_delete') {
            $ids = $this->input->post("bulk_delete");
            $this->batch_model->delete_rows("categories", NULL, $ids);
            echo 1; return;
        }

        $this->form_validation->set_rules('category', 'Category', 'required|trim|callback_check_category');
        if ($this->form_validation->run() == TRUE) {
            $parsed_data['category'] = $this->input->post("category");
            $parsed_data['category_url'] = $this->input->post("category_url");
            $comparison_fields = NULL;
            if($mode == 'edit') {
                $comparison_fields['name'] = 'id';
                $comparison_fields['value'] = $id;  
            }
            $db_status = $this->batch_model->save("categories", $parsed_data, $comparison_fields);  

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
            $this->batch_model->delete_rows("categories", $comparison_fields);
            echo 1; return;
        }
        elseif($mode == 'edit') {
            $return_data = $this->batch_model->get_rows(array('table'=>'categories', 'limit'=>1), array("categories.id"=>$id));
            if(isset($return_data['id'])) { $this->data['row_data'] = $return_data; }
            else { $this->data['mode'] = 'add'; }
        }

        $filters = array();
        $limit = 15;
        $this->data['rows'] = $this->batch_model->get_rows(array('table'=>'categories', 'limit'=>$limit, "offset"=>$offset), $filters);
        $this->data['pagination'] = $this->batch_model->pagination("categories", $filters, "#pages/types/show/0/", $limit, 6);
        $this->batch_model->render_page("admin/products/categories", $this->data);
    }

    public function check_category($category)
    {
        $filters = array('category'=>$category);
        $id = $this->input->post('id');
        if($id) $filters['id !='] = $id;
        $exists = $this->batch_model->row_counter($filters, 'categories');
        if($exists) {
            $this->form_validation->set_message('check_category', 'Category already is being used. Please try with another Category.');
            return FALSE;
        }
        else { return TRUE; }
    }

    public function type_ajax_status_update()
    {
        $db_status = $this->batch_model->ajax_single_update("categories");
        if($db_status) {
            $this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1); return;
        }
        else {
            $this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!")); return;
        }
    }
}