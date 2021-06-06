<?php

class Config_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_configs($filters = array(), $limit = 10, $offset = 0)
    {
        $return = array();
        $return['configs'] = array();

        $this->db->where($filters);
        $this->db->select('config.group, config.id');
        $this->db->order_by('config.option', 'asc');
        $this->db->limit($limit, $offset);
        $this->db->group_by("config.group");
        $this->db->from("config");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row['group_details'] = $this->batch_model->get_rows(array('limit' => 1000, 'table' => 'config'), array('group' => $row['group'], 'read' => 1));
                $return['configs'][] = $row;
            }
        }
        $query->free_result();

        return $return;
    }

    public function update($config_id)
    {
        $parsed_data = $this->parse_post();

        $this->db->where(array('id' => $config_id));
        $this->db->update($parsed_data, 'config');
        $status = $this->db->affected_rows();

        return $status;
    } //func

    public function save_config()
    {
        $parsed_data = $this->parse_config_post();
        $this->db->insert('config', $parsed_data);
        $config_id = $this->db->insert_id();

        return $config_id;
    }

    public function parse_config_post()
    {
        $parsed_data = array();
        //Common config post
        $parsed_data['group'] = $this->input->post('group');
        $parsed_data['option'] = strtolower(str_replace(' ', '_', $this->input->post('option')));
        $parsed_data['value'] = $this->input->post('value');
        $parsed_data['read'] = 1;
        $parsed_data['write'] = 1;
        $parsed_data['delete'] = 1;

        return $parsed_data;
    }

    public function update_ajax()
    {
        $id = $this->input->post('pk');
        $option = $this->input->post('name');
        $value = $this->input->post('value');

        if (!empty($id) && $value != '') {
            $this->db->where(array('id' => $id));
            $this->db->update('config', array('value' => $value));
        }
        $status = $this->db->affected_rows();
        return $status;
    } //func


    public function parse_post()
    {
        $parsed_data = array();
        //Common post
        $parsed_data['option'] = $this->input->post('option');
        $parsed_data['value'] = $this->input->post('value');

        return $parsed_data;
    }

    public function get_config($limit = 10, $offset = 0, $filters = array())
    {
        $return = array();
        $return['configs'] = array();

        $this->db->order_by('option', 'asc');
        $query = $this->db->get_where('config', $filters, $limit, $offset);

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $get_config['configs'][] = $row;
            }
        }
        $query->free_result();

        $return['pagination'] = $this->batch_model->pagination($filters, 'config', site_url("admin/config/index/show/0/"), $limit, $uri_segment = 5);

        return $return;
    } //func

    public function row_counter($filters = array())
    {
        if (is_countable($filters) && count($filters) > 0) {
            $this->db->where($filters);
        }
        return $this->db->count_all_results('config');
    } //func

}	