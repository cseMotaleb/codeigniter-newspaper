<?php
class Feedback_model extends CI_Model {

	var $table = 'feedback';

	function __construct()
	{
		parent::__construct();
	}

	public function sql_properties($limit=10, $offset=0)
	{
		$sql_properties = array (
		                    "select" => "{$this->table}.*",
							"table" => $this->table,
							'limit' => $limit,
							'offset' => $offset
						);

		return $sql_properties;
	} // end function
	
	public function parsed_data()
	{

		$parsed_data['title'] = $this->input->post('title');
		$parsed_data['url'] = strtolower(url_title($parsed_data['title']));
		$parsed_data['details'] = $this->input->post('details');
		$parsed_data['publish_date'] = $this->input->post('date');
		$parsed_data['enabled'] = $this->input->post('enabled');
		
		return $parsed_data;
	} // end function

    public function reply()
    {
        $sender_email = $this->input->post("sender_email");
        $email = $this->input->post("email");
        $cc = $this->input->post("cc");
        $bcc = $this->input->post("bcc");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");
        $company_name = $this->config->item('company_name');

        //Mail Library
        $this->load->library('email');
        $config['wordwrap'] = TRUE; 
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        //Prepend and send mail
        $this->email->from($sender_email, $company_name);
        $this->email->to($email);
        $this->email->reply_to($sender_email, $company_name);
        if($cc) $this->email->cc($cc);
        if($bcc) $this->email->bcc($cc);
        $this->email->subject($subject);
        $this->email->message(htmlspecialchars_decode(html_entity_decode($message)));
        $return = @$this->email->send();

        return $return; 
    }
}