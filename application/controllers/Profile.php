<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	var $data = array();

	function __construct()
	{
		parent::__construct();
        $this->config->load_db_items();
		$this->load->helper("news");
		$this->load->library("news_library");
		$this->load->model(array("blog/blog_model", "members/login_model"));
        $this->data['company_config'] = all_config();
		$this->login_model->auth_user();
	}

	public function index()
	{
        $this->data['page'] = array(
                                "meta_title" => "Profile of " . $this->session->userdata("user_name") . " - " . $this->config->item("company_name"),
                                "meta_keyword" => "Profile of " . $this->session->userdata("user_name") . " - " . $this->config->item("company_name"),
                                "meta_description" => "Profile of " . $this->session->userdata("user_name") . " - " . $this->config->item("company_name"),
                                "url" => "profile"
                            );

		$wds = widget_snippet(array('enabled'=>1));
		foreach($wds as $key=>$section) {
			$this->data["{$section['section_id']}"] = $section;		
		}
		$this->data['right_side'] = FALSE;
		$this->data['segment'] = "users/profile";

		$user_id = $this->session->userdata("user_id");
		$cp = $this->input->post("cp");
		if($cp == "Change Password") {
			$this->form_validation->set_rules('username', 'User Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('cpassword', 'Re Type Password', 'trim|required|matches[password]');
			$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|callback_check_password');
			if ($this->form_validation->run() == TRUE) {
                $parsed_data['password'] = $this->input->post("password");
                $comparison_fields['name'] = 'id';
                $comparison_fields['value'] = $user_id;
                $db_status = $this->batch_model->save('members', $parsed_data, $comparison_fields);
                if($db_status) {
                    $this->data['error'] = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"></button><strong> Success! </strong>Your Password has been change successfully.</div><br />';
                }
                else {
                    $this->data['error'] = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"></button><strong> Error! </strong>Password change failde, Please try again.</div><br />';
                }
			}
			else {
				if(validation_errors()) $this->data['error'] = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> '.validation_errors().'</div>';
			}
		}


		else {
			$this->form_validation->set_rules('name', 'Full Name', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$parsed_data['name'] = $this->input->post("name");
				$parsed_data['about'] = $this->input->post("about");
				$parsed_data['gender'] = $this->input->post("gender");
				$parsed_data['address'] = $this->input->post("address");
				$parsed_data['city'] = $this->input->post("city");
				$parsed_data['country'] = $this->input->post("country");
				$parsed_data['contact'] = $this->input->post("contact");

				$comparison_fields['name'] = "id";
				$comparison_fields['value'] = $user_id;
				$db_status = $this->batch_model->save("members", $parsed_data, $comparison_fields);
				if($db_status) {
					$this->data['error'] = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><strong>Congratulations!</strong> Your form was submitted and information saved successfully!</div>';
				}
				else {
					$this->data['error'] = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">×</button><strong>Warning!</strong> No Changes made!</div>';
				}
			}
			else {
				if(validation_errors()) $this->data['error'] = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong> '.validation_errors().'</div>';
			}
		}

		$this->data['row_data'] = $this->batch_model->get_rows(array("table"=>"members", "limit"=>1), array("id"=>$user_id));
		$this->load->view('template', $this->data);
	}

    public function check_password($password)
    {
    	$user_id = $this->session->userdata("user_id");
        $check = $this->batch_model->get_rows(array('table'=>"members", 'limit'=>1), array('id'=>$user_id));
        if(isset($check['id']) && ($check['password'] != $password)) {
            $this->form_validation->set_message('check_password', 'Old Password is not match.');
            return FALSE;
        }

        else return TRUE;
    }
}