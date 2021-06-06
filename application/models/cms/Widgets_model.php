<?php
class Widgets_model extends CI_Model {

	var $table = 'widgets';

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
							'order_by'=>"{$this->table}.title",
							'order_type'=>'asc',
						);

		return $sql_properties;
	} // end function
	
	public function parsed_data()
	{
		$parsed_data['title'] = $this->input->post('title');
		$parsed_data['url'] = $this->input->post('url');
		$parsed_data['description'] = $this->input->post('description');
		$parsed_data['section_id'] = $this->input->post('section_id');
		
		return $parsed_data;
	} // end function
}

		