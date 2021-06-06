<?php
class Polls_model extends CI_Model {

	var $table = 'polls';

	function __construct()
	{
		parent::__construct();
	}

	public function get_rows($filters=array(), $limit=10, $offset=0)
	{
		$return = array();
		$return['rows'] = array();
		$return['pagination'] = "";

		$this->db->order_by("id", "desc");
		$this->db->where($filters);
		$this->db->limit($limit, $offset);
		$this->db->from("polls");
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$row['total_vote'] = $this->batch_model->row_counter(array("poll_id"=>$row['id']), "poll_details");
				$row['options'] = $this->poll_options(array("poll_id"=>$row['id']), $row['id']);
				if($limit > 1) $return['rows'][] = $row;
				else $return['rows'] = $row;
			}
		}

		$return['pagination'] = $this->batch_model->pagination("polls", $filters, "#polls/index", $limit, 3);
		return $return;
	}

	public function poll_options($filters=array(), $poll_id=0)
	{
		$return = array();

		$this->db->where($filters);
		$this->db->from("poll_options");
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$row['total_vote'] = $this->batch_model->row_counter(array("poll_id"=>$poll_id, "option_id"=>$row['id']), "poll_details");
				$return[] = $row;
			}
		}

		return $return;
	}

	public function save($mode='add', $poll_id=0)
	{
		$parsed_data['date'] = $this->input->post("publish_date");
		$parsed_data['date'] = ($parsed_data['date']) ? $parsed_data['date'] : date("Y-m-d");
		$parsed_data['short_title'] = $this->input->post("short_title");
		$parsed_data['poll'] = $this->input->post("poll");
		$parsed_data['enabled'] = $this->input->post("enabled");
		$comparison_fields = NULL;
		if($mode == 'edit') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $poll_id;	
		}
		$db_status = $this->batch_model->save("polls", $parsed_data, $comparison_fields);
		
		if($mode == "add") $poll_id = $db_status;

		if($poll_id) {
			$comparison_fields['name'] = 'poll_id';
			$comparison_fields['value'] = $poll_id;	
			$this->batch_model->delete_rows("poll_options", $comparison_fields);
			
			$options = $this->input->post("options");
			if(is_array($options)) {
				foreach ($options as $key => $option) {
					if($option) {
						$option_data['poll_id'] = $poll_id;
						$option_data['option'] = $option;
						$this->batch_model->save("poll_options", $option_data);
					}
				}
			}
		}

		return $db_status;
	}

	public function delete($id=0)
	{
		$comparison_fields['name'] = 'id';
		$comparison_fields['value'] = $id;
		$this->batch_model->delete_rows("polls", $comparison_fields);

		$comparison_fields['name'] = 'poll_id';
		$comparison_fields['value'] = $id;
		$this->batch_model->delete_rows("poll_options", $comparison_fields);
		
		return;
	}
}