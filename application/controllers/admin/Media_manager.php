<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_manager extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model'));
		$this->login_model->auth_user();
	}

	public function index($offset=0)
	{	
		$data = array();
		$data['mode'] = 'add';
		$data['media_id'] = '0';
		$data['kc_browser_type'] = 'images';
		$data['top_title'] = 'Library Images';

		$this->batch_model->render_page("admin/addons/media/media-manager", $data);
	}
}