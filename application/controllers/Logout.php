<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("members/login_model");
    }
    
    public function index()
    {
        $this->login_model->sign_out();
        redirect(site_url()); return;
    }
}