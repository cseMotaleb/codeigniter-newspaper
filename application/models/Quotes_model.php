<?php
class Quotes_model extends CI_Model {

	var $table = 'quotes';

	function __construct()
	{
		parent::__construct();
	}

	public function sql_properties($limit=10, $offset=0)
	{
		$sql_properties = array();

		$sql_properties['select'] = "quotes.*";
		$sql_properties['table'] = "quotes";
		$sql_properties['limit'] = $limit;
		$sql_properties['offset'] = $offset;

		return $sql_properties;
	}
}