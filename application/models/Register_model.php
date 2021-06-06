<?php
class Register_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

    function verify($id=0)
    {
        $this->db->where('id', $id);
        $this->db->update('members', array('enabled'=>1));
        return $this->db->affected_rows();
    }
}