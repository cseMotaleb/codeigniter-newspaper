<?php
class Login_Model extends CI_Model {

  	function __construct()
	{
		parent::__construct();
	}
	
	public function check_user()
	{
		$useremail = trim($this->input->post('email'));
		$password = $this->input->post('password');

		$this->db->where(array('users.email'=>$useremail, 'users.password'=>$password));
		$this->db->limit(1, 0);
		$this->db->from("users");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();

			unset($row['password']);

			//Update Log
			$this->db->where('email', $useremail);
			$this->db->update('users', array('last_ip'=>$this->input->ip_address(), 'last_browser'=>$this->input->user_agent(), 'last_login'=>time()));

			if($row['enabled'] != '1') {
				return FALSE; 
			}

			$this->session->set_userdata($row);
			return TRUE;
		}
		else { 
			return FALSE; 
		}
	}

	function auth_user()
	{
		$user_email = $this->session->userdata('email');	
		$id = $this->session->userdata('id');

		if(!empty($user_email)) {
			$query = $this->db->get_where('users', array('email'=>$user_email, 'id'=>$id), 1, 0);
			if ($query->num_rows() > 0) { 
				return TRUE;
			}
		}
		else {
			redirect(site_url('admin/login'));
			return FALSE;
		}
	}
	
	public function changepassword() {
		$user_email = $this->session->userdata('email');
		if(empty($user_email)) return FALSE;
		$data = array('password'=>$this->input->post('password'));
		$this->db->where('email', $user_email);
		$this->db->where('password', $this->input->post('old_password'));
		$this->db->update('users', $data); 
		$status = $this->db->affected_rows();	
		
		return $status;	
	}
	
	public function logout() {
		$this->session->sess_destroy();	
		redirect(base_url());
	}

	public function check_ip($sitewide=0)
	{
		$check_member = get_rows(array('ip'=>$this->input->ip_address(), 'sitewide_block'=>$sitewide), array('table'=>'ip_banned', 'limit'=>1));
		return (isset($check_member['id'])) ? FALSE : TRUE;
	}
}