<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $data = array();

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model'));
		$this->login_model->auth_user();
        $this->config->load_db_items();
	}
	
	public function index($offset=0)
	{
		$this->load->view('admin/dashboard', $this->data);
	}
}