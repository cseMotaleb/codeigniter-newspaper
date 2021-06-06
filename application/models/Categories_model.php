<?php
class Categories_model extends CI_Model {

	var $table = 'categories';

	function __construct()
	{
		parent::__construct();
	}

	public function sql_properties($limit=10, $offset=0)
	{
		$sql_properties = array(
							"select"=>"{$this->table}.*",
							'table'=>$this->table, 
							'limit'=>$limit, 
							'offset'=>$offset,
							'order_by'=>"{$this->table}.id",
							'order_type'=>'desc'
						);

		return $sql_properties;
	} // end function

	public function parsed_data($mode='', $id=0)
	{
		$parsed_data['groups'] = $this->input->post('groups');
		$parsed_data['parent_id'] = $this->input->post('parent_id');
		$parsed_data['sub_parent_id'] = $this->input->post('sub_parent_id');
		$parsed_data['category'] = $this->input->post('category');
		$parsed_data['category_url'] = urlencode(strtolower(non_english_url_title(trim($parsed_data['category']))));

		$parsed_data['enabled'] = $this->input->post('enabled');

		return $parsed_data;
	} // end function

    private function _image_filename($title='', $mode='', $id=0)
    {
        if(empty($title)) {
            $image_name = $id;
            if($mode == 'add') {
                $check_last_id = $this->batch_model->get_rows(array('table'=>'categories', 'limit'=>1, 'order_by'=>'id', 'order_type'=>'desc'), array());
                $image_name = (isset($check_last_id['id'])) ? ($check_last_id['id'] + 1) : 1;
            }
            $title = alphaID($image_name, FALSE, "UNI").$image_name;
        }

        return $title;
    }
}