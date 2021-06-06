<?php
class Clients_model extends CI_Model {

	var $table = 'clients';

	function __construct()
	{
		parent::__construct();
	}

	public function sql_properties($limit=10, $offset=0)
	{
		$sql_properties = array(
							"select"=>"{$this->table}.*",
							'table'=>$this->table, 
							'limit'=>$limit, 
							'offset'=>$offset,
							'order_by'=>"{$this->table}.id",
							'order_type'=>'desc'
						);

		return $sql_properties;
	} // end function
	
	public function parsed_data($mode='', $id=0)
	{
        $parsed_data['client'] = $this->input->post('client');
        $parsed_data['url'] = $this->input->post('url');
		$parsed_data['details'] = $this->input->post('details');
		$parsed_data['enabled'] = $this->input->post('enabled');

		if(isset($_FILES['userfile']['name'])) {
			$ext = @pathinfo($_FILES['userfile']['name']);
			if(isset($ext['extension'])) {
                $fileExt = strtolower($ext['extension']);
                $title = strtolower(url_title($ext['filename']));
                $title = $this->_image_filename($title, $mode, $id);

                if($mode == 'add') {
                    if (file_exists("./uploads/clients/{$title}.{$fileExt}")) { $title = $title.'-1'; }
                }
                elseif ($mode == 'edit') { $this->delete_image($id); }
                $image_name = $title;

				$config['overwrite'] = TRUE;
				$config['upload_path'] = "./uploads/clients/";
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['file_name']  = "{$image_name}.{$fileExt}";
				$this->load->library('upload', $config);
				if ($this->upload->do_upload()) {
					$upload_data = $this->upload->data();
					$config['overwrite'] = TRUE;
					$config['image_library'] = 'gd2';
					$config['source_image'] = "./uploads/clients/{$upload_data['file_name']}";
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$parsed_data['image'] = $upload_data['file_name'];
				}
			}
		}

		return $parsed_data;
	} // end function

    public function delete_image($id=0)
    {
        $check_image = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1), array('id'=>$id));
        if(isset($check_image['image'])) { @unlink("./uploads/clients/{$check_image['image']}"); }
        return;
    }
    
    private function _image_filename($title='', $mode='', $id=0)
    {
        if(empty($title)) {
            $image_name = $id;
            if($mode == 'add') {
                $check_last_id = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1, 'order_by'=>'id', 'order_type'=>'desc'), array());
                $image_name = (isset($check_last_id['id'])) ? ($check_last_id['id'] + 1) : 1;
            }
            $title = alphaID($image_name, FALSE, "clientsIMG").$image_name;
        }

        return $title;
    }
}