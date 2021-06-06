<?php

class Batch_model extends CI_Model
{

    var $domain;

    public function __construct()
    {
        parent::__construct();

        $this->domain = 'https://mancitra24.com/';
        $this->domain = site_url('/');
    }

    //Batch - Select
    public function get_rows($sql_properties = array(), $filters = array())
    {
        $limit = (isset($sql_properties['limit'])) ? $sql_properties['limit'] : 10;
        $offset = (isset($sql_properties['offset'])) ? $sql_properties['offset'] : 0;
        $table = (isset($sql_properties['table'])) ? $sql_properties['table'] : '';

        if (isset($sql_properties['select'])) $this->db->select($sql_properties['select']);

        $return = array();

        if (!$table) return FALSE;

        if (isset($sql_properties['order_by']) && isset($sql_properties['order_type'])) {
            if (is_array($sql_properties['order_by']) && is_array($sql_properties['order_type'])) {
                foreach ($sql_properties['order_by'] as $key => $value) {
                    $this->db->order_by($sql_properties['order_by'][$key], $sql_properties['order_type'][$key]);
                }
            } else {
                $this->db->order_by($sql_properties['order_by'], $sql_properties['order_type']);
            }
        }

        if (isset($sql_properties['group_by'])) {
            if (is_array($sql_properties['group_by'])) {
                foreach ($sql_properties['group_by'] as $key => $value) {
                    $this->db->group_by($sql_properties['group_by'][$key]);
                }
            } else {
                $this->db->group_by($sql_properties['group_by']);
            }
        }

        if (isset($sql_properties['select']) && !empty($sql_properties['select'])) $this->db->select($sql_properties['select']);

        if (isset($sql_properties['join_left'])) {
            if (isset($sql_properties['glue']) && isset($sql_properties['pieces'])) {
                if (is_array($sql_properties['glue']) && is_array($sql_properties['pieces'])) {
                    foreach ($sql_properties['glue'] as $key => $value) {
                        $this->db->join($sql_properties['glue'][$key], $sql_properties['pieces'][$key]);
                    }
                } else {
                    $this->db->join($sql_properties['glue'], $sql_properties['pieces']);
                }
            }
        } else {
            if (isset($sql_properties['glue']) && isset($sql_properties['pieces'])) {
                if (is_array($sql_properties['glue']) && is_array($sql_properties['pieces'])) {
                    foreach ($sql_properties['glue'] as $key => $value) {
                        $this->db->join($sql_properties['glue'][$key], $sql_properties['pieces'][$key], 'left');
                    }
                } else {
                    $this->db->join($sql_properties['glue'], $sql_properties['pieces'], 'left');
                }
            }
        }

        $this->db->where($filters);
        if (isset($sql_properties['functions']) && is_array($sql_properties['functions'])) {
            $this->db->where($sql_properties['functions'], NULL, FALSE);
        }

        if (isset($sql_properties['functions']) && !is_array($sql_properties['functions'])) {
            $this->db->where($sql_properties['functions'], NULL, FALSE);
        }

        if (isset($sql_properties['like']) && is_array($sql_properties['like'])) {
            foreach ($sql_properties['like'] as $key => $like) {
                if (isset($sql_properties['like_option']["{$key}"])) {
                    $like_option = $sql_properties['like_option']["{$key}"];
                } else $like_option = 'both';
                $this->db->like($like, $sql_properties['like_value']["{$key}"], $like_option);
            }
        } else {
            if (isset($sql_properties['like']) && isset($sql_properties['like_value'])) {
                $this->db->like($sql_properties['like'], $sql_properties['like_value']);
            }
        }

        if (isset($sql_properties['or_like']) && is_array($sql_properties['or_like'])) {
            foreach ($sql_properties['or_like'] as $key => $like) {
                $this->db->or_like($like, $sql_properties['OR_like_value']["{$key}"]);
            }
        }

        if (isset($sql_properties['not_like']) && is_array($sql_properties['not_like'])) {
            foreach ($sql_properties['not_like'] as $key => $like) {
                if (isset($sql_properties['not_like_option']["{$key}"])) {
                    $like_option = $sql_properties['not_like_option']["{$key}"];
                } else {
                    $like_option = 'both';
                }
                $this->db->not_like($like, $sql_properties['not_like_value']["{$key}"], $like_option);
            }
        }

        if (isset($sql_properties['or'])) {
            $this->db->or_where($sql_properties['or']);
        }
        if (isset($sql_properties['or_where_in']) && isset($sql_properties['or_where_in_value'])) {
            $this->db->or_where_in($sql_properties['or_where_in'], $sql_properties['or_where_in_value']);
        }
        if (isset($sql_properties['where_in'])) {
            $this->db->where_in($sql_properties['where_in'], $sql_properties['where_in_value']);
        }

        if (isset($sql_properties['where_not_in']) && isset($sql_properties['where_not_in_glue'])) {
            $this->db->where_not_in($sql_properties['where_not_in_glue'], $sql_properties['where_not_in']);
        }
        $this->db->limit($limit, $offset);
        $this->db->from($table);
        if (isset($sql_properties['cache'])) $this->db->cache_on();
        $query = $this->db->get();
        if (isset($sql_properties['cache'])) $this->db->cache_off();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($limit > 1) $return[] = $row;
                else $return = $row;
            }
        }

        return $return;
    }

    public function select_sum($filters = array(), $sql_properties = array())
    {
        $return = array();

        if (isset($sql_properties['sql'])) {
            $query = $this->db->query($sql_properties['sql']);
        } else {
            $this->db->select_sum($sql_properties['sum']);
            if (isset($sql_properties['glue']) && isset($sql_properties['pieces'])) {
                if (is_array($sql_properties['glue']) && is_array($sql_properties['pieces'])) {
                    foreach ($sql_properties['glue'] as $key => $value) {
                        $this->db->join($sql_properties['glue'][$key], $sql_properties['pieces'][$key]);
                    }
                } else {
                    $this->db->join($sql_properties['glue'], $sql_properties['pieces']);
                }
            }

            $this->db->from($sql_properties['table']);
            $this->db->where($filters);
            $query = $this->db->get();
        }

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $return = $row;
            }
        }

        return $return;
    }

    public function save($table = NULL, $data = NULL, $comparison_fields = NULL)
    {
        if (!$table || !is_array($data)) return FALSE;

        if (is_array($comparison_fields)) {
            return $this->update($table, $data, $comparison_fields);
        } else {
            $insert_query = $this->db->insert_string($table, $data);
            $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
            $this->db->query($insert_query);
            //$this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }

    public function insert_batch($table = NULL, $data = array())
    {
        if ($table && is_countable($data) && count($data)) return $this->db->insert_batch($table, $data);
        else return FALSE;
    }

    public function update($table = NULL, $data = NULL, $comparison_fields = NULL)
    {
        if (!$table || !is_array($data) || !$comparison_fields) return FALSE;

        if (is_array($comparison_fields['name'])) {
            foreach ($comparison_fields['name'] as $key => $val) {
                $this->db->where($comparison_fields['name'][$key], $comparison_fields['value'][$key]);
            }
        } else if (is_array($comparison_fields)) {
            $this->db->where($comparison_fields['name'], $comparison_fields['value']);
        }

        try {
            $this->db->update($table, $data);
            return $this->db->affected_rows();
        } catch (Exception $e) {
            return FALSE;
        }
    }

    function delete_rows($table = NULL, $comparison_fields = NULL, $row_ids = NULL)
    {
        if (isset($comparison_fields['name']) && is_array($comparison_fields['name'])) {
            foreach ($comparison_fields['name'] as $key => $val) {
                $this->db->where($comparison_fields['name'][$key], $comparison_fields['value'][$key]);
            }
        } else if (isset($comparison_fields) && is_array($comparison_fields)) {
            $this->db->where($comparison_fields['name'], $comparison_fields['value']);
        }

        if ($row_ids) {
            if (is_array($row_ids)) $this->db->where_in('id', $row_ids);
            else $this->db->where('id', $row_ids);
        }

        if ($row_ids || $comparison_fields) {
            $this->db->delete($table);
            return $this->db->affected_rows();
        }

        return FALSE;
    }

    public function existing_json($batch = array())
    {
        if (isset($batch['where'])) {
            $where = $batch['where'];
        } else {
            return 0;
        }
        if (isset($batch['where_value'])) {
            $where_value = $batch['where_value'];
        } else {
            return 0;
        }
        if (isset($batch['table'])) {
            $table = $batch['table'];
        } else {
            return 0;
        }
        if (isset($batch['current_id'])) {
            $current_id = $batch['current_id'];
        } else {
            $current_id = 0;
        }

        $this->db->where($where, $where_value);
        $this->db->from($table);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($row['id'] == $current_id) {
                    return 0;
                } else {
                    return 1;
                }
            }
        }
        $query->free_result();

        return 0;
    }

    public function ajax_single_update($table = '', $id = 0)
    {
        if (!$id) $id = $this->input->post('pk');
        $name = $this->input->post('name');
        $value = $this->input->post('value');
        if (!empty($id) && $value != '') {
            $this->db->where(array('id' => $id));
            $this->db->update($table, array($name => $value));
        }
        $status = $this->db->affected_rows();
        return $status;
    }

    public function search($batch = array())
    {
        if (isset($batch['table'])) {
            $table = $batch['table'];
        } else {
            return array();
        }
        $limit = (isset($batch['limit'])) ? $batch['limit'] : 10;
        $offset = (isset($batch['offset'])) ? $batch['offset'] : 0;
        $like = (isset($batch['like'])) ? $batch['like'] : 'hotel';
        $keyword = (isset($batch['keyword'])) ? $batch['keyword'] : '';
        $desc = (isset($batch['desc'])) ? $batch['desc'] : 'asc';
        $opt_code = (isset($batch['opt_code'])) ? $batch['opt_code'] : $like;
        $opt_name = (isset($batch['opt_name'])) ? $batch['opt_name'] : $like;
        $group_by = (isset($batch['group_by'])) ? $batch['group_by'] : '';

        $data = array();

        $this->db->limit($limit, $offset);
        $this->db->like($like, $keyword);
        $this->db->order_by($like, $desc);
        if ($group_by) $this->db->group_by($group_by);
        $this->db->from($table);
        $query = $this->db->get();

        $i = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[$i] = $row;
                $data[$i]['opt_code'] = $row[$opt_code];
                $data[$i]['opt_name'] = $row[$opt_name];
                $i += 1;
            }
        }
        $query->free_result();

        return $data;
    }

    function render_page($view, $data = null, $render = false)
    {
        $this->viewdata = (empty($data)) ? $this->data : $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if (!$render) return $view_html;
    }

    public function pagination($table = '', $filters = array(), $site_url = '', $limit = 10, $uri_segment = 3, $total_results = FALSE, $sql_properties = NULL)
    {
        $this->load->library('pagination');

        $pagination = array();

        //Pagination of result set
        $config['base_url'] = $site_url;
        $config['total_rows'] = ($total_results !== FALSE) ? $total_results : $this->row_counter($filters, $table, $sql_properties);
        $config['per_page'] = $limit;
        $config['uri_segment'] = $uri_segment;
        $config['suffix'] = (!isset($sql_properties['QUERY_STRING'])) ? '?' . $_SERVER["QUERY_STRING"] : "";
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
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

    public function user_pagination($filters = array(), $sql_properties = NULL)
    {
        $limit = (isset($sql_properties['limit'])) ? $sql_properties['limit'] : 10;
        $table = (isset($sql_properties['table'])) ? $sql_properties['table'] : 0;
        $site_url = (isset($sql_properties['site_url'])) ? site_url("{$sql_properties['site_url']}") : '';
        $uri_segment = (isset($sql_properties['uri_segment'])) ? $sql_properties['uri_segment'] : 3;
        $total_results = (isset($sql_properties['total_results'])) ? $sql_properties['total_results'] : FALSE;
        $class = (isset($sql_properties['class'])) ? $sql_properties['class'] : "pagination";

        $pagination = array();

        //Pagination of result set
        $config['base_url'] = $site_url;
        $config['total_rows'] = ($total_results !== FALSE) ? $total_results : $this->row_counter($filters, $table, $sql_properties);
        $config['per_page'] = $limit;
        $config['uri_segment'] = $uri_segment;
        $config['suffix'] = '?' . $_SERVER["QUERY_STRING"];
        $config['full_tag_open'] = "<ul class=\"{$class}\">";
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
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
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';

        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();

        return $pagination;
    }

    public function row_counter($filters = array(), $table = '', $sql_properties = NULL)
    {
        if (isset($sql_properties['select'])) $this->db->select($sql_properties['select']);

        if (is_countable($filters) && count($filters) > 0) {
            $this->db->where($filters);
        }
        if (isset($sql_properties['functions']) && is_array($sql_properties['functions'])) {
            $this->db->where($sql_properties['functions'], NULL, FALSE);
        }

        if (isset($sql_properties['functions']) && !is_array($sql_properties['functions'])) {
            $this->db->where($sql_properties['functions'], NULL, FALSE);
        }

        if (isset($sql_properties['like']) && is_array($sql_properties['like'])) {
            foreach ($sql_properties['like'] as $key => $like) {
                if (isset($sql_properties['like_option']["{$key}"])) {
                    $like_option = $sql_properties['like_option']["{$key}"];
                } else $like_option = 'both';
                $this->db->like($like, $sql_properties['like_value']["{$key}"], $like_option);
            }
        } else {
            if (isset($sql_properties['like']) && isset($sql_properties['like_value'])) {
                $this->db->like($sql_properties['like'], $sql_properties['like_value']);
            }
        }

        if (isset($sql_properties['or_like']) && is_array($sql_properties['or_like'])) {
            foreach ($sql_properties['or_like'] as $key => $like) {
                $this->db->or_like($like, $sql_properties['OR_like_value']["{$key}"]);
            }
        }

        if (isset($sql_properties['glue']) && isset($sql_properties['pieces'])) {
            if (is_array($sql_properties['glue']) && is_array($sql_properties['pieces'])) {
                foreach ($sql_properties['glue'] as $key => $value) {
                    $this->db->join($sql_properties['glue'][$key], $sql_properties['pieces'][$key], 'left');
                }
            } else {
                $this->db->join($sql_properties['glue'], $sql_properties['pieces'], 'left');
            }
        }

        if (isset($sql_properties['group_by'])) {
            if (is_array($sql_properties['group_by'])) {
                foreach ($sql_properties['group_by'] as $key => $value) {
                    $this->db->group_by($sql_properties['group_by'][$key]);
                }
            } else {
                $this->db->group_by($sql_properties['group_by']);
            }
        }

        if (isset($sql_properties['or'])) {
            $this->db->or_where($sql_properties['or']);
        }
        if (isset($sql_properties['or_where_in']) && isset($sql_properties['or_where_in_value'])) {
            $this->db->or_where_in($sql_properties['or_where_in'], $sql_properties['or_where_in_value']);
        }
        if (isset($sql_properties['where_in'])) {
            $this->db->where_in($sql_properties['where_in'], $sql_properties['where_in_value']);
        }

        if (isset($sql_properties['where_not_in']) && isset($sql_properties['where_not_in_glue'])) {
            $this->db->where_not_in($sql_properties['where_not_in_glue'], $sql_properties['where_not_in']);
        }

        if (isset($sql_properties['table'])) {
            $this->db->from($sql_properties['table']);
            return $this->db->count_all_results();
        } else {
            return $this->db->count_all_results($table);
        }

    }

    public function search_result_json($search_result = array())
    {
        return json_encode($search_result);
    }

    public function make_http_request($api_request_url = '')
    {
        if (empty($api_request_url)) return FALSE;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $api_request_url);
        //curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,2);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        $json = curl_exec($curl);
        curl_close($curl);
        return $json;
    }

    public function ajax_json_encode($response = array(), $success = 0)
    {
        $validation_error = (isset($response['validation_errors'])) ? $response['validation_errors'] : 0;
        $upload_error = (isset($response['upload_error'])) ? $response['upload_error'] : 0;

        if ($success == 1) {
            $response['mcode'] = 200;
            $response['mtitle'] = (isset($response['mtitle'])) ? $response['mtitle'] : "Saved!";
            $response['mcontent'] = (isset($response['mcontent'])) ? $response['mcontent'] : "Successfully information saved";
            $response['success'] = (isset($response['success'])) ? $response['success'] : 0;
            $response['mcolor'] = "#5F895F";
            $response['miconSmall'] = "fa fa-success shake animated";
        } else {
            $response['mcode'] = (isset($response['mcode'])) ? $response['mcode'] : 500;
            $response['mtitle'] = (isset($response['mtitle'])) ? $response['mtitle'] : "Error Raised!";

            if ($validation_error) $response['mcontent'] = validation_errors();
            elseif ($upload_error) $response['mcontent'] = $this->upload->display_errors();
            else $response['mcontent'] = (isset($response['mcontent'])) ? $response['mcontent'] : "Data Saved Failed";

            $response['mcolor'] = (isset($response['mcolor'])) ? $response['mcolor'] : "#C46A69";
            $response['miconSmall'] = (isset($response['miconSmall'])) ? $response['miconSmall'] : "fa fa-warning shake animated";
        }

        if (isset($response['data_mode'])) {
            $response['data_mode'] = $response['data_mode'];
        }
        if (isset($response['return_id'])) {
            $response['return_id'] = $response['return_id'];
        }

        echo json_encode($response);
        return;
    }

    public function cdata($table = '', $filters = array())
    {
        $count = $this->db->count_all_results($table);
        $sql_properties = array('table' => $table);

        $sidx = $this->input->get_post('sidx');
        if (!$sidx) $sidx = 'id';
        $sord = $this->input->get_post('sord');
        if (!$sord) $sord = 'asc';

        $limit = $this->input->get_post('rows');
        if (!$limit) $limit = 10;
        $sql_properties['limit'] = $limit;

        $sql_properties['order_by'] = $sidx;
        $sql_properties['order_type'] = $sord;

        $page = $this->input->get_post('page');
        if (!$page) $page = 1;

        $sql_properties['offset'] = $limit * $page - $limit;
        $sql_properties['offset'] = ($sql_properties['offset'] < 0) ? 0 : $sql_properties['offset'];

        $searchField = $this->input->get_post('searchField');
        $searchString = $this->input->get_post('searchString');

        if (!$searchField) $searchField = false;
        $searchOper = $this->input->get_post('searchOper');
        if (!$searchOper) $searchOper = false;

        if ($this->input->get_post('_search') == 'true') {
            $ops = array(
                'eq' => '=',
                'ne' => '<>',
                'lt' => '<',
                'le' => '<=',
                'gt' => '>',
                'ge' => '>=',
                'bw' => 'like',
                'bn' => 'NOT like',
                'in' => 'like',
                'ni' => 'NOT like',
                'ew' => 'like',
                'en' => 'NOT like',
                'cn' => 'like',
                'nc' => 'NOT like'
            );

            if (isset($ops["{$searchOper}"])) {

            }

            foreach ($ops as $key => $value) {
                if ($searchOper == $key) {
                    $ops = $value;
                }
            }

            if ($searchOper == 'eq') {
                $filters["{$searchField}"] = (int)$searchString;
            } else if ($searchOper == 'bw') {
                $sql_properties['like'][] = $searchField;
                $sql_properties['like_value'][] = $searchString;
                $sql_properties['like_option'][] = 'after';
            } else if ($searchOper == 'bn') {
                $sql_properties['like'][] = $searchField;
                $sql_properties['like_value'][] = $searchString;
                $sql_properties['like_option'][] = 'before';
            } else if ($searchOper == 'ew') {
                $sql_properties['like'][] = $searchField;
                $sql_properties['like_value'][] = $searchString;
                $sql_properties['like_option'][] = 'before';
            } else if ($searchOper == 'en') {
                $sql_properties['not_like'][] = $searchField;
                $sql_properties['not_like_value'][] = $searchString;
                $sql_properties['not_like_option'][] = 'after';
            } else if ($searchOper == 'cn') {
                $sql_properties['like'][] = $searchField;
                $sql_properties['like_value'][] = $searchString;
                $sql_properties['like_option'][] = 'both';
            } else if ($searchOper == 'nc') {
                $sql_properties['not_like'][] = $searchField;
                $sql_properties['not_like_value'][] = $searchString;
                $sql_properties['not_like_option'][] = 'both';
            } else if ($searchOper == 'in') {
                $sql_properties['where_in'][] = $searchField;
                $sql_properties['where_in_value'][] = $searchString;
            } else if ($searchOper == 'ni') {
                $sql_properties['where_not_in'][] = $searchField;
                $sql_properties['where_not_in_glue'][] = $searchString;
            }

            $count = $this->db->count_all_results($table);
            if ($count > 0) $total_pages = ceil($count / $sql_properties['limit']);
            else $total_pages = 0;
        }

        $return_data = $this->get_rows($sql_properties, $filters);
        $data['page'] = $page;
        $data['records'] = $count;
        $data['total'] = ceil($count / 10);
        $data['rows'] = $return_data;
        echo json_encode($data);
        return;
    }

    public function set($filters = array(), $sql_properties = array(), $table = NULL, $set = NULL)
    {
        $table = (isset($sql_properties['table'])) ? $sql_properties['table'] : NULL;
        $set_field = (isset($sql_properties['set_field'])) ? $sql_properties['set_field'] : NULL;
        $incriment = (isset($sql_properties['incriment'])) ? $sql_properties['incriment'] : '+1';

        $this->db->where($filters);
        $this->db->set($set_field, $set_field . $incriment, FALSE);
        $this->db->update($table);
        return $this->db->affected_rows();
    }

    public function get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    public function valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE && $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //Alpha ID
    public function alphaID($in, $to_num = false, $pass_key = 'sujon-dostbd', $pad_up = 8)
    {
        $out = '';
        $index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $base = strlen($index);

        if ($pass_key !== null) {
            for ($n = 0; $n < strlen($index); $n++) {
                $i[] = substr($index, $n, 1);
            }

            $pass_hash = hash('sha256', $pass_key);
            $pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

            for ($n = 0; $n < strlen($index); $n++) {
                $p[] = substr($pass_hash, $n, 1);
            }

            array_multisort($p, SORT_DESC, $i);
            $index = implode($i);
        }

        if ($to_num) {
            // Digital number  <<--  alphabet letter code
            $len = strlen($in) - 1;

            for ($t = $len; $t >= 0; $t--) {
                $bcp = bcpow($base, $len - $t);
                $out = $out + strpos($index, substr($in, $t, 1)) * $bcp;
            }

            if (is_numeric($pad_up)) {
                $pad_up--;

                if ($pad_up > 0) {
                    $out -= pow($base, $pad_up);
                }
            }
        } else {
            // Digital number  -->>  alphabet letter code
            if (is_numeric($pad_up)) {
                $pad_up--;

                if ($pad_up > 0) {
                    $in += pow($base, $pad_up);
                }
            }

            for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
                $bcp = bcpow($base, $t);
                $a = floor($in / $bcp) % $base;
                $out = $out . substr($index, $a, 1);
                $in = $in - ($a * $bcp);
            }
        }

        return $out;
    }

    public function jsonencode($json)
    {
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($json);
        return;
    }

    public function imageResize($source_image = '', $new_image = '', $width = 50, $height = 50)
    {
        // Configuration
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_image;
        $config['new_image'] = $new_image;
        $config['create_thumb'] = TRUE;
        //$config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
        $config['height'] = $height;

        if (current_url() == $this->domain) {
            // Load the Library
            $this->load->library('image_lib', $config);

            // resize image
            $this->image_lib->resize();
            // handle if there is any problem
            if (!$this->image_lib->resize()) {
                //echo $this->image_lib->display_errors();
            }
        }

        return TRUE;
    }
}