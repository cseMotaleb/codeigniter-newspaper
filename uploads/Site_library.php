<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_library {
	var $CI;

	public function Site_library() {
		$this->CI =& get_instance();
		//$this->CI->load->model(array('pages_model'));		
    }
	
	function rows_to_tree($raw, $id_key = 'id', $parent_key = 'parent_id') {
		// First, transform $raw to $rows so that array key == id
		$rows = array();
		foreach ($raw as $row) {
			$rows[$row[$id_key]] = $row;
		}
		$tree = array();
		$tree_index = array(); // Storing the reference to each node
	
		while (count($rows)) {
			foreach ($rows as $id => $row) {
				if ($row[$parent_key]) { // If it has parent
					// Abnormal case: has parent id but no such id exists
					if (!array_key_exists($row[$parent_key], $rows) AND !array_key_exists($row[$parent_key], $tree_index)) {
						unset($rows[$id]);
					}
					// If the parent id exists in $tree_index, insert itself
					else if (array_key_exists($row[$parent_key], $tree_index)) {
						$parent = &$tree_index[$row[$parent_key]];
						$parent['children'][$id] = array('node' => $row, 'children' => array());
						$tree_index[$id] = &$parent['children'][$id];
						unset($rows[$id]);
					}
				} else { // Top parent
					$tree[$id] = array('node' => $row, 'children' => array());
					$tree_index[$id] = &$tree[$id];
					unset($rows[$id]);
				}
			}
		}
		return $tree;
	}

	public function information_menu($filters=array()) {
		$data = array();
		$webpages = get_rows($filters, array('table'=>'website_pages', 'limit'=>10));
		$data['webpages_menu_list'] = "";
		foreach($webpages as $website_pages) {
				$str = strtolower(str_replace(' ', '-', $website_pages['title']));
				$url = site_url("services/{$str}");
				$ucword = ucwords(str_replace('-', ' ', $website_pages['title']));
				$data['webpages_menu_list'] .= "<li><a href=\"{$url}/\">{$ucword}</a></li>" ;
		} 
		return $data;
	}

	public function get_image_list($filters=array('type'=>'Home Page', 'status'=>'Enabled'), $default='')
	{
		$data = array();
		if(!isset($filters['status'])) $filters['status'] = 'Enabled';
		$values = $this->CI->batch_model->get_rows(array('table'=>'media', 'limit'=>1000), $filters);
		$data['values'] = (isset($values) && is_array($values)) ? $values : array();
		$data['image_list'] = "<option value=\"\"></option>";
		foreach($data['values'] as $value) {
				$this_image = (file_exists("{$value['url']}")) ? base_url() . "{$value['url']}" : base_url() . "responsive/img/avatars/avatar.png";
				if($default == $value['url']) $selected = 'selected="selected"';
				else $selected = '';				
				$data['image_list'] .= "<option value=\"{$value['url']}\" {$selected} data-image='{$this_image}' data-title='{$value['title']}'>{$value['title']}</option>" ;
		} 
		return $data;
	}
	
	public function members($filters=array(), $default='')
	{
		$data = array();
		$data['members'] = get_rows($filters, array('table'=>'members', 'limit'=>10000, 'oder_by'=>'first_name', 'order_type'=>'asc'));
		$data['member_list'] = '';
		foreach($data['members'] as $member) {
				$selected = ($default == $member['id']) ? 'selected="selected"' : '';
				$data['member_list'] .= "<option value=\"{$member['id']}\" {$selected}>{$member['first_name']} {$member['last_name']}</option>" ;
		}
		return $data;
	}

	public function menus($filters=array())
	{
		$data = array();
		$this->CI->load->model("cms/content_model");
		$sql_properties = $this->CI->content_model->sql_properties(1000);
		$data['values'] = $this->CI->batch_model->get_rows($sql_properties, $filters);
		$data['page_list'] = "";
		foreach($data['values'] as $value) {
			$value['url'] = urldecode($value['url']);
			$url = site_url($value['url']);
			$data['page_list'] .= "<li><a href=\"{$url}\">{$value['page']}</a></li>" ;
		} 
		return $data;
	}

	public function widget_menu($filters=array())
	{
		$data = array();
		$data['values'] = $this->CI->batch_model->get_rows(array('table'=>'menu', 'limit'=>1000), $filters);
		return $data;
	}
	
	public function controllerlist($subdir=FALSE, $filters=array(), $default='') {
		$data = array();
		$this->CI->load->library('controllerlist');	
		$this->CI->controllerlist->set_options($subdir);
		$values = $this->CI->controllerlist->getControllers();
		$data['raw'] = (isset($values) && is_array($values)) ? $values : array();
		$data['cl'] = "<option value=\"\"></option>";
		foreach($data['raw'] as $key=>$controller) {
				if($default == $key) $selected = 'selected="selected"';
				else $selected = '';				
				$data['cl'] .= "<option value=\"{$key}\" {$selected}>{$key}</option>" ;
		} 
		return $data;
	}

	public function countries($filters=array(), $default='') {
		$data = array();
		$data['countries'] = get_rows($filters, array('table'=>'countries', 'limit'=>10000, 'oder_by'=>'name', 'order_type'=>'asc'));
		$data['country_list'] = '';
		foreach($data['countries'] as $country) {
				$selected = ($default == $country['id']) ? 'selected="selected"' : '';
				$data['country_list'] .= "<option value=\"{$country['id']}\" {$selected}>{$country['name']}</option>" ;
		}
		return $data;
	}	
	
	public function users_rules($filters=array(), $check_addon=FALSE, $preg_match=FALSE) {
		if($check_addon!=FALSE && $preg_match!=FALSE) {
			$addon_rules = $this->CI->session->userdata("addon_rules");
			if(isset($addon_rules['All']) && preg_match('/1:1:1/',$addon_rules['All']) || isset($addon_rules["{$check_addon}"]) && preg_match("{$preg_match}", $addon_rules["{$check_addon}"])) $return = 1;
			else $return = 0;
			return $return;
		}
		else {
			$users_rules = $this->CI->batch_model->get_rows(array('table'=>'users_rules', 'limit'=>10000), $filters);
			
			$rules['addon_rules'] = array();
			foreach($users_rules as $key=>$rule) {
				$addon = $rule['addon'];
				$rules['addon_rules']["{$addon}"] = "{$rule['read']}:{$rule['write']}:{$rule['delete']}";
			}
			
			return $rules;
		}
	}
	
	public function addons($filters=array(), $batch=array()) {
		$data = array();

		$default = (isset($batch['default'])) ? $batch['default'] : '';
		$data['addons'] = get_rows($filters, array('table'=>'addons', 'oder_by'=>'addon', 'order_type'=>'asc', 'limit'=>10000));
		$data['addon_list'] = "";
		foreach($data['addons'] as $row) {
				if($default == $row['addon']) $selected = 'selected="selected"'; else $selected = '';
				$data['addon_list'] .= "<option value=\"{$row['addon']}\" {$selected}>{$row['addon']}</option>";
		}
		return $data;
	}
	
	public function options($sql_properties = array(), $filters=array())
	{
		$data = array();

		$default = (isset($sql_properties['default'])) ? $sql_properties['default'] : '';
		$option_value = (isset($sql_properties['option_value'])) ? $sql_properties['option_value'] : 'id';
		$option = (isset($sql_properties['option'])) ? $sql_properties['option'] : '';

		$data['options'] = $this->CI->batch_model->get_rows($sql_properties, $filters);
		$data['option_list'] = "";
		foreach($data['options'] as $row) {
				$row_value = $row[$option_value];
				$row_option = $row[$option];
				if($default == $row_value) $selected = 'selected="selected"'; else $selected = '';
				
				$data['option_list'] .= "<option value=\"{$row_value}\" {$selected}>{$row_option}</option>";
		}
		return $data;
	}
	
	public function groups($filters=array(), $batch=array()) {
		$data = array();
		
		$default = (isset($batch['default'])) ? $batch['default'] : '';
		$data['groups'] = get_rows($filters, array('table'=>'user_groups', 'oder_by'=>'group', 'order_type'=>'asc', 'limit'=>10000));
		$data['group_list'] = "";
		
		foreach($data['groups'] as $row) {
    			$replace = strtolower(str_replace(' ', '-', $row['group']));
    			$group_url = site_url("users/rules/details/{$replace}");
				if($default == $row['id']) $selected = 'selected="selected"'; else $selected = '';
			
				$data['group_list'] .= "<li><a href="."{$group_url}".">{$row['group']}</a></li>";
		}
		return $data;
	}
		
	public function top_lang($filters=array(), $default='') {
		$data = array();
		$default = (empty($default)) ? $this->CI->session->userdata('lang') : 'en';
		$current_url = urlencode(current_url());
		$data['language'] = get_rows($filters, array('table'=>'language', 'limit'=>100));
		$data['language_list'] = "";
		$data['top_selected_lang'] = "";

		foreach($data['language'] as $row) {
			$language = ($default && $default==$row['lang']) ? $row['language'] : "English";
			$data['top_selected_lang'] = "{$language}";
			
			$data['language_list'] .= "<li><a style=\"color: #000;\" href=\"switcher?lang={$row['lang']}&redir={$current_url}\">{$row['language']}</a></li>";
		}
		
		return $data;
	}
	
	public function language($filters=array(), $default='') {
		$data = array();
		$data['language'] = get_rows($filters, array('table'=>'language', 'limit'=>10000, 'oder_by'=>'lang', 'order_type'=>'asc'));
		foreach($data['language'] as $row) {
				if($default == $row['lang']) $selected = 'selected="selected"';
				else $selected = '';				
				$data['language_list'] .= "<option value=\"{$row['lang']}\" {$selected}>{$row['language']}</option>" ;
		} 
		return $data;
	}

	public function social_network()
	{
		$data = array();

		$data['company_address'] = $this->CI->config->item("company_address");
		$data['company_city'] = $this->CI->config->item("company_city");
		$data['company_country'] = $this->CI->config->item("company_country");
		$data['company_name'] = $this->CI->config->item("company_name");
		$data['company_phone'] = $this->CI->config->item("company_phone");
		$data['company_mobile'] = $this->CI->config->item("company_mobile");
		$data['company_email'] = $this->CI->config->item("company_email");
		$data['company_url'] = $this->CI->config->item("company_url");
		$data['company_fax'] = $this->CI->config->item("company_fax");
		$data['client_email'] = $this->CI->session->userdata("email");
		$data['company_url'] = $this->CI->config->item("company_url");
		$data['powered_by'] = $this->CI->config->item("powered_by");
		$data['powered_by_link'] = $this->CI->config->item("powered_by_link");
	
		$twitter = $this->CI->config->item("twitter_link");
		$facebook = $this->CI->config->item("facebook_link");
		$linkedin = $this->CI->config->item("linkedin");
		$skype = $this->CI->config->item("skype");
		$flickr = $this->CI->config->item("flickr");
		$google_plus = $this->CI->config->item("googleplus_link");
		$youtube = $this->CI->config->item("youtube_link");
	
		$data['twitter'] = (!empty($twitter)) ? $twitter : '#';
		$data['facebook'] = (!empty($facebook)) ? $facebook : '#';
		$data['linkedin'] = (!empty($linkedin)) ? $linkedin : '#';
		$data['skype'] = (!empty($skype)) ? $skype : '#';
		$data['flickr'] = (!empty($flickr)) ? $flickr : '#';
		$data['googleplus'] = (!empty($googleplus)) ? $googleplus : '#';
		$data['youtube'] = (!empty($youtube)) ? $youtube : '#';
		
		return $data;
	}

    public function all_config()
    {
        $data = array();

        $data['meta_title'] = $this->CI->config->item("meta_title");
        $data['meta_keyword'] = $this->CI->config->item("meta_keyword");
        $data['meta_description'] = $this->CI->config->item("meta_description");

        $data['company_address'] = $this->CI->config->item("company_address");
        $data['company_city'] = $this->CI->config->item("company_city");
        $data['company_country'] = $this->CI->config->item("company_country");
        $data['company_name'] = $this->CI->config->item("company_name");
        $data['company_phone'] = $this->CI->config->item("company_phone");
        $data['company_mobile'] = $this->CI->config->item("company_mobile");
        $data['company_email'] = $this->CI->config->item("company_email");
        $data['company_url'] = $this->CI->config->item("company_url");
        $data['company_fax'] = $this->CI->config->item("company_fax");
        $data['client_email'] = $this->CI->session->userdata("email");
        $data['company_url'] = $this->CI->config->item("company_url");
        $data['powered_by'] = $this->CI->config->item("powered_by");
        $data['powered_by_link'] = $this->CI->config->item("powered_by_link");
        
        $data['support_phone'] = $this->CI->config->item("support_phone");
        $data['support_email'] = $this->CI->config->item("support_email");
        $data['support_address'] = $this->CI->config->item("support_address");
        $data['support_city'] = $this->CI->config->item("support_city");
        $data['support_country'] = $this->CI->config->item("support_country");
        
        $data['sales_phone'] = $this->CI->config->item("sales_phone");
        $data['sales_email'] = $this->CI->config->item("sales_email");
        $data['sales_address'] = $this->CI->config->item("sales_address");
        $data['sales_city'] = $this->CI->config->item("sales_city");
        $data['sales_country'] = $this->CI->config->item("sales_country");

        $data['latitude'] = $this->CI->config->item("latitude");
        $data['longitude'] = $this->CI->config->item("longitude");
        $data['currency'] = $this->CI->config->item("currency");
        $data['currency_symbol'] = $this->CI->config->item("currency_symbol");
    
        $twitter = $this->CI->config->item("twitter_link");
        $facebook = $this->CI->config->item("facebook_link");
        $linkedin = $this->CI->config->item("linkedin");
        $skype = $this->CI->config->item("skype");
        $flickr = $this->CI->config->item("flickr");
        $google_plus = $this->CI->config->item("googleplus_link");
        $youtube = $this->CI->config->item("youtube_link");
    
        $data['twitter'] = (!empty($twitter)) ? $twitter : '#';
        $data['facebook'] = (!empty($facebook)) ? $facebook : '#';
        $data['linkedin'] = (!empty($linkedin)) ? $linkedin : '#';
        $data['skype'] = (!empty($skype)) ? $skype : '#';
        $data['flickr'] = (!empty($flickr)) ? $flickr : '#';
        $data['googleplus'] = (!empty($googleplus)) ? $googleplus : '#';
        $data['youtube'] = (!empty($youtube)) ? $youtube : '#';

        $data['member_email'] = $this->CI->session->userdata('email');

        return $data;
    }

    function imageResize($source_image='', $new_image='', $width=50, $height=50) {
        // Configuration
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_image;
        echo $config['new_image'] = $new_image;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
        $config['height'] = $height;

        // Load the Library
        $this->CI->load->library('image_lib', $config);
 
        // resize image
        $this->CI->image_lib->resize();
        // handle if there is any problem
        if ( ! $this->CI->image_lib->resize()){
            echo $this->CI->image_lib->display_errors();
        }

        return TRUE;
    }
}