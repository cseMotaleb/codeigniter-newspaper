<?php
class Feedback_Model extends CI_Model {

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

	public function row_counter($filters=array())
	{
		$this->db->where($filters);
		$this->db->from("feedback");
		return $this->db->count_all_results();
	}

	public function pagination($filters=array(), $limit=10)
	{
		$pagination = array();

		//Pagination of result set
		$config['base_url'] = "#feedback/index/show/0/";
		$config['total_rows'] = $this->row_counter($filters);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['suffix'] =  (!isset($sql_properties['QUERY_STRING'])) ? '?' . $_SERVER["QUERY_STRING"] : "";
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_url'] = $config['base_url'].$config['suffix'];
		$config['first_tag_open'] = '<li class="first">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="last">';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#" >';
		$config['cur_tag_close'] = '</a></li>';

		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();		

		return $pagination;	
	}

	public function save()
	{
		$parsed_data = $this->parsed_data();
		$insert_query = $this->db->insert_string("feedback", $parsed_data);
		$insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
		$this->db->query($insert_query);
		$db_status = $this->db->insert_id();

		if($db_status) {
	    	$this->load->library(array("feedback_library", "email"));
	    	$this->feedback_library->send($parsed_data);
		}

		return $db_status;
	}
	
	public function parsed_data()
	{
        $parsed_data['name'] = $this->input->post("name");
        $parsed_data['email'] = $this->input->post("email");
        $parsed_data['phone'] = $this->input->post("phone");
        $parsed_data['subject'] = $this->input->post("subject");
        $parsed_data['message'] = $this->input->post("message");
        $parsed_data['ip'] = $this->input->ip_address();
        $parsed_data['browser'] = $this->input->user_agent();

		return $parsed_data;
	}

	function delete_rows($table = NULL, $comparison_fields = NULL, $row_ids = NULL)
	{		
		if(isset($comparison_fields['name']) && is_array($comparison_fields['name'])) {
			foreach ($comparison_fields['name'] as $key => $val) {
				$this->db->where($comparison_fields['name'][$key], $comparison_fields['value'][$key]);
			}
		}

		else if(isset($comparison_fields) && is_array($comparison_fields)){
			$this->db->where($comparison_fields['name'], $comparison_fields['value']);
		}

		if($row_ids) {
			if(is_array($row_ids)) $this->db->where_in('id', $row_ids);
			else $this->db->where('id', $row_ids);
		}

		if($row_ids || $comparison_fields) { 
			$this->db->delete($table); 
			return $this->db->affected_rows();
		}	
		
		return FALSE;
	}

    public function reply()
    {
        $sender_email = $this->input->post("sender_email");
        $email = $this->input->post("email");
        $cc = $this->input->post("cc");
        $bcc = $this->input->post("bcc");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");
        $company_name = $this->config->item("company_name");

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

	public function ajax_json_encode($response=array(), $success=0)
	{
		$validation_error = (isset($response['validation_errors'])) ? $response['validation_errors'] : 0;
		$upload_error = (isset($response['upload_error'])) ? $response['upload_error'] : 0;

		if($success==1) {
			$response['mcode'] = 200;
			$response['mtitle'] = (isset($response['mtitle'])) ? $response['mtitle'] : "Saved!";
			$response['mcontent'] = (isset($response['mcontent'])) ? $response['mcontent'] : "Successfully information saved";;
			$response['mcolor'] = "#5F895F";
			$response['miconSmall'] = "fa fa-success shake animated";	
		}
		else {
			$response['mcode'] = (isset($response['mcode'])) ? $response['mcode'] : 500;
			$response['mtitle'] = (isset($response['mtitle'])) ? $response['mtitle'] : "Error Raised!";

			if($validation_error) $response['mcontent'] = validation_errors();
			elseif($upload_error) $response['mcontent'] = $this->upload->display_errors();
			else $response['mcontent'] = (isset($response['mcontent'])) ? $response['mcontent'] : "Data Saved Failed";

			$response['mcolor'] = (isset($response['mcolor'])) ? $response['mcolor'] : "#C46A69";
			$response['miconSmall'] = (isset($response['miconSmall'])) ? $response['miconSmall'] : "fa fa-warning shake animated";
		}

		if(isset($response['data_mode'])) {
			$response['data_mode'] = $response['data_mode'];
		}
		if(isset($response['return_id'])) {
			$response['return_id'] = $response['return_id'];
		}

		echo json_encode($response);
		return;
	}
}