<?php
class Menu_model extends CI_Model {

	var $table = 'menu';

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
		$parsed_data['content'] = $this->input->post('mymenu'); 
		$parsed_data['menu_class'] = $this->input->post('menuclass'); 
		$parsed_data['menu_id'] = $this->input->post('menuid'); 
		$parsed_data['enabled'] = $this->input->post('enabled'); 
		$parsed_data['user_id'] =$this->session->userdata('id');
		$parsed_data['ip'] = $this->input->ip_address();
		$parsed_data['browser'] = $this->input->user_agent();
		$parsed_data['created_at'] = time();

		return $parsed_data;
	} // end function
}

			