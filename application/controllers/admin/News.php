<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	var $data = array();
	var $table = 'blog';
	var $table_group = 'blog_groups';
	var $table_comments = 'blog_comments';

	var $user_group;
   
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('admin/login_model', 'blog/blog_model'));
		$this->login_model->auth_user();

		$this->data['user_group'] = $this->session->userdata("group");
	}

	public function index($offset=0)
	{
		$limit = 15;
		$filters = array('blog.type'=>'List');
		$sql_properties = $this->blog_model->sql_properties($limit, $offset);

		if(isset($_GET)) {
			$search = trim($this->input->get("k"));
			if($search) {
				$sql_properties["like"] = "blog.title";
				$sql_properties["like_value"] = $search;

				$sql_properties["or_like"] = "blog_groups.category";
				$sql_properties["OR_like_value"] = $search;
			}
		}

		$this->data['type'] = "";
		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#news/index/", $limit, 4, $total_results);
		$this->batch_model->render_page("admin/blog/blog", $this->data);
	}

	public function pending($offset=0)
	{
		$limit = 15;
		$filters = array('blog.type'=>'List', 'blog.enabled'=>2);
		$sql_properties = $this->blog_model->sql_properties($limit, $offset);

		if(isset($_GET)) {
			$search = trim($this->input->get("k"));
			if($search) {
                            $sql_properties["like"] = "blog.title";
                            $sql_properties["like_value"] = $search;

                            $sql_properties["or_like"] = "blog_groups.category";
                            $sql_properties["OR_like_value"] = $search;
			}
		}

		$this->data['type'] = "";
		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#news/index/", $limit, 4, $total_results);
		$this->batch_model->render_page("admin/blog/blog", $this->data);
	}
	
	public function images($offset=0)
	{
		$limit = 15;
		$filters = array("blog.type"=>"Gallery");
		$sql_properties = $this->blog_model->sql_properties($limit, $offset);

		if(isset($_GET)) {
			$search = trim($this->input->get("k"));
			if($search) {
				$sql_properties["like"] = "blog.title";
				$sql_properties["like_value"] = $search;

				$sql_properties["or_like"] = "blog_groups.category";
				$sql_properties["OR_like_value"] = $search;
			}
		}

		$this->data['type'] = "image";
		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);

		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#news/images/", $limit, 4, $total_results);
		$this->batch_model->render_page("admin/blog/blog", $this->data);
	}
	
	public function video($offset=0)
	{
		/*
		//$row = $this->blog_model->get_blogs(array("blog.type"=>"Gallery"), $limit=1);
		///$row = $row['blogs'];
		//print_r($row); return;
		if(isset($row['id'])) {
			for ($i=1; $i < 21; $i++) {
				$parsed_data['type'] = $row['type'];
				$parsed_data['title'] = $row['title']."-{$i}";
				$parsed_data['small_title'] = $row['small_title'];
		        $parsed_data['meta_keyword'] = $row['meta_keyword'];
		        $parsed_data['meta_description'] = $row['meta_description'];
				$parsed_data['category_id'] = $row['category_id'];
				$parsed_data['parent_id'] = $row['parent_id'];
				$parsed_data['sub_parent_id'] = $row['sub_parent_id'];
				$url = non_english_url_title($parsed_data['title']);
				$parsed_data['blog_url'] = $this->blog_model->check_url($url);
				$parsed_data['details'] = $row['details'];
		        $parsed_data['date'] = date("Y-m-d");
		        $parsed_data['time'] = time();
		        $parsed_data['homepage'] = $row['homepage'];
		        $parsed_data['highlight'] = $row['highlight'];
				$parsed_data['slider'] = $row['slider'];
				$parsed_data['selected'] = $row['selected'];
				$parsed_data['enabled'] = $row['enabled'];
				$parsed_data['user_id'] = $this->session->userdata('id');

				$blog_id = $this->batch_model->save("blog", $parsed_data);
				if($blog_id) {
					foreach ($row['images'] as $key => $image) {
						$image_parsed_data['blog_id'] = $blog_id;
						$image_parsed_data['image'] = $image['image'];
						$image_parsed_data['ext'] = $image['ext'];
						$image_parsed_data['caption'] = $image['caption'];
						$image_parsed_data['position'] = $image['position'];
						$this->batch_model->save("blog_images", $image_parsed_data);
					}
				}
			}
		}
*/

		$limit = 15;
		$filters = array("blog.type"=>"Video");
		$sql_properties = $this->blog_model->sql_properties($limit, $offset);

		if(isset($_GET)) {
			$search = trim($this->input->get("k"));
			if($search) {
				$sql_properties["like"] = "blog.title";
				$sql_properties["like_value"] = $search;

				$sql_properties["or_like"] = "blog_groups.category";
				$sql_properties["OR_like_value"] = $search;
			}
		}

		$this->data['type'] = "video";
		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table, $filters, "#news/video/", $limit, 4, $total_results);
		$this->batch_model->render_page("admin/blog/blog", $this->data);
	}

	public function manage($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('add', 'edit', 'translate', 'delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if ($mode == 'bulk_delete') {
		    $this->_bulk_delete(); return;
		}

		$type_post = $this->input->get("t");
		if($type_post) {
			$this->data['type_post_id'] = ($type_post == "b") ? 11 : 1;
		}

		$type = $this->input->post("type");
        //if($mode == "add") $this->form_validation->set_rules('title', 'Title', 'required|trim|callback_check_title');
		$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Enabled', 'required|trim');
		if($type != "Video" && $type != "Gallery") $this->form_validation->set_rules('details', 'Details', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data = $this->blog_model->parsed_data($mode, $id);
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save($this->table, $parsed_data, $comparison_fields);	

			if($mode == 'add') $id = $db_status;

			if($id) {
				if($mode == 'edit') {
			        $comparison_fields['name'] = 'blog_id';
			        $comparison_fields['value'] = $id;
			        $this->batch_model->delete_rows("blog_categories", $comparison_fields);
				}

				$category_ids = $this->input->post('category_id');
				$parent_ids = $this->input->post('parent_id');
				$sub_parent_ids = $this->input->post('sub_parent_id');
				foreach ($category_ids as $key => $category_id) {
					if($category_id) {
						$category_parsed_data['blog_id'] = $id;
						$category_parsed_data['category_id'] = $category_id;
						$category_parsed_data['parent_id'] = (isset($parent_ids[$key])) ? $parent_ids[$key] : 0;
						$category_parsed_data['sub_parent_id'] = (isset($sub_parent_ids[$key])) ? $sub_parent_ids[$key] : 0;
	
						$this->batch_model->save("blog_categories", $category_parsed_data);
					}
				}
			}

            $this->_save_tags($id, $mode);
			if($id && $_FILES) {
				$this->load->library('upload');
				$image_status = $this->blog_model->save_image($mode, $id);
				$db_status = ($db_status) ? $db_status : $image_status;
			}

			if($parsed_data['type'] == "Video") {
				$video_status = $this->blog_model->save_video($mode, $id);
				$db_status = ($db_status) ? $db_status : $video_status;
			}

			if($db_status) {
				$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"add", 'return_id'=>0), 1); return;
			}
			else {
              	$this->batch_model->ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>"")); return;
			}
		}
		else {
			if(validation_errors()) {
				$this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
			}			
		}

		$sql_properties = $this->blog_model->sql_properties(1);
		if($mode == 'delete') {
		    $this->_delete($id); return;
		}   

		elseif($mode == 'edit') {
			$return_data = $this->blog_model->get_blogs(array("blog.id"=>$id), 1, 0);
			//$return_data = $this->batch_model->get_rows($sql_properties, array("{$this->table}.id"=>$id));
			if(isset($return_data['blogs']['id'])) {
				$this->data['row_data'] = $return_data['blogs'];
                $this->data['blog_tags'] = $this->_blog_tags($id);
			}
			else { $this->data['mode'] = 'add'; }
		}

		$this->batch_model->render_page("admin/blog/blog-manage", $this->data);
	}
	
	public function check_title($title)
	{
		$exists = $this->batch_model->row_counter(array('title'=>$title), 'blog');
		if($exists) {
			$this->form_validation->set_message('check_title', 'Title already is being used. Please try with another Title.');
			return FALSE;
		}
		else { return TRUE; }
	}

    private function _blog_tags($blog_id=0)
    {
        $sql_properties['select'] = "blog_tags.*";
        $sql_properties['table'] = "blog_use_tags";
        $sql_properties['limit'] = 1000;
        $sql_properties['glue'] = "blog_tags";
        $sql_properties['pieces'] = "blog_tags.id = blog_use_tags.tag_id";
        $tags = $this->batch_model->get_rows($sql_properties, array("blog_id"=>$blog_id));

        $tag_list = array();
        $i=0;
        foreach ($tags as $key => $row) {
            $tag_list[$i]["id"] = $row['id'];
            $tag_list[$i]["text"] = $row['tag'];
            $i++;
        }
        

        return json_encode($tag_list);
    }

    private function _save_tags($blog_id=0, $mode='')
    {
        $tags = $this->input->post("tags");
        $tags_array = @explode(',', $tags);
        $db_status = 0;

        if($mode == 'edit') {
            $comparison_fields['name'] = 'blog_id';
            $comparison_fields['value'] = $blog_id;
            $this->batch_model->delete_rows("blog_use_tags", $comparison_fields);
        }

        if(is_array($tags_array) && count($tags_array) > 0) {
            foreach ($tags_array as $key => $value) {
                if(!empty($value)) {
                    $tag_id = trim($value);
                    if(!is_numeric($tag_id)) {
                    	$check_tag = $this->batch_model->get_rows(array("table"=>"blog_tags", "limit"=>1), array("tag"=>$tag_id));
						if(isset($check_tag['id'])) {
							$tag_id = $check_tag['id'];
						}
						else {
	                        $tag_parsed_data['tag'] = $tag_id;
	                        $tag_parsed_data['tag_url'] = strtolower(non_english_url_title(trim($tag_parsed_data['tag'])));
	                        $tag_id = $this->batch_model->save("blog_tags", $tag_parsed_data);
						}
                    }
    
                    if($tag_id) {
                        $parsed_data['blog_id'] = $blog_id;
                        $parsed_data['tag_id'] = $tag_id;
                        $db_status = $this->batch_model->save("blog_use_tags", $parsed_data);
                    }
                }
            }
        }

        return $db_status;
    }

    private function _delete($id=0)
    {
        $this->_delete_image($id);

        $comparison_fields['name'] = 'id';
        $comparison_fields['value'] = $id;
        $this->batch_model->delete_rows($this->table, $comparison_fields);
        echo 1; return; 
    }

    private function _bulk_delete()
    {
        $ids = $this->input->post("bulk_delete");
        if(is_array($ids)) {
            foreach ($ids as $key => $value) {
                $this->_delete_image($value);
            }
        }

        $this->batch_model->delete_rows($this->table, NULL, $ids);
        echo 1; return; 
    }
    
    private function _delete_image($id=0)
    {
        $return_data = $this->batch_model->get_rows(array('table'=>$this->table, 'limit'=>1), array('id'=>$id));
        if(isset($return_data['image'])) { @unlink("./uploads/blog/{$return_data['image']}"); }
        return;
    }

	public function del_img($image_id=0)
	{
		$this->blog_model->del_img($image_id);
		echo 1; return;
	}

	public function categories($offset=0)
	{
		$limit = 25;
		$filters = array();
		$sql_properties = $this->blog_model->group_sql_properties($limit, $offset);

		if($_GET) {
			$keyword = trim($this->input->get("k"));
			if($keyword) {
				$sql_properties["like"] = "blog_groups.category";
				$sql_properties["like_value"] = $keyword;
			}
		}

		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, $this->table_group, $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination($this->table_group, $filters, "#news/categories/", $limit, 4, $total_results);
		$this->batch_model->render_page("admin/blog/categories", $this->data);
	}

	public function category($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('search', 'add', 'edit', 'translate', 'delete', 'bulk_delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		if ($mode == 'bulk_delete') {
			$ids = $this->input->post("bulk_delete");
			$this->batch_model->delete_rows($this->table_group, NULL, $ids);
			echo 1; return;
		}

        $this->form_validation->set_rules('category', 'Category', 'required|trim');
        $this->form_validation->set_rules('meta_title', 'Meta Title', 'required|trim');
        $this->form_validation->set_rules('meta_keyword', 'Meta Keyword', 'required|trim');
        $this->form_validation->set_rules('meta_description', 'Meta Description', 'required|trim');
		$this->form_validation->set_rules('translation_id', 'Translation Id', 'trim');
		$this->form_validation->set_rules('enabled', 'Enabled', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data = $this->blog_model->parsed_group_data();
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save($this->table_group, $parsed_data, $comparison_fields);	

			if($mode == 'add') $id = $db_status;

			if($db_status) {
				$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"add", 'return_id'=>0), 1);
				return;
			}
			else {
              	$this->batch_model->ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>""));
				return;
			}
		}
		else {
			if(validation_errors()) {
				$this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
			}			
		}

		$sql_properties = $this->blog_model->group_sql_properties(1);
		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows($this->table_group, $comparison_fields);
			echo 1; return;
		}   

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows($sql_properties, array("{$this->table_group}.id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		}

		$this->batch_model->render_page("admin/blog/category", $this->data);
	}

	public function comments($offset=0)
	{
		$sql_properties['select'] = "blog_comments.*, members.name, members.username, members.email, blog.title, blog.blog_url";
		$sql_properties['table'] = "blog_comments";
		$sql_properties['limit'] = 25;
		$sql_properties['offset'] = $offset;
		$sql_properties['glue'][] = "members";
		$sql_properties['pieces'][] = "members.id = blog_comments.customer_id";
		$sql_properties['glue'][] = "blog";
		$sql_properties['pieces'][] = "blog.id = blog_comments.blog_id";
		
		$filters = array();
		$this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
		$total_results = $this->batch_model->row_counter($filters, "blog_comments", $sql_properties);
		$this->data['pagination'] = $this->batch_model->pagination("blog_comments", $filters, "#news/comments/", 25, 4, $total_results);
		$this->load->view("admin/blog/comments", $this->data);
	}


	public function comment($mode='add', $id=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('add', 'edit', 'delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

		$this->form_validation->set_rules('comment', 'Comment', 'required|trim');
		$this->form_validation->set_rules('enabled', 'Status', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data['comment'] = $this->input->post("comment");
			$parsed_data['enabled'] = $this->input->post("enabled");
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save("blog_comments", $parsed_data, $comparison_fields);	

			if($mode == 'add') $id = $db_status;

			if($db_status) {
				$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>$mode, 'return_id'=>$id), 1); return;
			}
			else {
              	$this->batch_model->ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!')); return;
			}
		}
		else {
			if(validation_errors()) {
				$this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
			}			
		}

		if($mode == 'delete') {
			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows("blog_comments", $comparison_fields);
		}   

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows(array("table"=>"blog_comments", "limit"=>1), array("id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		}

		$this->batch_model->render_page("admin/blog/comment", $this->data);
	}
	
	public function ajax_comment_status_update()
	{
		$db_status = $this->batch_model->ajax_single_update("blog_comments");
		if($db_status) {
			$this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1); return;
		}
		else {
			$this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!")); return;
		}
	}
	
	public function ajax_update_image_status($id = 0)
	{
		$db_status = $this->batch_model->ajax_single_update("blog_images");
		if($db_status) {
			$this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1); return;
		}
		else {
			$this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!")); return;
		}
	}
	
	public function ajax_status_update($group = 0)
	{
		$db_status = $this->batch_model->ajax_single_update(($group) ? $this->table_group : $this->table);
		if($db_status) {
			$this->batch_model->ajax_json_encode(array('mtitle'=>"Success!", 'mcontent'=>"Status Saved Successfully!"), 1); return;
		}
		else {
			$this->batch_model->ajax_json_encode(array('mcontent'=>"Status Saved Failed!")); return;
		}
	}

    public function options($mode='add', $id=0, $offset=0)
    {
        $this->data['mode'] = $mode;
        $this->data['current_id'] = $id;
        $valid_modes = array('add', 'edit', 'delete', 'bulk_delete');
        if(!in_array($mode, $valid_modes)) $mode = 'add';

        if ($mode == 'bulk_delete') {
            $ids = $this->input->post("bulk_delete");
            $this->batch_model->delete_rows("blog_options", NULL, $ids);
            echo 1; return;
        }

        $this->form_validation->set_rules('type', 'Option Type', 'required|trim');
        $this->form_validation->set_rules('blog_id', 'Blog', 'required|trim');
        if ($this->form_validation->run() == TRUE) {
            $parsed_data['type'] = $this->input->post("type");
            $parsed_data['website_id'] = $this->input->post("website_id");
            $parsed_data['blog_id'] = $this->input->post("blog_id");
            $parsed_data['website_id'] = $this->input->post("website_id");
            $comparison_fields = NULL;
            if($mode == 'edit') {
                $comparison_fields['name'] = 'id';
                $comparison_fields['value'] = $id;  
            }
            $db_status = $this->batch_model->save("blog_options", $parsed_data, $comparison_fields); 

            if($mode == 'add') $id = $db_status;

            if($db_status) {
                $this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"add", 'return_id'=>0), 1);
                return;
            }
            else {
                ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>""));
                return;
            }
        }
        else {
            if(validation_errors()) {
                $this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
            }           
        }

        if($mode == 'delete') {
            $comparison_fields['name'] = 'id';
            $comparison_fields['value'] = $id;
            $this->batch_model->delete_rows("blog_options", $comparison_fields);
            echo 1; return;
        }

        $limit = 15;
        $filters = array();
        $sql_properties['select'] = "blog_options.*, blog.title, blog.image";
        $sql_properties['table'] = "blog_options";
        $sql_properties['limit'] = $limit;
        $sql_properties['offset'] = $offset;
        $sql_properties['glue'] = "blog";
        $sql_properties['pieces'] = "blog.id = blog_options.blog_id";
        $this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
        $total_results = $this->batch_model->row_counter($filters, "blog_options", $sql_properties);
        $this->data['pagination'] = $this->batch_model->pagination("blog_options", $filters, "#blog/options/show/0/", $limit, 6, $total_results);

        $this->batch_model->render_page("admin/blog/options", $this->data);
    }

    public function tags($mode='add', $id=0, $offset=0)
    {
        $this->data['mode'] = $mode;
        $this->data['current_id'] = $id;
        $valid_modes = array('add', 'edit', 'delete', 'bulk_delete');
        if(!in_array($mode, $valid_modes)) $mode = 'add';

        if ($mode == 'bulk_delete') {
            $ids = $this->input->post("bulk_delete");
            $this->batch_model->delete_rows("blog_tags", NULL, $ids);
            echo 1; return;
        }

        $this->form_validation->set_rules('tag', 'Tag', 'required|trim');
        if ($this->form_validation->run() == TRUE) {
            $parsed_data['tag'] = $this->input->post("tag");
            $parsed_data['website_id'] = $this->input->post("website_id");
            $parsed_data['tag_url'] = strtolower(non_english_url_title(trim($parsed_data['tag'])));
            $parsed_data['popularity'] = $this->input->post("popularity");
            $comparison_fields = NULL;
            if($mode == 'edit') {
                $comparison_fields['name'] = 'id';
                $comparison_fields['value'] = $id;  
            }
            $db_status = $this->batch_model->save("blog_tags", $parsed_data, $comparison_fields); 

            if($mode == 'add') $id = $db_status;

            if($db_status) {
                $this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"add", 'return_id'=>0), 1);
                return;
            }
            else {
                ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>""));
                return;
            }
        }
        else {
            if(validation_errors()) {
                $this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
            }           
        }


        $limit = 15;
        $filters = array();
        $sql_properties['select'] = "blog_tags.*";
        $sql_properties['table'] = "blog_tags";
        $sql_properties['limit'] = $limit;
        $sql_properties['offset'] = $offset;
		$sql_properties['order_by'] = "blog_tags.id";
		$sql_properties['order_type'] = "desc";

        if($mode == 'delete') {
            $comparison_fields['name'] = 'id';
            $comparison_fields['value'] = $id;
            $this->batch_model->delete_rows("blog_tags", $comparison_fields);
            echo 1; return;
        }

		elseif($mode == 'edit') {
			$sql_properties['limit'] = 1;
			$return_data = $this->batch_model->get_rows($sql_properties, array("blog_tags.id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else $this->data['mode'] = 'add';
			
			$sql_properties['limit'] = $limit;
		}

        $this->data['rows'] = $this->batch_model->get_rows($sql_properties, $filters);
        $total_results = $this->batch_model->row_counter($filters, "blog_tags", $sql_properties);
        $this->data['pagination'] = $this->batch_model->pagination("blog_tags", $filters, "#blog/tags/show/0/", $limit, 6, $total_results);

        $this->batch_model->render_page("admin/blog/tags", $this->data);
    }

	public function highlight()
	{
		if($_POST) {
            $comparison_fields['name'][] = 'page';
            $comparison_fields['value'][] = "Home";
            $this->batch_model->delete_rows("highlight_blog", $comparison_fields);

			$news_ids = $this->input->post("news");
			$position = $this->input->post("position");

			if(is_array($news_ids) && count($news_ids) > 0) {
				foreach ($news_ids as $key => $row) {
					if($row && $position[$key]) {
						$parsed_data['page'] = "Home";
						$parsed_data['blog_id'] = $row;
						//$parsed_data['category_id'] = $category_id;
						$parsed_data['position'] = $position[$key];

						$this->batch_model->save("highlight_blog", $parsed_data);
					}
				}
			}

			$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!'), 1); return;
		}

		$this->data['highlight_blogs'] = $this->batch_model->get_rows(array("select"=>"blog.*", "table"=>"highlight_blog", "limit"=>100, "order_by"=>"position", "order_type"=>"asc", "glue"=>"blog", "pieces"=>"blog.id = highlight_blog.blog_id"), array("page"=>"Home"));
		$total_highlight = count($this->data['highlight_blogs']);
		$limit = (20 - $total_highlight);

		$ids = array();
		foreach ($this->data['highlight_blogs'] as $key => $row) {
			$ids[] = $row['id'];
		}
		if(count($ids) > 0) {
			$properties['where_not_in'] = "blog.id";
			$properties['where_not_in_array'] = $ids;
		}

		$properties['limit'] = $limit;
		if($limit > 0) $news = $this->blog_model->get_news_by_category(array("blog.enabled"=>1), $properties);
		if(isset($news['blogs'])) {
			$this->data['news'] = @array_merge($this->data['highlight_blogs'], $news['blogs']);
		}
		else $this->data['news'] = $this->data['highlight_blogs'];
		//$this->data['news'] = (isset($news['blogs'])) ? $news['blogs'] : array();
		$this->batch_model->render_page("admin/blog/highlight", $this->data);
	}

	public function position($category_id=0)
	{
		if(!$category_id) { echo "Invalid Token!"; return; }

		if($_POST) {
            $comparison_fields['name'][] = 'page';
            $comparison_fields['value'][] = "Category";
            $comparison_fields['name'][] = 'category_id';
            $comparison_fields['value'][] = $category_id;
            $this->batch_model->delete_rows("highlight_blog", $comparison_fields);

			$news_ids = $this->input->post("news");
			$position = $this->input->post("position");
			
			if(is_array($news_ids) && count($news_ids) > 0) {
				foreach ($news_ids as $key => $row) {
					if($row && $position[$key]) {
						$parsed_data['page'] = "Category";
						$parsed_data['blog_id'] = $row;
						$parsed_data['category_id'] = $category_id;
						$parsed_data['position'] = $position[$key];
						
						$this->batch_model->save("highlight_blog", $parsed_data);
					}
				}
			}

			$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!'), 1); return;
		}

		$this->data['category_id'] = $category_id;
		$this->data['category_data'] = $this->batch_model->get_rows(array("table"=>"blog_groups", "limit"=>1), array("id"=>$category_id));


		$this->data['highlight_blogs'] = $this->batch_model->get_rows(array("select"=>"blog.*", "table"=>"highlight_blog", "limit"=>100, "order_by"=>"position", "order_type"=>"asc", "glue"=>"blog", "pieces"=>"blog.id = highlight_blog.blog_id"), array("category_id"=>$category_id, "page"=>"Category"));
		$total_highlight = count($this->data['highlight_blogs']);
		$limit = (20 - $total_highlight);

		$ids = array();
		foreach ($this->data['highlight_blogs'] as $key => $row) {
			$ids[] = $row['id'];
		}
		if(count($ids) > 0) {
			$properties['where_not_in'] = "blog.id";
			$properties['where_not_in_array'] = $ids;
		}

		$properties['limit'] = $limit;
		if($limit > 0) $news = $this->blog_model->get_news_by_category(array("blog.enabled"=>1, "blog_categories.category_id"=>$category_id), $properties);
		if(isset($news['blogs'])) {
			$this->data['news'] = @array_merge($this->data['highlight_blogs'], $news['blogs']);
		}
		else $this->data['news'] = $this->data['highlight_blogs'];

		
		//$news = $this->blog_model->get_news_by_category(array("blog_categories.category_id"=>$category_id), array('limit'=>20));
		//$this->data['news'] = $news['blogs'];
		$this->batch_model->render_page("admin/blog/position", $this->data);
	}

	public function agents($mode='add', $id=0, $offset=0)
	{
		$this->data['mode'] = $mode;
		$this->data['current_id'] = $id;
		$valid_modes = array('add', 'edit', 'delete');
		if(!in_array($mode, $valid_modes)) $mode = 'add';

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
		if ($this->form_validation->run() == TRUE) {
			$parsed_data['name'] = $this->input->post("name");
			$comparison_fields = NULL;
			if($mode == 'edit') {
				$comparison_fields['name'] = 'id';
				$comparison_fields['value'] = $id;	
			}
			$db_status = $this->batch_model->save("agents", $parsed_data, $comparison_fields);	

			if($mode == 'add') $id = $db_status;

	        if($id && isset($_FILES['userfile']['name'])) {
	            $ext = @pathinfo($_FILES['userfile']['name']);
	            if(isset($ext['extension'])) {
	                $fileExt = $ext['extension'];

	                $config['overwrite'] = TRUE;
	                $config['upload_path'] = "./uploads/agents/";
	                $config['allowed_types'] = 'jpg|png|jpeg';
	                $config['file_name']  = "{$id}.{$fileExt}";
	                $this->load->library('upload', $config);
	                if ($this->upload->do_upload()) {
	                    $upload_data = $this->upload->data();
	                    $config['overwrite'] = TRUE;
	                    $config['image_library'] = 'gd2';
	                    $config['source_image'] = "./uploads/agents/{$upload_data['file_name']}";
	                    $config['create_thumb'] = FALSE;
	                    $config['maintain_ratio'] = FALSE;
	                    $this->load->library('image_lib', $config);         
	                    $this->image_lib->resize();

						$comparison_fields['name'] = 'id';
						$comparison_fields['value'] = $id;
	                    $parsed_data['image'] = $upload_data['file_name'];
	                    $db_status1 = $this->batch_model->save('agents', $parsed_data, $comparison_fields);
	                    
						$db_status = ($db_status) ? $db_status : $db_status1;
	                }
	            }
	        }

			if($db_status) {
				$this->batch_model->ajax_json_encode(array('mcontent'=>'Congratulations! Your form was submitted and information saved successfully!', 'data_mode'=>"add", 'return_id'=>0), 1); return;
			}
			else {
              	$this->batch_model->ajax_json_encode(array('mtitle'=>'Notice!', 'mcontent'=>'No Changes made!', 'data_mode'=>"")); return;
			}
		}
		else {
			if(validation_errors()) {
				$this->batch_model->ajax_json_encode(array('validation_errors'=>1)); return;
			}			
		}

		if($mode == 'delete') {
			$check_agent = $this->batch_model->get_rows(array("table"=>"agents", "limit"=>1), array("id"=>$id));
			if(isset($check_agent['image'])) { @unlink("./uploads/agents/{$check_agent['image']}"); }

			$comparison_fields['name'] = 'id';
			$comparison_fields['value'] = $id;
			$this->batch_model->delete_rows("agents", $comparison_fields);
			echo 1; return;
		}   

		elseif($mode == 'edit') {
			$return_data = $this->batch_model->get_rows(array("table"=>"agents", "limit"=>1), array("id"=>$id));
			if(isset($return_data['id'])) $this->data['row_data'] = $return_data;
			else { $this->data['mode'] = 'add'; }
		}


		$limit = 15;
		$filters = array();
		$this->data['rows'] = $this->batch_model->get_rows(array("table"=>"agents", "limit"=>$limit), $filters);
		$this->data['pagination'] = $this->batch_model->pagination("agents", $filters, "#news/agents/", $limit, 4);
		$this->batch_model->render_page("admin/blog/agents", $this->data);
	}
}