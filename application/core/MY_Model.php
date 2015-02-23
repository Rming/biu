<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

    public function __construct($table_name = '') {
        $this->load->database();
        $this->table_name = $table_name;
    }

    public function delete_where($data) {
        $this->db->where($data);
        $this->db->delete($this->table_name);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table_name);
    }

    public function gets($ids) {
        if (empty($ids)) {
            return array();
        }

        $this->db->from($this->table_name);
        $this->db->where_in('id', $ids);
        return $this->db->get()->result();
    }

    public function get($id) {
        return $this->_get($this->table_name, $id);
    }

    protected function _get($table, $id) {
        $this->db->from($table);
        $this->db->where(array('id'=>$id));
        $objs = $this->db->get()->result();
        if (count($objs) > 0) {
            return $objs[0];
        } else {
            return NULL;
        }
    }

    public function get_list($where = [] ,$limit=0, $offset=0, $order_by=NULL) {
        if(is_array($where) && $where) {
            $this->db->where($where);
        }

        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }

        if (!empty($order_by)) {
            $this->db->order_by($order_by);
        }

        $query = $this->db->get($this->table_name);

        return $query->result();
    }

    public function count() {
        $query = $this->db->get($this->table_name);
        return $query->num_rows();
    }

    public function where_count($data) {
        $query = $this->db->get_where($this->table_name, $data);
        return $query->num_rows();
    }

    public function save($data) {
        return $this->_save($this->table_name, $data);
    }

    protected function _save($table, $data) {
        if (array_key_exists('id', $data)) {
            $id = $data['id'];
            $this->db->update($table, $data, array('id' => $id));
        } else {
            $this->db->insert($table, $data);
            $id = $this->db->insert_id();
        }
        return $this->_get($table, $id);
    }

    public function where($data, $limit=0, $order_by=NULL, $offset=0) {
        $this->db->from($this->table_name);
        $this->db->where($data);

        if ($limit > 0) {
            if ($offset) {
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
        }

        if ($order_by) {
            $this->db->order_by($order_by);
        }

        return $this->db->get()->result();
    }
    public function where_one($data, $order_by=NULL) {
        if(!$order_by) {
            $this->db->order_by('id DESC');
        }
        $objs = $this->where($data, 1, $order_by);
        if (count($objs) > 0) {
            return $objs[0];
        } else {
            return NULL;
        }
    }

}
