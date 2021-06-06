<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_library {

	var $CI;

	function __construct()
	{
		$this->CI =& get_instance();	
    }

	public function reply_feedback()
	{
        //Mail Library
        $this->CI->load->library('email');
        $config['wordwrap'] = TRUE; 
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $this->CI->email->initialize($config);

        $sender_email = $this->CI->input->post('sender_email');
        $email = $this->CI->input->post('email');
        $msg = $this->CI->input->post('message');
        $subject = $this->CI->input->post('subject');
		$company_name = $this->CI->config->item('company_name');

		//Prepend and send mail
		$this->CI->email->from($sender_email, $company_name);
		$this->CI->email->to($email);
		$this->CI->email->reply_to($sender_email, $company_name);
		$this->CI->email->subject($subject);
		$this->CI->email->message(htmlspecialchars_decode(html_entity_decode($msg)));
		$return = @$this->CI->email->send();

		return $return;		
	}

	public function send($data=array())
	{
        //Mail Library
        $config['wordwrap'] = TRUE; 
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $this->CI->email->initialize($config);

		//Send Email
		$admin_msg = '<p>';	
		$admin_msg .= "<strong>Name:</strong> {$data['name']} <br />";
		$admin_msg .= "<strong>E-Mail:</strong> {$data['email']} <br />";
		$admin_msg .= "<strong>Phone:</strong> {$data['phone']} <br />";
		$admin_msg .= "<strong>Message:</strong> ".nl2br($data['message']);
		$admin_msg .= '</p>';

		$company_email = $this->CI->config->item("company_email");

		$this->CI->email->from($data['email'], $data['name']);
		$this->CI->email->to($company_email);
		$this->CI->email->subject($data['subject']);
		$this->CI->email->message($admin_msg);
		$status = @$this->CI->email->send();

		return $status;	
	}
} 