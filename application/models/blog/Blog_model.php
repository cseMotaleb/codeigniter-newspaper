<?php

class Blog_model extends CI_Model
{

    var $table = 'blog';
    var $table_group = 'blog_groups';
    var $table_comments = 'blog_comments';

    function __construct()
    {
        parent::__construct();
    }

    public function get_blogs($filters = array(), $limit = 10, $offset = 0, $properties = array())
    {
        $return = array();
        $return['blogs'] = array();
        $return['pagination'] = "";

        $comments_sql_properties = $this->comments_sql_properties(15, 0);

        $this->db->select("{$this->table}.*, blog_categories.category_id, blog_categories.parent_id,
                            users.first_name as user_first_name, users.last_name as user_last_name, users.email as user_email");
        $this->db->where($filters);

        if (isset($properties['where_not_in'])) $this->db->where_not_in($properties['where_not_in'], $properties['where_not_in_array']);

        $this->db->limit($limit, $offset);
        $this->db->order_by("blog.id", "desc");
        $this->db->group_by("blog.id");

        if (isset($properties['tag_blog']) && $properties['tag_blog'] === TRUE) {
            $this->db->from("blog_use_tags");
            $this->db->join("blog", "blog.id = blog_use_tags.blog_id", "left");
            $this->db->join("blog_tags", "blog_tags.id = blog_use_tags.tag_id", "left");
        } else {
            $this->db->from("blog");
        }

        $this->db->join("users", "users.id = {$this->table}.user_id", "left");
        $this->db->join("blog_categories", "blog_categories.blog_id = blog.id", "left");

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if (isset($properties['details'])) $image_filters = array("blog_id" => $row['id'], "enabled" => 1);
                else $image_filters = array("blog_id" => $row['id'], "enabled !=" => 0);
                $row['images'] = $this->batch_model->get_rows(array("table" => "blog_images", "limit" => 1000, "order_by" => "blog_images.position", "order_type" => "asc"), $image_filters);
                $row['videos'] = $this->batch_model->get_rows(array("table" => "blog_video", "limit" => 1000, "order_by" => "blog_video.position", "order_type" => "asc"), array("blog_id" => $row['id']));
                $row['tags'] = $this->blog_use_tags(array("blog_use_tags.blog_id" => $row['id']), 1000);
                $row['alpha_blog_id'] = alphaID($row['id'], FALSE, "BlogComment");

                $default_image = '';
                if (is_countable($row['images']) && count($row['images']) > 0) $default_image = newsDefaultImage($row, $properties);


                $row['default_image'] = ($default_image) ? $default_image : base_url() . "img/blank.jpg";
                $row['img_thumbnail'] = ($default_image) ? "" : "img-thumbnail";

                if ($limit > 1) $return['blogs'][] = $row;
                else $return['blogs'] = $row;
            }
        }


        unset($this->db);
        $site_url = (isset($properties['site_url'])) ? $properties['site_url'] : "en/blogs/";
        $url_segment = (isset($properties['url_segment'])) ? $properties['url_segment'] : 3;
        $this->db->where($filters);

        if (isset($properties['tag_blog']) && $properties['tag_blog'] === TRUE) {
            $this->db->from("blog_use_tags");
            $this->db->join("blog", "blog.id = blog_use_tags.blog_id", "left");
            $this->db->join("blog_tags", "blog_tags.id = blog_use_tags.tag_id", "left");
        } else {
            $this->db->from("blog");
        }

        $this->db->join("users", "users.id = {$this->table}.user_id", "left");
        $this->db->join("blog_categories", "blog_categories.blog_id = blog.id", "left");
        $total_results = $this->db->count_all_results();
        $return['pagination'] = $this->batch_model->pagination("blog", $filters, site_url($site_url), $limit, $url_segment, $total_results);

