<?php
class Glossary_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function get_rows($filters=array())
	{
		$return = array();

		$this->db->where($filters);
		$this->db->from("glossary");
		$query = $this->db->get();
		$i = 0;
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$str = @mb_substr($row['title'], 0, 1, 'utf-8');
				if(isset($str[0])) {
					$return[$str[0]][$i]['title'] = $row['title'];
					$return[$str[0]][$i]['details'] = $row['details'];
					$return[$str[0]][$i]['enabled'] = $row['enabled'];
				}
				
				$i++;
			}
		}
		
		return $return;
	}
}