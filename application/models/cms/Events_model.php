<?php
class Events_model extends CI_Model {

	var $table = 'events';

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
							'order_type'=>'asc'
						);

		return $sql_properties;
	} // end function
	
	public function parsed_data()
	{
		$parsed_data['title'] = $this->input->post('title');
		$parsed_data['meta_keyword'] = $this->input->post('meta_keyword');
		$parsed_data['meta_description'] = $this->input->post('meta_description');
		$parsed_data['enabled'] = $this->input->post('enabled');
		$parsed_data['description'] = $this->input->post('description');
		$parsed_data['event_address'] = $this->input->post('event_address');
		$parsed_data['internal_url'] = $this->input->post('internal_url');
		$parsed_data['external_url'] = $this->input->post('external_url');
		$parsed_data['start_date'] = $this->input->post('start_date');
		$parsed_data['end_date'] = $this->input->post('end_date');
		
		return $parsed_data;
	} // end function
}