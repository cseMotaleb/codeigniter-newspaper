<?php
class Subscribers_model extends CI_Model {

	var $table = 'subscribers';

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
							'order_by'=>"{$this->table}.name",
							'order_type'=>'asc'
						);

		return $sql_properties;
	} // end function
	
	public function parsed_data()
	{
		
		$parsed_data['name'] = $this->input->post('name');
		$parsed_data['email'] = $this->input->post('email');

		return $parsed_data;
	} // end function
}