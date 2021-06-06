<?php

class Widgets_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_rows($filters = array(), $limit = 10, $offset = 0)
    {
        $return = array();
        $return['rows'] = array();

        $this->db->where($filters);
        $this->db->limit($limit, $offset);
        $this->db->from("widgets");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($limit > 1) $return['rows'][] = $row;
                else $return['rows'] = $row;
            }
        }

        $return['pagination'] = $this->pagination($filters, $limit);

        return $return;
    }

    public function pagination($filters = array(), $limit = 10)
    {
        $pagination = array();

        //Pagination of result set
        $config['base_url'] = "#widgets/index";
        $config['total_rows'] = $this->row_counter($filters);
        $config['per_widget'] = $limit;
        $config['uri_segment'] = 4;
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

    public function row_counter($filters = array())
    {
        $this->db->where($filters);
        $this->db->from("widgets");
        return $this->db->count_all_results();
    }

    public function save($filters = array(), $mode = "add", $id = 0)
    {
        $parsed_data = $this->parsed_data($mode, $id);
        if (is_countable($filters) && count($filters) > 0) {
            $status = $this->_update($parsed_data, $filters);
            return $status;
        }

        $insert_query = $this->db->insert_string("widgets", $parsed_data);
        $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
        $this->db->query($insert_query);
        return $this->db->insert_id();
    }

    private function _update($parsed_data = array(), $filters = array())
    {
        $this->db->where($filters);
        try {
            $this->db->update("widgets", $parsed_data);
            return $this->db->affected_rows();
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function parsed_data($mode = "add", $id = 0)
    {
        $parsed_data['title'] = $this->input->post("title");
        $parsed_data['section_id'] = str_replace(" ", "_", strtolower($parsed_data['title']));
        $parsed_data['description'] = $this->input->post("description");
        $parsed_data['url'] = $this->input->post("url");
        $parsed_data['enabled'] = $this->input->post("enabled");

        return $parsed_data;
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
}