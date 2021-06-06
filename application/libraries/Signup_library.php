<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Signup_library {
	var $CI;
    
	function __construct()
	{
		$this->CI =& get_instance();	
    }

	public function send($member_id=0, $data=array())
	{
		$company_name = $this->CI->config->item("company_name");
		$from_email = $this->CI->config->item("noreply_email");
		$bcc_email = $this->CI->config->item("company_email");

		$alphaID = alphaID($member_id);
		$browser = strtolower(str_replace($data['browser'], " ", "-"));
		$verify = site_url("register/verify?k={$alphaID}&b={$browser}&ip={$data['ip']}&t=".time());
		$subject = 'Action Required - confirm your registration.';

		$message = "Dear {$data['name']},<br /><br />Welcome to {$company_name}.<br>";
		$message .= 'Please click here to activate your account <br />';
		$message .= '<a href='.$verify.'>'.$verify.'</a>';
		$message .= '<br /><br /> Thank You,<br />'.$company_name;

		$this->CI->load->library('email');
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->CI->email->initialize($config);

		$this->CI->email->from($from_email, $company_name);
		$this->CI->email->to($data['email']);
		$this->CI->email->bcc($bcc_email);

		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		return @$this->CI->email->send();
	}
}