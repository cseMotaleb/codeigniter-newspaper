<?php
class Faqs_model extends CI_Model {

	var $table = 'faqs';
	var $table_group = 'faq_groups';

	function __construct()
	{
		parent::__construct();
	}

	public function sql_properties($limit=10, $offset=0)
	{
		$sql_properties = array(
							"select"=>"{$this->table}.*,
							categories.category as group_name",
							'table'=>$this->table, 
							'limit'=>$limit, 
							'offset'=>$offset,
							'order_by'=>"{$this->table}.id",
							'order_type'=>'desc'
						);

		$sql_properties['glue'][] = "categories";
		$sql_properties['pieces'][] = "categories.id = {$this->table}.group_id";

		return $sql_properties;
	} // end function

	public function parsed_data()
	{
		$parsed_data['group_id'] = $this->input->post('group_id');
		$parsed_data['question'] = $this->input->post('question');
		$parsed_data['answer'] = $this->input->post('answer');
		$parsed_data['enabled'] = $this->input->post('enabled');

		return $parsed_data;
	} // end function

//groups
	public function group_sql_properties($limit=10, $offset=0)
	{
		$sql_properties = array(
							"select"=>"{$this->table_group}.*",
							'table'=>$this->table_group, 
							'limit'=>$limit, 
							'offset'=>$offset,
							'order_by'=>"{$this->table_group}.id",
							'order_type'=>'desc'
						);

		return $sql_properties;
	} // end function

	public function parsed_group_data()
	{
		$parsed_data['name'] = $this->input->post('name');
		$parsed_data['enabled'] = $this->input->post('enabled');

		return $parsed_data;
	} // end function
}

			
			
			