        return $return;
    }

    public function get_news_by_category($filters = array(), $properties = array())
    {
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 10;
        $offset = (isset($properties['offset'])) ? $properties['offset'] : 0;
        $details = (isset($properties['details'])) ? $properties['details'] : TRUE;

        $return = array();
        $return['blogs'] = array();
        $return['pagination'] = "";

        $this->db->select("blog.*");
        $this->db->where($filters);
        if (isset($properties['where_not_in'])) $this->db->where_not_in($properties['where_not_in'], $properties['where_not_in_array']);

        $this->db->limit($limit, $offset);
        $this->db->order_by("blog.id", "desc");
        $this->db->group_by("blog.id");
        $this->db->join("blog", "blog.id = blog_categories.blog_id");
        $this->db->join("blog_groups", "blog_groups.id = blog_categories.category_id");
        $this->db->from("blog_categories");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($details === TRUE) {
                    $row['images'] = $this->batch_model->get_rows(array("table" => "blog_images", "limit" => 1000, "order_by" => "blog_images.position", "order_type" => "asc"), array("blog_id" => $row['id'], "enabled !=" => 0));
                    $row['videos'] = $this->batch_model->get_rows(array("table" => "blog_video", "limit" => 1000, "order_by" => "blog_video.position", "order_type" => "asc"), array("blog_id" => $row['id']));
                    $row['tags'] = $this->blog_use_tags(array("blog_use_tags.blog_id" => $row['id']), 1000);
                    $row['alpha_blog_id'] = alphaID($row['id'], FALSE, "BlogComment");

                    $default_image = newsDefaultImage($row, $properties);
                    $row['default_image'] = ($default_image) ? $default_image : base_url() . "img/blank.jpg";
                    $row['img_thumbnail'] = ($default_image) ? "" : "img-thumbnail";
                }

                if ($limit > 1) $return['blogs'][] = $row;
                else $return['blogs'] = $row;
            }
        }

        return $return;
    }

    public function get_highlight_blogs($filters = array(), $limit = 10, $offset = 0, $properties = array())
    {
        $return = array();

        $this->db->select("blog.*, blog_categories.category_id, blog_categories.parent_id");
        $this->db->where($filters);
        $this->db->limit($limit, $offset);
        $this->db->order_by("highlight_blog.position", "desc");
        $this->db->group_by("blog.id");

        if (isset($properties['where_not_in'])) $this->db->where_not_in($properties['where_not_in'], $properties['where_not_in_array']);

        $this->db->join("blog", "blog.id = highlight_blog.blog_id");
        $this->db->join("blog_categories", "blog_categories.blog_id = highlight_blog.blog_id", "left");
        $this->db->join("blog_groups", "blog_groups.id = blog_categories.category_id", "left");
        $this->db->from("highlight_blog");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['videos'] = $this->batch_model->get_rows(array("table" => "blog_video", "limit" => 1000, "order_by" => "blog_video.position", "order_type" => "desc"), array("blog_id" => $row['id']));

                $image_data = $this->batch_model->get_rows(array("table" => "blog_images", "limit" => 1, "order_by" => "blog_images.position", "order_type" => "desc"), array("blog_id" => $row['id'], "enabled !=" => 0));
                $default_image = newsDefaultImage($row, $properties);
                $row['default_image'] = ($default_image) ? $default_image : base_url() . "img/blank.jpg";
                $row['img_thumbnail'] = ($default_image) ? "" : "img-thumbnail";

                if ($limit > 1) $return[] = $row;
                else $return = $row;
            }
        }

        return $return;
    }

    public function get_comments($filters = array(), $limit = 15, $offset = 0)
    {
        $return = array();

        $this->db->select("blog_comments.*,
                            members.name, members.username, members.email");
        $this->db->where($filters);
        $this->db->limit($limit, $offset);
        $this->db->order_by("blog_comments.id", "desc");
        $this->db->join("members", "members.id = blog_comments.customer_id");
        $this->db->from("blog_comments");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['total_like'] = $this->batch_model->row_counter(array("like" => 1, "comment_id" => $row['id']), "blog_like_dislike");
                $row['total_dislike'] = $this->batch_model->row_counter(array("dislike" => 1, "comment_id" => $row['id']), "blog_like_dislike");

                $row['parent_comments'] = $this->parent_comments(array("blog_comments.reply_id" => $row['id'], "blog_comments.enabled" => 1));
                if ($limit > 1) $return[] = $row;
                else $return = $row;
            }
        }

        return $return;
    }

    public function parent_comments($filters = array())
    {
        $return = array();

        $this->db->select("blog_comments.*,
                            members.name, members.username, members.email");
        $this->db->where($filters);
        $this->db->order_by("blog_comments.id", "desc");
        $this->db->join("members", "members.id = blog_comments.customer_id");
        $this->db->from("blog_comments");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $return[] = $row;
            }
        }

        return $return;
    }

    public function sql_properties($limit = 10, $offset = 0)
    {
        $sql_properties = array(
            "select" => "{$this->table}.*,
							users.first_name as user_first_name, users.last_name as user_last_name, users.email as user_email",
            'table' => $this->table,
            'limit' => $limit,
            'offset' => $offset,
            'order_by' => "{$this->table}.id",
            'order_type' => 'desc'
        );

        $sql_properties['glue'][] = "users";
        $sql_properties['pieces'][] = "users.id = {$this->table}.user_id";

        return $sql_properties;
    } // end function

    public function blog_options($filters = array(), $limit = 15, $random = FALSE)
    {
        $sql_properties['select'] = "blog_options.*, blog.title, blog.image, blog.time, blog.user_id, blog.blog_url, blog_groups.category, blog_groups.category_url";
        $sql_properties['table'] = "blog_options";
        $sql_properties['limit'] = $limit;

        if ($random === TRUE) {
            $sql_properties['order_by'] = "blog_options.id";
            $sql_properties['order_type'] = "random";
        }

        $sql_properties['glue'][] = "blog";
        $sql_properties['pieces'][] = "blog.id = blog_options.blog_id";
        $sql_properties['glue'][] = "blog_groups";
        $sql_properties['pieces'][] = "blog_groups.id = blog.category_id";
        return $this->batch_model->get_rows($sql_properties, $filters);
    }

    public function blog_use_tags($filters = array(), $limit = 10, $offset = 0)
    {
        $sql_properties['table'] = "blog_tags.*";
        $sql_properties['table'] = "blog_use_tags";
        $sql_properties['limit'] = $limit;
        $sql_properties['offset'] = $offset;
        $sql_properties['glue'][] = "blog_tags";
        $sql_properties['pieces'][] = "blog_tags.id = blog_use_tags.tag_id";
        return $this->batch_model->get_rows($sql_properties, $filters);
    }

    public function blog_tags($filters = array(), $limit = 10, $offset = 0)
    {
        $sql_properties['table'] = "blog_tags";
        $sql_properties['limit'] = $limit;
        $sql_properties['offset'] = $offset;
        return $this->batch_model->get_rows($sql_properties, $filters);
    }

    public function filter_blogs($filters = array("blog.enabled" => 1, "parent_cat.category_url" => "sex-and-love"), $limit = 4)
    {
        $sql_properties = $this->sql_properties($limit);
        $sql_properties['order_by'] = "blog.id";
        $sql_properties['order_type'] = "random";
        return $this->batch_model->get_rows($sql_properties, $filters);
    }

    public function recent_blogs($filters = array("blog.enabled" => 1), $limit = 5)
    {
        $sql_properties = $this->sql_properties($limit);
        $sql_properties['order_by'] = "blog.id";
        $sql_properties['order_type'] = "desc";
        return $this->batch_model->get_rows($sql_properties, $filters);
    }

    public function popular_blogs($filters = array("blog.enabled" => 1), $limit = 4)
    {
        $sql_properties = $this->sql_properties($limit);
        $sql_properties['order_by'] = "blog.popularity";
        $sql_properties['order_type'] = "desc";
        return $this->batch_model->get_rows($sql_properties, $filters);
    }

    public function parsed_data($mode = '', $id = 0)
    {
        $parsed_data['type'] = $this->input->post('type');
        $parsed_data['title'] = $this->input->post('title');
        $parsed_data['small_title'] = $this->input->post('small_title');
        $parsed_data['meta_keyword'] = $this->input->post('meta_keyword');
        $parsed_data['meta_description'] = $this->input->post('meta_description');
        if ($mode == "add") {
            $parsed_data['date'] = date("Y-m-d");
            $parsed_data['time'] = time();
        }

        $time = time();
        if (($mode == "edit") && $id) {
            $news = $this->batch_model->get_rows(array("table" => "blog", "limit" => 1), array("id" => $id));
            if (isset($news['id'])) $time = $news['time'];
        }
        $url = non_english_url_title($parsed_data['title']) . "-" . $time;
        $parsed_data['blog_url'] = $this->check_url($url);

        $parsed_data['details'] = $this->input->post('details');
        $parsed_data['homepage'] = $this->input->post('homepage');
        $parsed_data['highlight'] = $this->input->post('highlight');
        $parsed_data['slider'] = $this->input->post('slider');
        $parsed_data['selected'] = $this->input->post('selected');
        $parsed_data['recent'] = $this->input->post('recent');
        $parsed_data['publisher'] = $this->input->post('publisher');
        $parsed_data['publisher_title'] = $this->input->post('publisher_title');
        $parsed_data['agent'] = $this->input->post('agent');
        $parsed_data['enabled'] = $this->input->post('enabled');

        if ($mode == 'add') {
            $parsed_data['user_id'] = $this->session->userdata('id');
        }

        return $parsed_data;
    } // end function

    public function save_default_image($blog_id = 0)
    {
        $return = FALSE;

        if (isset($_FILES['userfile']['name']) && $blog_id) {
            $ext = @pathinfo($_FILES['userfile']['name']);
            if (isset($ext['extension'])) {
                $fileExt = strtolower($ext['extension']);
                $title = time();

                $config['overwrite'] = TRUE;
                $config['upload_path'] = "./uploads/news/";
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['file_name'] = "{$title}.{$fileExt}";
                $this->load->library('upload', $config);
                if ($this->upload->do_upload()) {
                    $upload_data = $this->upload->data();
                    $config['overwrite'] = TRUE;
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = "./uploads/news/{$upload_data['file_name']}";
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = FALSE;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();

                    $parsed_data['blog_id'] = $blog_id;
                    $parsed_data['image'] = $upload_data['file_name'];
                    $parsed_data['ext'] = $fileExt;
                    $parsed_data['position'] = 0;
                    $this->batch_model->save("blog_images", $parsed_data);

                    $return = TRUE;
                }
            }
        }

        return $return;
    }

    public function delete_image($id = 0)
    {
        $check_image = $this->batch_model->get_rows(array('table' => $this->table, 'limit' => 1), array('id' => $id));
        if (isset($check_image['image'])) {
            @unlink("./uploads/news/{$check_image['image']}");
        }
        return;
    }

    private function _image_filename($title = '', $mode = '', $id = 0)
    {
        if (empty($title)) {
            $image_name = $id;
            if ($mode == 'add') {
                $check_last_id = $this->batch_model->get_rows(array('table' => $this->table, 'limit' => 1, 'order_by' => 'id', 'order_type' => 'desc'), array());
                $image_name = (isset($check_last_id['id'])) ? ($check_last_id['id'] + 1) : 1;
            }
            $title = alphaID($image_name, FALSE, "BLOGIMG") . $image_name;
        }

        return $title;
    }

    public function group_sql_properties($limit = 10, $offset = 0)
    {
        $sql_properties = array(
            "select" => "{$this->table_group}.*, p.category as parent_category, sp.category as sub_parent_category",
            'table' => $this->table_group,
            'limit' => $limit,
            'offset' => $offset,
            'order_by' => "{$this->table_group}.id",
            'order_type' => 'desc'
        );

        $sql_properties['glue'][] = "blog_groups as p";
        $sql_properties['pieces'][] = "p.id = {$this->table_group}.parent_id";

        $sql_properties['glue'][] = "blog_groups as sp";
        $sql_properties['pieces'][] = "sp.id = {$this->table_group}.sub_parent_id";

        return $sql_properties;
    } // end function

    public function parsed_group_data()
    {
        $parsed_data['category'] = $this->input->post('category');
        $parsed_data['position'] = $this->input->post('position');
        $parsed_data['meta_title'] = $this->input->post('meta_title');
        $parsed_data['meta_keyword'] = $this->input->post('meta_keyword');
        $parsed_data['meta_description'] = $this->input->post('meta_description');
        $parsed_data['category_url'] = non_english_url_title($parsed_data['category']);
        $parsed_data['parent_id'] = $this->input->post('parent_id');
        $parsed_data['sub_parent_id'] = $this->input->post('sub_parent_id');
        $parsed_data['main_menu'] = $this->input->post('main_menu');
        $parsed_data['bottom_menu'] = $this->input->post('bottom_menu');
        $parsed_data['enabled'] = $this->input->post('enabled');

        return $parsed_data;
    } // end function

    public function comments_sql_properties($limit = 10, $offset = 0)
    {
        $sql_properties = array(
            "select" => "{$this->table_comments}.*,
										blog.title, blog.blog_url,
										blog_guest_comments.comment_id, blog_guest_comments.name as guest_name, blog_guest_comments.email as guest_email",
            'table' => $this->table_comments,
            'limit' => $limit,
            'offset' => $offset,
            'order_by' => "{$this->table_comments}.id",
            'order_type' => 'desc'
        );

        $sql_properties['glue'][] = $this->table;
        $sql_properties['pieces'][] = "{$this->table}.id = {$this->table_comments}.blog_id";

        $sql_properties['glue'][] = "blog_guest_comments";
        $sql_properties['pieces'][] = "blog_guest_comments.comment_id = blog_comments.id";

        return $sql_properties;
    } // end function

    public function parsed_comments_data()
    {
        $parsed_data['date'] = $this->input->post('date');
        $parsed_data['comment'] = $this->input->post('comment');
        $parsed_data['enabled'] = $this->input->post('enabled');

        return $parsed_data;
    } // end function

    //blog categories
    public function categories($filters = array("parent_id" => 0))
    {
        $return = array();

        $this->db->where($filters);
        $this->db->from("blog_groups");
        $this->db->order_by("position", "asc");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['parent'] = $this->parent_categories($filters = array("parent_id" => $row['id'], "sub_parent_id" => 0));
                $return[] = $row;
            }
        }

        return $return;
    }

    public function parent_categories($filters = array())
    {
        $return = array();

        $this->db->where($filters);
        $this->db->from("blog_groups");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['sub_parent'] = $this->sub_parent_categories($filters = array("sub_parent_id" => $row['id']));
                $return[] = $row;
            }
        }

        return $return;
    }

    public function sub_parent_categories($filters = array())
    {
        $return = array();

        $this->db->where($filters);
        $this->db->from("blog_groups");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $return[] = $row;
            }
        }

        return $return;
    }

    public function del_img($image_id = 0)
    {
        if ($image_id) {
            $row = $this->batch_model->get_rows(array("table" => "blog_images", "limit" => 1), array("id" => $image_id));
            if (isset($row['id'])) {
                @unlink("./uploads/news/{$row['blog_id']}/{$row['image']}");
                $this->db->where('id', $image_id);
                $this->db->delete("blog_images");
            }
        }

        return;
    }

    public function save_video($mode = "add", $blog_id = 0)
    {
        $status = FALSE;

        //delete old video
        if ($mode == "edit") {
            $this->db->where('blog_id', $blog_id);
            $this->db->delete("blog_video");
        }
        //delete old video

        $video_link = $this->input->post("video_link");
        $video_cation = $this->input->post("video_cation");
        if (is_array($video_link) && count($video_link) > 0) {
            $data['blog_id'] = $blog_id;
            foreach ($video_link as $key => $video) {
                if (!empty($video)) {
                    $data['url'] = $video;
                    $data['caption'] = $video_cation[$key];
                    $this->db->insert("blog_video", $data);
                    $status = $this->db->insert_id();
                }
            }
        }

        return $status;
    } //end function

    public function save_image($mode = "add", $blog_id = 0)
    {
        $status = FALSE;

        $image_caption = $this->input->post("image_caption");
        $positions = $this->input->post("image_position");
        if (is_array($image_caption) && count($image_caption) > 0) {
            $this->create_folder("./uploads/news/{$blog_id}"); //make folder
            $data['blog_id'] = $blog_id;
            foreach ($image_caption as $key => $caption) {
                if (isset($_FILES['image']['name'][$key]) && !empty($_FILES['image']['name'][$key])) {
                    $return_data = $this->image_upload($key, $blog_id);
                    $data['image'] = $return_data['image'];
                    $data['caption'] = $caption;
                    $data['position'] = $positions[$key];
                    $data['ext'] = $return_data['ext'];
                    $this->db->insert("blog_images", $data);
                    $status = $this->db->insert_id();
                }
            }
        }

        return $status;
    } //end function

    public function image_upload($key, $blog_id)
    {
        $_FILES['userfile']['name'] = $_FILES["image"]['name'][$key];
        $_FILES['userfile']['type'] = $_FILES["image"]['type'][$key];
        $_FILES['userfile']['tmp_name'] = $_FILES["image"]['tmp_name'][$key];
        $_FILES['userfile']['error'] = $_FILES["image"]['error'][$key];
        $_FILES['userfile']['size'] = $_FILES["image"]['size'][$key];

        $ext = @pathinfo($_FILES['userfile']['name']);
        if (isset($ext['extension'])) {
            $fileExt = $ext['extension'];
            $title = strtolower(url_title($ext['filename']));
            if (empty($title)) $title = time();

            $config['overwrite'] = TRUE;
            $config['upload_path'] = "./uploads/news/{$blog_id}/";
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['file_name'] = "{$title}.{$fileExt}";
            $this->upload->initialize($config);
            if ($this->upload->do_upload()) {
                $upload_data = $this->upload->data();
                $config['overwrite'] = TRUE;
                $config['image_library'] = 'gd2';
                $config['source_image'] = "./uploads/news/{$blog_id}/{$upload_data['file_name']}";
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = FALSE;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
            }
        }

        $return['image'] = (isset($upload_data['file_name'])) ? $upload_data['file_name'] : "";
        $return['ext'] = (isset($fileExt)) ? $fileExt : "";

        return $return;
    } //end function

    function create_folder($path = '')
    {
        if ($path) {
            if (!file_exists($path)) {
                @mkdir($path);
            }
        }
        return;
    } //end function

