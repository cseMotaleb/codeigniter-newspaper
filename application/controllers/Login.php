<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
		$this->load->helper("news");
		$this->load->library("news_library");
		$this->load->model(array("blog/blog_model", "members/login_model"));
        $this->data['company_config'] = all_config();
		$this->data['widget'] = $this->recaptcha->getWidget();
		$this->data['script'] = $this->recaptcha->getScriptTag();
	}

	public function index()
	{
		$this->form_validation->set_rules('user', 'User Name / Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
	        $redirect_url = $this->input->post("redirect_url");
			if($redirect_url) {
				$db_status = $this->login_model->check_user();
	            if($db_status) {
	                redirect(site_url($redirect_url)); return;
	            }
	            else {
	                $this->data['error'] = '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button"></button><strong>Error! </strong>E-mail Address / Password Error.</div><br />';
	            }
			}
			else {
	   	 		$recaptcha = $this->input->post('g-recaptcha-response');
		        $response = $this->recaptcha->verifyResponse($recaptcha);
		    	if (isset($response['success']) and $response['success'] === true) {
		    		$db_status = $this->login_model->check_user();
		            if($db_status) {
		                redirect(site_url("profile")); return;
		            }
		            else {
		                $this->data['error'] = '<div class="alert alert-danger"><button class="close" data-dismiss="alert" type="button"></button><strong>Error! </strong>E-mail Address / Password Error.</div><br />';
		            }
				}
				else $this->data['error'] = '<div class="alert alert-danger fade in alert-dismissable"><button class="close" data-dismiss="alert" type="button">&times;</button><strong>Error! </strong>Google Recaptcha Response Error, Please try again.</div>';
			}
		}
		else {
			if(validation_errors()) $this->data['error'] = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> '.validation_errors().'</div>';
		}

        $this->data['page'] = array(
                                "meta_title" => "Log In - " . $this->config->item("company_name"),
                                "meta_keyword" => "Log In - " . $this->config->item("company_name"),
                                "meta_description" => "Log In - " . $this->config->item("company_name"),
                                "url" => "login"
                            );

		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}
		$this->data['right_side'] = FALSE;
		$this->data['segment'] = "users/login";

		$this->load->view('template', $this->data);
	}
}