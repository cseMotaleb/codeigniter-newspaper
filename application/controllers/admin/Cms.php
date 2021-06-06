<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller {

	public function index()
	{
		$group = $this->session->userdata("group");
		if($group == "User") { redirect(site_url("admin/agent")); return; }

		$this->load->model(array('admin/login_model'));
		$this->login_model->auth_user();
//		echo $this->session->userdata('id');
//        echo '<pre>', print_r($_SESSION), '</pre>';die;
		$this->load->view('admin/template');
	}
}