//font end
    public function releted_blog($blog_data = array(), $limit = 0, $filters = array(), $properties = array())
    {
        $return = array();

        if (isset($blog_data['id'])) {
            $this->db->like("blog.title", $blog_data['title']);
            $tile_array = explode(" ", $blog_data['title']);
            foreach ($tile_array as $key => $title) {
                $this->db->or_like("blog.title", $title);
                $this->db->or_like("blog.details", $title);
                //$this->db->or_like("blog_groups.category", $title);
            }

            $this->db->select("{$this->table}.*,
	                            users.first_name as user_first_name, users.last_name as user_last_name, users.email as user_email");
            if (is_countable($filters) && count($filters) > 0) $this->db->where($filters);
            else $this->db->where(array("blog.enabled" => 1));
            $this->db->limit($limit, 0);
            $this->db->order_by("blog.id", "desc");
            $this->db->join("users", "users.id = {$this->table}.user_id", "left");
            $this->db->from("blog");
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                foreach ($query->result_array() as $row) {
                    $row['image'] = $this->batch_model->get_rows(array("table" => "blog_images", "limit" => 1, "order_by" => "blog_images.position", "order_type" => "asc"), array("blog_id" => $row['id']));
                    $row['video'] = $this->batch_model->get_rows(array("table" => "blog_video", "limit" => 1, "order_by" => "blog_video.position", "order_type" => "asc"), array("blog_id" => $row['id']));

                    $default_image = newsDefaultImage($row, $properties);
                    $row['default_image'] = ($default_image) ? $default_image : base_url() . "img/blank.jpg";
                    $row['img_thumbnail'] = ($default_image) ? "" : "img-thumbnail";

                    if ($limit > 1) $return[] = $row;
                    else $return = $row;
                }
            }
        }

        return $return;
    }

    public function most_readed($filters = array(), $limit = 0, $propertises = array())
    {
        $return = array();

        $this->db->select("{$this->table}.*,
                            users.first_name as user_first_name, users.last_name as user_last_name, users.email as user_email");
        $this->db->where($filters);
        $this->db->limit($limit, 0);
        if (isset($propertises['more_news'])) $this->db->order_by("blog.id", "desc");
        elseif (isset($propertises['latest_news'])) $this->db->order_by("blog.id", "desc");
        else $this->db->order_by("blog.popularity", "desc");
        $this->db->join("users", "users.id = {$this->table}.user_id", "left");
        $this->db->join("blog_categories", "blog_categories.blog_id = blog.id", "left");
        $this->db->from("blog");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['image'] = $this->batch_model->get_rows(array("table" => "blog_images", "limit" => 1, "order_by" => "blog_images.position", "order_type" => "asc"), array("blog_id" => $row['id']));
                $row['video'] = $this->batch_model->get_rows(array("table" => "blog_video", "limit" => 1, "order_by" => "blog_video.position", "order_type" => "asc"), array("blog_id" => $row['id']));

                $default_image = newsDefaultImage($row, $propertises);
                $row['default_image'] = ($default_image) ? $default_image : base_url() . "img/blank.jpg";
                $row['img_thumbnail'] = ($default_image) ? "" : "img-thumbnail";

                if ($limit > 1) $return[] = $row;
                else $return = $row;
            }
        }

        return $return;
    }

    public function check_url($url = '')
    {
        $check_url = $this->batch_model->get_rows(array("table" => "blog", "limit" => 1), array("blog_url" => $url));
        return (isset($check_url['blog_url'])) ? "{$check_url['blog_url']}-1" : $url;
    }

    public function list_with_category($filters = array(), $propertises = array())
    {
        $return = array();

        $limit = (isset($propertises['limit'])) ? $propertises['limit'] : 10;
        $offset = (isset($propertises['offset'])) ? $propertises['offset'] : 0;
        $news_limit = (isset($propertises['news_limit'])) ? $propertises['news_limit'] : 10;

        $this->db->where($filters);
        $this->db->limit($limit, 0);
        $this->db->order_by("blog_groups.position", "asc");
        $this->db->from("blog_groups");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $filters = array("blog.enabled" => 1, "blog_categories.category_id" => $row['id']);
                if (isset($propertises['date'])) $filters['blog.date'] = $propertises['date'];
                if (isset($propertises['blog_type'])) $filters['blog.type'] = $propertises['blog_type'];

                $blogs = $this->get_news_by_category($filters, array("limit" => $news_limit));
                $row['blogs'] = $blogs['blogs'];
                if (is_countable($row['blogs']) && count($row['blogs']) > 0) {
                    if ($limit > 1) $return[] = $row;
                    else $return = $row;
                }
            }
        }

        return $return;
    }

    public function search_rows($functions = "", $limit = 10, $offset = 0, $properties = array())
    {
        $return = array();
        $return['rows'] = array();
        $return['pagination'] = "";

        $q = trim($this->input->get("q"));

        if ($functions) $this->db->where($functions, NULL, FALSE);
        $this->db->limit($limit, $offset);
        $this->db->order_by("blog.id", "desc");
        $this->db->from("blog");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($limit > 1) $return['rows'][] = $row;
                else $return['rows'] = $row;
            }
        }

        unset($this->db);
        $site_url = (isset($properties['site_url'])) ? $properties['site_url'] : "search/";
        $url_segment = (isset($properties['url_segment'])) ? $properties['url_segment'] : 2;

        if ($functions) $this->db->where($functions, NULL, FALSE);
        $this->db->from("blog");
        $total_results = $this->db->count_all_results();
        $return['pagination'] = $this->batch_model->pagination("blog", array(), site_url($site_url), $limit, 2, $total_results);

        return $return;
    }

    public function news_category($blog_id = 0)
    {
        $news_cat = 'Null';
        $filters = array('blog_id' => $blog_id);
        $this->db->where($filters);
        $this->db->order_by("id", "desc");
        $this->db->from("blog_categories");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $blog_cat = $query->row();
            $cat_id = $blog_cat->category_id;

            $filters = array('id' => $cat_id);
            $this->db->where($filters);
            $this->db->order_by("id", "desc");
            $this->db->from("blog_groups");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $news_cat = $query->row();
            }

        }
        return $news_cat;
    }

    public function tag_category($blog_id = 0)
    {
        $news_tag = 'Null';
        $tag_filters = array('blog_id' => $blog_id);
        $this->db->where($tag_filters);
        $this->db->from("blog_use_tags");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $tag_cat = $query->row();
            $tag_filterss = array('id' => $tag_cat->tag_id);
            $this->db->where($tag_filterss);
            $this->db->order_by("id", "desc");
            $this->db->from("blog_tags");
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $news_tag = $query->row();
            }
        }
        return $news_tag;
    }
}