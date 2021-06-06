<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller
{

    var $data = array();

    function __construct()
    {
        parent::__construct();
        $this->config->load_db_items();
        $this->load->helper("news");
        $this->load->library("news_library");
        $this->load->model(array("blog/blog_model", "polls_model"));
        $this->data['company_config'] = all_config();
    }

    public function index($offset = 0)
    {
        $wds = widget_snippet(array('enabled' => 1));
        foreach ($wds as $key => $section) {
            $this->data["{$section['section_id']}"] = $section;
        }
        $q = trim($this->input->get("q"));
        $this->data['page'] = array(
            "meta_title" => "{$q} - অনুসন্ধান - " . $this->config->item("company_name"),
            "meta_keyword" => "{$q} - অনুসন্ধান - " . $this->config->item("company_name"),
            "meta_description" => "{$q} - অনুসন্ধান - " . $this->config->item("company_name"),
            "url" => "search/?q={$q}"
        );

        $return_data = $this->blog_model->get_blogs(array("blog.enabled" => 1, "blog.homepage" => 1), $limit = 9);
        $this->data['homepage_news'] = $return_data['blogs'];

        $return_data = $this->blog_model->get_blogs(array("blog.enabled" => 1));
        $this->data['latest_news'] = $return_data['blogs'];

        $this->data['mostreaded_news'] = $this->blog_model->most_readed(array("blog.enabled" => 1), 100);

        $return_data = $this->blog_model->get_blogs(array("blog.enabled" => 1, "blog.selected" => 1));
        $this->data['selected_news'] = $return_data['blogs'];

        $functions = "(`rh_blog`.`title` LIKE '%{$q}%' ESCAPE '!' OR `rh_blog`.`small_title` LIKE '%{$q}%' ESCAPE '!' OR `rh_blog`.`meta_keyword` LIKE '%{$q}%' ESCAPE '!' OR `rh_blog`.`meta_description` LIKE '%{$q}%' ESCAPE '!' OR `rh_blog`.`details` LIKE '%{$q}%' ESCAPE '!') AND (`rh_blog`.`enabled` = 1 AND `rh_blog`.`details` != '')";
        $rows = $this->blog_model->search_rows($functions, $limit = 25, $offset);
        $this->data['search_rows'] = $rows['rows'];
        $this->data['pagination'] = $rows['pagination'];

        $this->data['breadcrumb'] = "<a href=\"#\" class=\"btn btn-default\">অনুসন্ধান</a>";
        $this->data['segment'] = "search";
        $this->load->view('template', $this->data);
    }
}
