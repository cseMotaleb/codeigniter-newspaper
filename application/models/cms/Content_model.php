<?php
class Content_model extends CI_Model {

	var $table = 'pages';

	function __construct()
	{
		parent::__construct();
	}

	public function sql_properties($limit=10, $offset=0)
	{
		$sql_properties = array();

		$sql_properties['select'] = "pages.*";
		$sql_properties['table'] = "pages";
		$sql_properties['limit'] = $limit;
		$sql_properties['offset'] = $offset;

		return $sql_properties;
	}

	public function send($file_name="")
	{
		if(!$file_name) { return FALSE; }

		$company_email = $this->config->item("company_email");
        //Mail Library
        $config['wordwrap'] = TRUE; 
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

		$file = base_url()."uploads/employment/{$file_name}";

		//Send Email
		$admin_msg = '<p>';	
		$admin_msg .= "<strong>Received New CV Request<strong><br /><br />";
		$admin_msg .= "<strong><a href=\"{$file}\">Download Now</a></strong>";
		$admin_msg .= '</p>';

		$this->email->from("noreply@infocomglobal.com", "New CV Request");
		$this->email->to($company_email);
		$this->email->subject("Received New CV Request.");
		$this->email->message($admin_msg);
		$this->email->attach('./uploads/employment/'.$file_name);
		$status = @$this->email->send();

		return $status;	
	}
}