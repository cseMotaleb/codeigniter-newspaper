<?php
class Login_Model extends CI_Model {

  	function __construct()
	{
		parent::__construct();
	}

	public function check_user()
	{
		$user = trim($this->input->post('user'));
		$password = $this->input->post('password');

		$this->db->where(array('members.enabled'=>1, 'members.password'=>$password));
		$this->db->or_where('username', $user); 
		$this->db->or_where('email', $user); 
		$this->db->limit(1, 0);
		$this->db->from("members");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();

			unset($row['password']);

			//Update Log
			$this->db->where('id', $row['id']);
			$this->db->update('members', array('last_ip'=>$this->input->ip_address(), 'last_browser'=>$this->input->user_agent(), 'last_login'=>time()));

			if($row['enabled'] != 1) {
				return FALSE; 
			}

			$sess_user['user_id'] = $row['id'];
			$sess_user['username'] = $row['username'];
			$sess_user['user_name'] = $row['name'];
			$sess_user['user_email'] = $row['email'];
			$this->session->set_userdata($sess_user);
			return TRUE;
		}
		else { 
			return FALSE; 
		}
	}

	function auth_user()
	{	
		$id = $this->session->userdata('user_id');

		if(!empty($id)) {
			$query = $this->db->get_where('members', array('id'=>$id), 1, 0);
			if ($query->num_rows() > 0) { 
				return TRUE;
			}
		}
		else {
			redirect(base_url());
			return FALSE;
		}
	}

    public function sign_out()
    {
        $this->session->sess_destroy();
        return TRUE;
    }
	
}