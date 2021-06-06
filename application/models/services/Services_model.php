<?php
class Services_model extends CI_Model {

	var $table = 'services';

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
        $parsed_data['service_name'] = $this->input->post('service_name');
		$parsed_data['url'] = strtolower(url_title(trim($parsed_data['service_name'])));
		$parsed_data['url'] = $this->check_url($parsed_data['url'], $mode, $id);
        $parsed_data['meta_title'] = $this->input->post('meta_title');
        $parsed_data['meta_keyword'] = $this->input->post('meta_keyword');
        $parsed_data['meta_description'] = $this->input->post('meta_description');
		$parsed_data['details'] = $this->input->post('details');
		$parsed_data['homepage'] = $this->input->post('homepage');
		$parsed_data['short_details'] = $this->input->post('short_details');
		$parsed_data['enabled'] = $this->input->post('enabled');

		if(isset($_FILES['userfile']['name'])) {
			$ext = @pathinfo($_FILES['userfile']['name']);
			if(isset($ext['extension'])) {
                $fileExt = strtolower($ext['extension']);
                $title = strtolower(url_title($ext['filename']));
                $title = $this->_image_filename($title, $mode, $id);

                if($mode == 'add') {
                    if (file_exists("./uploads/services/{$title}.{$fileExt}")) { $title = $title.'-1'; }
                }
                elseif ($mode == 'edit') { $this->delete_image($id); }
                $image_name = $title;

				$config['overwrite'] = TRUE;
				$config['upload_path'] = "./uploads/services/";
				$config['allowed_types'] = 'jpg|png|jpeg';
				$config['file_name']  = "{$image_name}.{$fileExt}";
				$this->load->library('upload', $config);
				if ($this->upload->do_upload()) {
					$upload_data = $this->upload->data();
					$config['overwrite'] = TRUE;
					$config['image_library'] = 'gd2';
					$config['source_image'] = "./uploads/services/{$upload_data['file_name']}";
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
        if(isset($check_image['image'])) { @unlink("./uploads/services/{$check_image['image']}"); }
        return;
    }

	public function check_url($url="", $mode='', $id=0)
	{
		$filters = array("url"=>$url);
		if($id) $filters['id !='] = $id;
		$return_data = $this->batch_model->get_rows(array("table"=>"services", "limit"=>1), $filters);
		return (isset($return_data['url'])) ? "{$return_data['url']}-1" : $url;
	}

    private function _image_filename($title='', $mode='', $id=0)
    {
        if(empty($title)) {
            $image_name = $id;
            if($mode == 'add') {
                $check_last_id = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1, 'order_by'=>'id', 'order_type'=>'desc'), array());
                $image_name = (isset($check_last_id['id'])) ? ($check_last_id['id'] + 1) : 1;
            }
            $title = alphaID($image_name, FALSE, "newsIMG").$image_name;
        }

        return $title;
    }

	public function find($filters=array(), $limit=100, $offset=0)
	{
		$return = array();

		$k = trim($this->input->get("k"));
		if($k) {
			$this->db->like("services.service_name", $k);
			$this->db->or_like("services.meta_title", $k);
			$this->db->or_like("services.meta_keyword", $k);
			$this->db->or_like("services.meta_description", $k);
			$this->db->or_like("services.details", $k);
		}
		
		$this->db->where($filters);
		$this->db->limit($limit, $offset);
		$this->db->from("services");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				if($limit > 1) $return[] = $row;
				else $return = $row;
			}
		}

		return $return;
	}

	public function find_news($filters=array(), $limit=100, $offset=0)
	{
		$return = array();

		$k = trim($this->input->get("k"));
		if($k) {
			$this->db->like("news.title", $k);
			$this->db->or_like("news.meta_keyword", $k);
			$this->db->or_like("news.meta_description", $k);
			$this->db->or_like("news.details", $k);
		}
		
		$this->db->where($filters);
		$this->db->limit($limit, $offset);
		$this->db->from("news");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				if($limit > 1) $return[] = $row;
				else $return = $row;
			}
		}

		return $return;
	}

	public function find_contents($filters=array(), $limit=100, $offset=0)
	{
		$return = array();

		$k = trim($this->input->get("k"));
		if($k) {
			$this->db->like("pages.page", $k);
			$this->db->or_like("pages.meta_title", $k);
			$this->db->or_like("pages.meta_keyword", $k);
			$this->db->or_like("pages.meta_description", $k);
			$this->db->or_like("pages.content", $k);
		}
		
		$this->db->where(array("status"=>"Public"));
		$this->db->limit($limit, $offset);
		$this->db->from("pages");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				if($limit > 1) $return[] = $row;
				else $return = $row;
			}
		}

		return $return;
	}

	public function find_wigets($filters=array(), $limit=100, $offset=0)
	{
		$return = array();

		$k = trim($this->input->get("k"));
		if($k) {
			$this->db->like("widgets.section_id", $k);
			$this->db->or_like("widgets.title", $k);
			$this->db->or_like("widgets.description", $k);
		}
		
		$this->db->where($filters);
		$this->db->limit($limit, $offset);
		$this->db->from(" widgets");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				if($limit > 1) $return[] = $row;
				else $return = $row;
			}
		}

		return $return;
	}

//product categories
	public function categories($value='')
	{
		
	}
}