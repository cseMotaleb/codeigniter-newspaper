<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model'));
		$this->login_model->auth_user();
		if(!$this->input->is_ajax_request()) {
			redirect(base_url()); exit;
		}

		$this->config->load_db_items();
		$this->data['group'] = $this->session->userdata("group");
		$this->data['user_id'] = $this->session->userdata("id");
	}

	public function product_parent_category()
	{
		$category_id = (int)$this->input->get("category_id");
		$selected = (int)$this->input->get("selected");
		$rows = $this->batch_model->get_rows(array('table'=>'categories', 'limit'=>5000, 'order_by'=>'category', 'order_type'=>'category'), array('parent_id'=>$category_id, "sub_parent_id"=>0,));

		$json['data'] = "<option value=\"\">--- SELECT ---</option>";
		foreach ($rows as $key => $row) {
			$selected_row = ($selected == $row['id']) ? 'selected="selected"' : "";
			$json['data'] .= "<option value=\"{$row['id']}\" {$selected_row}>{$row['category']}</option>";
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($json); return;
	}

    public function product_sub_category()
    {
        $parent_id = (int)$this->input->get("parent_id");
        $selected = (int)$this->input->get("selected");
        $rows = $this->batch_model->get_rows(array('table'=>'categories', 'limit'=>5000, 'order_by'=>'category', 'order_type'=>'asc'), array('sub_parent_id'=>$parent_id));

        $json['data'] = "<option value=\"\">--- SELECT ---</option>";
        foreach ($rows as $key => $row) {
            $selected_row = ($selected == $row['id']) ? 'selected="selected"' : "";
            $json['data'] .= "<option value=\"{$row['id']}\" {$selected_row}>{$row['category']}</option>";
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($json); return;
    }

    public function blog_tags()
    {
        $data = array();
        $q = $this->input->get("q");

        $sql_properties['select'] = "blog_tags.*";
        $sql_properties['table'] = 'blog_tags';
        $sql_properties['limit'] = 150;
        $sql_properties['order_by'] = "tag";
        $sql_properties['order_type'] = "asc";
        $sql_properties['like'][] = 'tag';
        $sql_properties['like_value'][] = $q;
        $return_data = $this->batch_model->get_rows($sql_properties, array());

        $i = 0;
        foreach ($return_data as $row) {
            $data[$i] = $row;
            $data[$i]['id'] = $row['id'];
            $data[$i]['text'] = $row['tag'];
            $i += 1;
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($data);
        return;
    }

	public function blog_parent_category()
	{
		$category_id = (int)$this->input->get("category_id");
		$selected = (int)$this->input->get("selected");
		$rows = $this->batch_model->get_rows(array('table'=>'blog_groups', 'limit'=>5000, 'order_by'=>'position', 'order_type'=>'asc'), array('parent_id'=>$category_id, "sub_parent_id"=>0));

		$json['data'] = "<option value=\"\">--- SELECT ---</option>";
		foreach ($rows as $key => $row) {
			$selected_row = ($selected == $row['id']) ? 'selected="selected"' : "";
			$json['data'] .= "<option value=\"{$row['id']}\" {$selected_row}>{$row['category']}</option>";
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($json); return;
	}

	public function blog_sub_parent_category()
	{
		$parent_id = (int)$this->input->get("parent_id");
		$selected = (int)$this->input->get("selected");
		$rows = $this->batch_model->get_rows(array('table'=>'blog_groups', 'limit'=>5000, 'order_by'=>'category', 'order_type'=>'category'), array('sub_parent_id'=>$parent_id));

		$json['data'] = "<option value=\"\">--- SELECT ---</option>";
		foreach ($rows as $key => $row) {
			$selected_row = ($selected == $row['id']) ? 'selected="selected"' : "";
			$json['data'] .= "<option value=\"{$row['id']}\" {$selected_row}>{$row['category']}</option>";
		}

		header('Content-type: application/json; charset=utf-8');
		echo json_encode($json); return;
	}
	
}