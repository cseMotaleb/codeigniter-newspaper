<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_library
{
    var $CI;

    var $domain;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->domain = 'http://mancitra24.com/';
        $this->domain = base_url('');
    }

    public function top_letest_news($filters = array(), $limit = 10)
    {
        $data = "";
        $return_data = $this->CI->batch_model->get_rows(array("table" => "blog", "limit" => $limit, "order_by" => "id", "order_type" => "desc"), $filters);
        foreach ($return_data as $key => $row) {
            $url = site_url("article/{$row['id']}");
            $data .= "<a style=\"color: #e31723;\" href=\"{$url}\" class=\"each_slide\">{$row['title']}</a><br><br>";
        }

        return $data;
    }

    public function top_menu($filters = array("parent_id" => 0))
    {
        $data['categories'] = $this->CI->blog_model->categories($filters);
        $data['sub_categories'] = $this->CI->blog_model->categories(array("parent_id" => 0, "main_menu" => 2));
        $menu['category'] = array_merge($data['categories'], $data['sub_categories']);
        $menu['all'] = $this->CI->load->view("top-menu", $data, TRUE);
        $menu['mobile'] = $this->CI->load->view("mobile-top-menu", $data, TRUE);
        return $menu;
    }

    public function footer_blog($filters = array(), $properties = array())
    {
        $return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
        return $return_data['blogs'];
    }

    public function get_news_list($filters = array(), $limit = 10, $properties = array())
    {
        $return_data = $this->CI->blog_model->get_blogs($filters, $limit, $offset = 0, $properties);
        return $return_data['blogs'];
    }

    public function get_news_list_category($filters = array(), $properties = array())
    {
        $return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
        return $return_data['blogs'];
    }

    public function mostreaded_news($filters = array(), $limit = 10, $propertises = array())
    {
        return $this->CI->blog_model->most_readed($filters, $limit, $propertises);
    }

    public function cur_poll()
    {
        $poll_data = $this->CI->polls_model->get_rows(array("date" => date("Y-m-d"), "enabled" => 1), 1);
        $poll_data = $poll_data['rows'];
        if (!isset($poll_data['id'])) {
            $poll_data = $this->CI->polls_model->get_rows(array("enabled" => 1), 1);
            $poll_data = $poll_data['rows'];
        }

        return $poll_data;
    }

    public function cur_advertisement($filters = array(), $sql_properties = array())
    {
        $data = "";
        $advertisement = $this->CI->batch_model->get_rows($sql_properties, $filters);
        if (isset($advertisement['id'])) {
            $url = ($advertisement['url']) ? $advertisement['url'] : "#";
//			$data = "<a target=\"_blank\" href=\"{$url}\">
//						<img class=\"img img-responsive img-thumbnail center addvertize-img\" src=\"".base_url() . "uploads/media/advertisement/{$advertisement['image']}\" />
//					</a>";

            $src = site_url('uploads/media/advertisement/' . $advertisement['image']);
            $data = '<a target="_blank" href="'.$url.'">
						<img class="img img-responsive img-thumbnail center addvertize-img lazyload" data-src="' . $src . '" />
					</a>';
        }

        return $data;
    }

    public function list_style($filters = array(), $properties = array())
    {
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 7;
        $list = (isset($properties['list'])) ? $properties['list'] : 1;

        $category = (isset($properties['category'])) ? $properties['category'] : "বিনোদন";
        $data['category_data'] = $this->CI->batch_model->get_rows(array("table" => "blog_groups", "limit" => 1), array("category" => $category));


        $news_rows = array();
        if (isset($data['category_data']['id']) && ($list != 3)) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $data['category_data']['id'], "highlight_blog.page" => "Category"), $limit);
        $total_news = count($news_rows);
        $limit = ($limit - $total_news);

        $ids = array();
        foreach ($news_rows as $key => $row) {
            $ids[] = $row['id'];
        }
        if (count($ids) > 0) {
            $properties['where_not_in'] = "blog.id";
            $properties['where_not_in_array'] = $ids;
        }

        $properties['limit'] = $limit;
        if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
        if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
        $data['entertainment_list'] = @array_merge($news_rows, $return_data['blogs']);
        if (!is_array($data['entertainment_list'])) $data['entertainment_list'] = array();
        //$data['entertainment_list'] = $return_data['blogs'];

        $data['category_title'] = (isset($properties['category_title'])) ? $properties['category_title'] : "বিনোদনের";
        $data['category_name'] = (isset($properties['category_name'])) ? $properties['category_name'] : "বিনোদনের";
        $data['headerimg'] = (isset($properties['headerimg'])) ? $properties['headerimg'] : "";
        return $this->CI->load->view("list-style-{$list}", $data, TRUE);
    }

    public function grid_style($categories = array(), $properties = array())
    {
        $i = 0;
        $filters = array("blog.enabled" => 1, "blog.type" => "List");
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 4;
        $image_show = (isset($properties['image_show'])) ? $properties['image_show'] : 0;


        $category_data = array();
        $main_category_data = array();
        foreach ($categories as $key => $category) {
            $category_data = $this->CI->batch_model->get_rows(array("table" => "blog_groups", "limit" => 1), array("category" => $category));
            if (isset($category_data['id'])) $filters['blog_categories.category_id'] = $category_data['id'];
            if (isset($category_data['parent_id']) && $category_data['parent_id']) {
                $main_category_data = $this->CI->batch_model->get_rows(array("table" => "blog_groups", "limit" => 1), array("id" => $category_data['parent_id']));
                if (isset($main_category_data['id'])) $filters['blog_categories.category_id'] = $main_category_data['id'];
            }


            $news_rows = array();
            if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $rlimit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $rlimit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['alldata'][$i]["entertainment_list"] = @array_merge($news_rows, $return_data['blogs']);
            if (!is_array($data['alldata'][$i]["entertainment_list"])) $data['alldata'][$i]["entertainment_list"] = array();


            //if($category_data['category'] == "দেশজুড়ে") echo "<pre>"; print_r($data['alldata']); echo "</pre>";
            $data['alldata'][$i]['category_data'] = $category_data;
            $data['alldata'][$i]['main_category_data'] = $main_category_data;
            //$return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
            //$data['entertainment_list'] = $return_data['blogs'];
            //$data['alldata'][$i]["entertainment_list"] = $return_data['blogs'];
            $i++;
        }
        $data['image_show'] = $image_show;
        $data['single_category'] = "antorjatik";

        $list = (isset($properties['list'])) ? $properties['list'] : 1;
        return $this->CI->load->view("grid-style-single", $data, TRUE);
    }

    public function grid_style_custom($categories = array(), $properties = array())
    {
        $i = 0;
        $filters = array("blog.enabled" => 1, "blog.type" => "List");
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 4;
        $image_show = (isset($properties['image_show'])) ? $properties['image_show'] : 0;


        $category_data = array();
        $main_category_data = array();
        foreach ($categories as $key => $category) {
            $category_data = $this->CI->batch_model->get_rows(array("table" => "blog_groups", "limit" => 1), array("category" => $category));
            if (isset($category_data['parent_id'])) {
                $main_category_data = $this->CI->batch_model->get_rows(array("table" => "blog_groups", "limit" => 1), array("id" => $category_data['id']));
                if (isset($main_category_data['id'])) $filters['blog_categories.parent_id'] = $main_category_data['id'];
            } else {
                if (isset($category_data['id'])) $filters['blog_categories.category_id'] = $category_data['id'];
            }


            $news_rows = array();
            if (isset($category_data['parent_id'])) {
                $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.parent_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            } else {
                if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            }
            $total_news = count($news_rows);
            $rlimit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $rlimit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['alldata'][$i]["entertainment_list"] = @array_merge($news_rows, $return_data['blogs']);
            if (!is_array($data['alldata'][$i]["entertainment_list"])) $data['alldata'][$i]["entertainment_list"] = array();


            //if($category_data['category'] == "দেশজুড়ে") echo "<pre>"; print_r($data['alldata']); echo "</pre>";
            $data['alldata'][$i]['category_data'] = $category_data;
            $data['alldata'][$i]['main_category_data'] = $main_category_data;
            //$return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
            //$data['entertainment_list'] = $return_data['blogs'];
            //$data['alldata'][$i]["entertainment_list"] = $return_data['blogs'];
            $i++;
        }
        $data['image_show'] = $image_show;

        $list = (isset($properties['list'])) ? $properties['list'] : 1;
        return $this->CI->load->view("grid-style-{$list}", $data, TRUE);
    }

    public function grid_style_bottom($categories = array(), $properties = array())
    {
        $i = 0;
        $filters = array("blog.enabled" => 1, "blog.type" => "List");
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 4;
        $image_show = (isset($properties['image_show'])) ? $properties['image_show'] : 0;


        $category_data = array();
        $main_category_data = array();
        foreach ($categories as $key => $category) {
            $category_data = $this->CI->batch_model->get_rows(array("table" => "blog_groups", "limit" => 1), array("category" => $category));
            if (isset($category_data['id'])) $filters['blog_categories.category_id'] = $category_data['id'];
            if (isset($category_data['parent_id']) && $category_data['parent_id']) {
                $main_category_data = $this->CI->batch_model->get_rows(array("table" => "blog_groups", "limit" => 1), array("id" => $category_data['parent_id']));
                if (isset($main_category_data['id'])) $filters['blog_categories.category_id'] = $main_category_data['id'];
            }


            $news_rows = array();
            if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $rlimit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $rlimit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['alldata'][$i]["entertainment_list"] = @array_merge($news_rows, $return_data['blogs']);
            if (!is_array($data['alldata'][$i]["entertainment_list"])) $data['alldata'][$i]["entertainment_list"] = array();


            //if($category_data['category'] == "দেশজুড়ে") echo "<pre>"; print_r($data['alldata']); echo "</pre>";
            $data['alldata'][$i]['category_data'] = $category_data;
            $data['alldata'][$i]['main_category_data'] = $main_category_data;
            //$return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
            //$data['entertainment_list'] = $return_data['blogs'];
            //$data['alldata'][$i]["entertainment_list"] = $return_data['blogs'];
            $i++;
        }
        $data['image_show'] = $image_show;

        $list = (isset($properties['list'])) ? $properties['list'] : 1;
        return $this->CI->load->view("grid-style-bottom", $data, TRUE);
    }

    public function today_prayer()
    {
        $return_data = $this->CI->batch_model->get_rows(array("table" => "prayers", "limit" => 1), array("date" => date("Y-m-d")));
        if (!isset($return_data['id'])) {
            $return_data = $this->CI->batch_model->get_rows(array("table" => "prayers", "limit" => 1), array("default" => 1));
        }

        $data['prayer_data'] = $return_data;
        return $this->CI->load->view("prayer-list", $data, TRUE);
    }

    public function news_comments($news_id = 0)
    {
        $data['comments'] = $this->CI->blog_model->get_comments(array("blog_comments.blog_id" => $news_id, "blog_comments.enabled" => 1, "blog_comments.reply_id" => 0), 100);
        return $this->CI->load->view("comments-list", $data, TRUE);
    }

    public function small_content_slider($filters = array(), $limit = 10, $id = "slide-1")
    {
        $return_data = $this->CI->blog_model->get_blogs($filters, $limit);
        $data['blogs'] = $return_data['blogs'];
        $data['listid'] = $id;
        return $this->CI->load->view("small-content-slider", $data, TRUE);
    }

    public function news_instant($properties = array())
    {
        $data['top'] = (isset($properties['top'])) ? $properties['top'] : 0;
        $category = (isset($properties['category'])) ? $properties['category'] : "প্রজন্ম ইন্সট্যান্ট";
        $limit = (isset($properties['nlimit'])) ? $properties['nlimit'] : 3;
        $data['category_data'] = $this->CI->batch_model->get_rows(array("table" => "blog_groups", "limit" => 1), array("category" => $category));
        if (isset($data['category_data']['id'])) {
            $news_rows = array();
            if (isset($data['category_data']['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $data['category_data']['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $limit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $limit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_groups.category" => $category), $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['last_projonmos'] = @array_merge($news_rows, $return_data['blogs']);
        }
        if (!is_array($data['last_projonmos'])) $data['last_projonmos'] = array();

        return $this->CI->load->view("news-instant", $data, TRUE);
    }

    public function tabpanel($filters = array(), $properties = array())
    {
        $category = (isset($properties['category'])) ? $properties['category'] : "সম্পাদকীয়";
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 4;

        $data['category_data'] = $this->CI->batch_model->get_rows(array("table" => "blog_groups", "limit" => 1), array("category" => $category));
        $data['news'] = array();
        if (isset($data['category_data']['id'])) {
            $news_rows = array();
            if (isset($data['category_data']['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $data['category_data']['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $limit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $limit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category($filters, $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['news'] = @array_merge($news_rows, $return_data['blogs']);
        }

        if (!is_array($data['news'])) $data['news'] = array();

        return $this->CI->load->view("tab-panel", $data, TRUE);
    }

    public function top_date()
    {
        $this->CI->load->library("hijricalendar");
        $day = date("d");
        $month = date("m");
        $year = date("Y");
        return $this->CI->hijricalendar->getOneHijriMonthCalendar(date("m"));
    }

    public function double_list_style($properties = array())
    {
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 10;
        $category = (isset($properties['category'])) ? $properties['category'] : "";

        if ($category == "ছবি গ্যালারি") {
            $data['category_data']['category'] = "ছবি গ্যালারি";
            $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "Gallery"), $limit);
            $data['entertainment_list'] = $return_data['blogs'];
        } else {
            $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
            if (isset($category_data['id'])) {
                $news_rows = array();
                if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
                $total_news = count($news_rows);
                $limit = ($limit - $total_news);

                $ids = array();
                foreach ($news_rows as $key => $row) {
                    $ids[] = $row['id'];
                }
                if (count($ids) > 0) {
                    $properties['where_not_in'] = "blog.id";
                    $properties['where_not_in_array'] = $ids;
                }

                $properties['limit'] = $limit;
                if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
                if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
                $data['entertainment_list'] = @array_merge($news_rows, $return_data['blogs']);
                $data['category_data'] = $category_data;
            }
        }

        $limit = (isset($properties['limit1'])) ? $properties['limit1'] : 10;
        $category = (isset($properties['category1'])) ? $properties['category1'] : "";

        $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
        if (isset($category_data['id'])) {
            $news_rows = array();
            if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $limit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $limit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['news1'] = @array_merge($news_rows, $return_data['blogs']);
            $data['category1_data'] = $category_data;
        }


        return $this->CI->load->view("double-list-style", $data, TRUE);
    }

    public function picture_category()
    {
        $limit = 1;
        $filters = array(
            'type' => 'Gallery'
        );
        $category_data = $this->CI->batch_model->get_rows(array("table" => "blog", "limit" => $limit, "order_by" => "id", "order_type" => "desc"), $filters);
        return $category_data;
    }

    public function gellary_style($properties = array())
    {
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 10;
        $category = (isset($properties['category'])) ? $properties['category'] : "";

        if ($category == "ছবি গ্যালারি") {
            $data['category_data']['category'] = "ছবি গ্যালারি";
            $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "Gallery"), $limit);
            $data['entertainment_list'] = $return_data['blogs'];
        } else {
            $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
            if (isset($category_data['id'])) {
                $news_rows = array();
                if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
                $total_news = count($news_rows);
                $limit = ($limit - $total_news);

                $ids = array();
                foreach ($news_rows as $key => $row) {
                    $ids[] = $row['id'];
                }
                if (count($ids) > 0) {
                    $properties['where_not_in'] = "blog.id";
                    $properties['where_not_in_array'] = $ids;
                }

                $properties['limit'] = $limit;
                if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
                if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
                $data['entertainment_list'] = @array_merge($news_rows, $return_data['blogs']);
                $data['category_data'] = $category_data;
            }
        }

        $limit = (isset($properties['limit1'])) ? $properties['limit1'] : 10;
        $category = (isset($properties['category1'])) ? $properties['category1'] : "";

        $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
        if (isset($category_data['id'])) {
            $news_rows = array();
            if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $limit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $limit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['news1'] = @array_merge($news_rows, $return_data['blogs']);
            $data['category1_data'] = $category_data;
        }


        return $this->CI->load->view("photogellary/gellary", $data, TRUE);
    }

    public function allcountry_list_style($properties = array())
    {
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 10;
        $category = (isset($properties['category'])) ? $properties['category'] : "";

        if ($category == "ছবি গ্যালারি") {
            $data['category_data']['category'] = "ছবি গ্যালারি";
            $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "Gallery"), $limit);
            $data['entertainment_list'] = $return_data['blogs'];
        } else {
            $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
            if (isset($category_data['id'])) {
                $news_rows = array();
                if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
                $total_news = count($news_rows);
                $limit = ($limit - $total_news);

                $ids = array();
                foreach ($news_rows as $key => $row) {
                    $ids[] = $row['id'];
                }
                if (count($ids) > 0) {
                    $properties['where_not_in'] = "blog.id";
                    $properties['where_not_in_array'] = $ids;
                }

                $properties['limit'] = $limit;
                if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
                if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
                $data['entertainment_list'] = @array_merge($news_rows, $return_data['blogs']);
                $data['category_data'] = $category_data;
            }
        }

        $limit = (isset($properties['limit1'])) ? $properties['limit1'] : 10;
        $category = (isset($properties['category1'])) ? $properties['category1'] : "";

        $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
        if (isset($category_data['id'])) {
            $news_rows = array();
            if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $limit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $limit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['news1'] = @array_merge($news_rows, $return_data['blogs']);
            $data['category1_data'] = $category_data;
        }


        return $this->CI->load->view("allcountry-list-style", $data, TRUE);
    }

    public function teach_list_style($properties = array())
    {
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 10;
        $category = (isset($properties['category'])) ? $properties['category'] : "";

        if ($category == "ছবি গ্যালারি") {
            $data['category_data']['category'] = "ছবি গ্যালারি";
            $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "Gallery"), $limit);
            $data['entertainment_list'] = $return_data['blogs'];
        } else {
            $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
            if (isset($category_data['id'])) {
                $news_rows = array();
                if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
                $total_news = count($news_rows);
                $limit = ($limit - $total_news);

                $ids = array();
                foreach ($news_rows as $key => $row) {
                    $ids[] = $row['id'];
                }
                if (count($ids) > 0) {
                    $properties['where_not_in'] = "blog.id";
                    $properties['where_not_in_array'] = $ids;
                }

                $properties['limit'] = $limit;
                if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
                if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
                $data['entertainment_list'] = @array_merge($news_rows, $return_data['blogs']);
                $data['category_data'] = $category_data;
            }
        }

        $limit = (isset($properties['limit1'])) ? $properties['limit1'] : 10;
        $category = (isset($properties['category1'])) ? $properties['category1'] : "";

        $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
        if (isset($category_data['id'])) {
            $news_rows = array();
            if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $limit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $limit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['news1'] = @array_merge($news_rows, $return_data['blogs']);
            $data['category1_data'] = $category_data;
        }


        return $this->CI->load->view("teach-list-style", $data, TRUE);
    }

    public function play_list_style($properties = array())
    {
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 10;
        $category = (isset($properties['category'])) ? $properties['category'] : "";

        if ($category == "ছবি গ্যালারি") {
            $data['category_data']['category'] = "ছবি গ্যালারি";
            $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "Gallery"), $limit);
            $data['entertainment_list'] = $return_data['blogs'];
        } else {
            $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
            if (isset($category_data['id'])) {
                $news_rows = array();
                if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
                $total_news = count($news_rows);
                $limit = ($limit - $total_news);

                $ids = array();
                foreach ($news_rows as $key => $row) {
                    $ids[] = $row['id'];
                }
                if (count($ids) > 0) {
                    $properties['where_not_in'] = "blog.id";
                    $properties['where_not_in_array'] = $ids;
                }

                $properties['limit'] = $limit;
                if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
                if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
                $data['entertainment_list'] = @array_merge($news_rows, $return_data['blogs']);
                $data['category_data'] = $category_data;
            }
        }

        $limit = (isset($properties['limit1'])) ? $properties['limit1'] : 10;
        $category = (isset($properties['category1'])) ? $properties['category1'] : "";

        $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
        if (isset($category_data['id'])) {
            $news_rows = array();
            if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $limit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $limit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['news1'] = @array_merge($news_rows, $return_data['blogs']);
            $data['category1_data'] = $category_data;
        }


        return $this->CI->load->view("play-list-style", $data, TRUE);
    }

    public function binodone_list_style($properties = array())
    {
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 10;
        $category = (isset($properties['category'])) ? $properties['category'] : "";

        if ($category == "ছবি গ্যালারি") {
            $data['category_data']['category'] = "ছবি গ্যালারি";
            $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "Gallery"), $limit);
            $data['entertainment_list'] = $return_data['blogs'];
        } else {
            $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
            if (isset($category_data['id'])) {
                $news_rows = array();
                if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
                $total_news = count($news_rows);
                $limit = ($limit - $total_news);

                $ids = array();
                foreach ($news_rows as $key => $row) {
                    $ids[] = $row['id'];
                }
                if (count($ids) > 0) {
                    $properties['where_not_in'] = "blog.id";
                    $properties['where_not_in_array'] = $ids;
                }

                $properties['limit'] = $limit;
                if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
                if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
                $data['entertainment_list'] = @array_merge($news_rows, $return_data['blogs']);
                $data['category_data'] = $category_data;
            }
        }

        $limit = (isset($properties['limit1'])) ? $properties['limit1'] : 10;
        $category = (isset($properties['category1'])) ? $properties['category1'] : "";

        $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
        if (isset($category_data['id'])) {
            $news_rows = array();
            if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $limit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $limit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['news1'] = @array_merge($news_rows, $return_data['blogs']);
            $data['category1_data'] = $category_data;
        }


        return $this->CI->load->view("binodone-list-style", $data, TRUE);
    }

    public function picture_list_style($properties = array())
    {
        $limit = (isset($properties['limit'])) ? $properties['limit'] : 10;
        $category = (isset($properties['category'])) ? $properties['category'] : "";

        if ($category == "ছবি গ্যালারি") {
            $data['category_data']['category'] = "ছবি গ্যালারি";
            $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "Gallery"), $limit);
            $data['entertainment_list'] = $return_data['blogs'];
        } else {
            $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
            if (isset($category_data['id'])) {
                $news_rows = array();
                if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
                $total_news = count($news_rows);
                $limit = ($limit - $total_news);

                $ids = array();
                foreach ($news_rows as $key => $row) {
                    $ids[] = $row['id'];
                }
                if (count($ids) > 0) {
                    $properties['where_not_in'] = "blog.id";
                    $properties['where_not_in_array'] = $ids;
                }

                $properties['limit'] = $limit;
                if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
                if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
                $data['entertainment_list'] = @array_merge($news_rows, $return_data['blogs']);
                $data['category_data'] = $category_data;
            }
        }

        $limit = (isset($properties['limit1'])) ? $properties['limit1'] : 10;
        $category = (isset($properties['category1'])) ? $properties['category1'] : "";

        $category_data = $this->CI->batch_model->get_rows(array("table" => 'blog_groups', "limit" => 1), array("category" => $category));
        if (isset($category_data['id'])) {
            $news_rows = array();
            if (isset($category_data['id'])) $news_rows = $this->CI->blog_model->get_highlight_blogs(array("blog.enabled" => 1, "blog_categories.category_id" => $category_data['id'], "highlight_blog.page" => "Category"), $limit);
            $total_news = count($news_rows);
            $limit = ($limit - $total_news);

            $ids = array();
            foreach ($news_rows as $key => $row) {
                $ids[] = $row['id'];
            }
            if (count($ids) > 0) {
                $properties['where_not_in'] = "blog.id";
                $properties['where_not_in_array'] = $ids;
            }

            $properties['limit'] = $limit;
            if ($limit > 0) $return_data = $this->CI->blog_model->get_news_by_category(array("blog.enabled" => 1, "blog.type" => "List", "blog_categories.category_id" => $category_data['id']), $properties);
            if (!isset($return_data['blogs'])) $return_data['blogs'] = array();
            $data['news1'] = @array_merge($news_rows, $return_data['blogs']);
            $data['category1_data'] = $category_data;
        }


        return $this->CI->load->view("picture-list-style", $data, TRUE);
    }

    function newsImageResize($source_image = '', $new_image = '', $width = 50, $height = 50)
    {
        return imageResize($source_image, $new_image, $width, $height);
    }

    function newsDefaultImage($row = array(), $properties = array())
    {
        $default_image = '';

        if ($row['type'] == 'Video' && isset($row['videos'][0]['url'])) {
            $default_image = "http://img.youtube.com/vi/{$row['videos'][0]['url']}/hqdefault.jpg";
        } else {
            $images = (isset($row['images'][0])) ? $row['images'][0] : (isset($row['image']) ? $row['image'] : array());

            if (isset($images['id'])) {
                if (isset($properties['imgwidth']) && isset($properties['imgheight'])) {
                    $default_image = newsImageFixedResize($row['id'], $images['ext'], $images['image'], $properties['imgwidth'], $properties['imgheight']);
                } else {
                    $default_image = (isset($images['image']) && file_exists("./uploads/news/{$row['id']}/{$images['image']}")) ? base_url() . "uploads/news/{$row['id']}/{$images['image']}" : "";
                }
            }
        }

        return $default_image;
    }

    function newsImageFixedResize($id = 0, $ext = '', $image = '', $width = 50, $height = 50)
    {
        $imageName = str_replace(".{$ext}", '', $image);
        $imageFullName = $imageName . '-' . $height . 'x' . $width . '.' . $ext;
        $thumbImageFullName = $imageName . '-' . $height . 'x' . $width . '_thumb.' . $ext;
        $default_image = '';

        if (@file_exists("./uploads/news/{$id}/{$thumbImageFullName}")) {
            $default_image = base_url() . "uploads/news/{$id}/{$thumbImageFullName}";
        } else {
            $source_image = "./uploads/news/{$id}/{$image}";
            $new_image = "./uploads/news/{$id}/{$imageFullName}";
            $imgResult = newsImageResize($source_image, $new_image, $width, $height);

            if ($imgResult && @file_exists("./uploads/news/{$id}/{$thumbImageFullName}")) {
                $default_image = base_url() . "uploads/news/{$id}/{$thumbImageFullName}";
            }
        }

        return $default_image;
    }
}