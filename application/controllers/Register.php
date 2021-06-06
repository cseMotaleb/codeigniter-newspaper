<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
		$this->load->helper("news");
		$this->load->library("news_library");
		$this->load->model(array("blog/blog_model", "register_model"));
        $this->data['company_config'] = all_config();
		$this->data['widget'] = $this->recaptcha->getWidget();
		$this->data['script'] = $this->recaptcha->getScriptTag();
	}

	public function index()
	{
		$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('username', 'User Name', 'trim|required|callback_check_username');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|callback_check_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Re Type Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('terms', 'Terms & Conditions', 'trim|required');
		if ($this->form_validation->run() == TRUE) {
   	 		$recaptcha = $this->input->post('g-recaptcha-response');
	        $response = $this->recaptcha->verifyResponse($recaptcha);
	    	if (isset($response['success']) and $response['success'] === true) {
	    		$parsed_data['name'] = $this->input->post("name");
	    		$parsed_data['username'] = $this->input->post("username");
	    		$parsed_data['email'] = $this->input->post("email");
	    		$parsed_data['password'] = $this->input->post("password");
	    		$parsed_data['enabled'] = 2;
				$parsed_data['time'] = time();
				$parsed_data['ip'] = $this->input->ip_address();
				$parsed_data['browser'] = $this->input->user_agent();
				$db_status = $this->batch_model->save("members", $parsed_data);
				
				if($db_status) {
					$this->load->library(array("signup_library", "email"));
					$this->signup_library->send($db_status, $parsed_data);
					$this->data['error'] = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Congratulation! </strong>Signup has been successfully done. Please check your Email for activate your account.</div>';
				}
				else {
					$this->data['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><strong>Error!</strong> Sign Up failed, Please try again.</div>';
				}
			}
			else $this->data['error'] = '<div class="alert alert-danger fade in alert-dismissable"><button class="close" data-dismiss="alert" type="button">&times;</button><strong>Error! </strong>Google Recaptcha Response Error, Please try again.</div>';
		}
		else {
			if(validation_errors()) $this->data['error'] = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> '.validation_errors().'</div>';
		}

        $this->data['page'] = array(
                                "meta_title" => "Registration - " . $this->config->item("company_name"),
                                "meta_keyword" => "Registration - " . $this->config->item("company_name"),
                                "meta_description" => "Registration - " . $this->config->item("company_name"),
                                "url" => "register"
                            );

		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}
		$this->data['right_side'] = FALSE;
		$this->data['segment'] = "users/register";

		$this->load->view('template', $this->data);
	}

    public function check_username($username)
    {
        $check = $this->batch_model->get_rows(array('table'=>"members", 'limit'=>1), array('username'=>$username));
        if(isset($check['id'])) {
            $this->form_validation->set_message('check_username', 'User Name already is being used. Please try with another User Name.');
            return FALSE;
        }

        else return TRUE;
    }

    public function check_email($email)
    {
        $check = $this->batch_model->get_rows(array('table'=>"members", 'limit'=>1), array('email'=>$email));
        if(isset($check['id'])) {
            $this->form_validation->set_message('check_email', 'E-mail already is being used. Please try with another E-mail.');
            return FALSE;
        }

        else return TRUE;
    }

    public function verify()
    {
        $id = $this->input->get('k');
        $time = $this->input->get('t');
        if(!$id) { redirect(site_url("sign-up")); return; }
        if(!$time) { redirect(site_url("sign-up")); return; }

        //widget
        $wds = widget_snippet();
        foreach($wds as $key=>$section) {
            $this->data["{$section['section_id']}"] = $section;     
        }
		$company_email = $this->config->item("company_email");

        $this->data['breadcrumb'] = '<li class="active">Verify</li>';
        $this->data['page'] = array(
                            'meta_title'      => "Verify Sign Up || ".$this->config->item("company_name"),
                            'meta_keyword'    => "Verify Sign Up || ".$this->config->item("company_name"),
                            'meta_description'=> "Verify Sign Up || ".$this->config->item("company_name"),
                            'url'             => "sign-up/verify"
                        );

		$this->data['right_side'] = FALSE;

        $id = alphaID($id, TRUE);
        $customer = $this->batch_model->get_rows(array("table"=>"members", "limit"=>1), array('id'=>$id));
        $this->data['content'] = "<div class=\"row\"><div class=\"col-md-2\"></div><div class=\"col-md-8\">";
        if(isset($customer['email']) && !empty($customer['email'])) {
            if($customer['enabled'] == 2) {
                $status = $this->register_model->verify($id);
                if($status) {
	                $this->data['content'] .= "<div class=\"alert alert-success\"><strong>Verification Success</strong><br />
	                                Thank you for activating your account.<br />
	                                Click to <a href=\"".site_url('login')."/\">Login</a> Here .</div>";
                }
            }
            else if($customer['enabled'] == 1) {
                $this->data['content'] .= "<div class=\"alert alert-warning\"><strong>Verified! </strong><br />
                                You are already verified your account.<br />
                                Click to <a href=\"".site_url('login')."/\">Login</a> Here .</div>";
            }
        } 
        else {
            $this->data['content'] .= "<div class=\"alert alert-danger\"><strong>Verification Failed</strong><br />
                            Verification failed. Please check your email again. If problem persist, please <a target=\"_blank\" href=\"mailto:{$company_email}\">contact us</a>.<br /></div>";  
        }
        $this->data['content'] .= "</div><div class=\"col-md-2\"></div></div>";

        $this->load->view('template', $this->data);
    }
}
