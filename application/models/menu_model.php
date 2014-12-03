<?php


class Menu_model extends MY_Model {

    public function __construct() {
        parent::__construct('menu');
    }

    function by_permissions($permissions) {
        $this->db->from($this->table_name);
        $this->db->where_in('permission_id', $permissions);
        $this->db->order_by('weight', 'DESC');
        $menus = $this->db->get()->result();

        return $menus;
    }

    public function get_allowed_menus($menus) {
        $parent_ids = array();
        foreach ($menus as $m) {
            if (intval($m->parent_id) === 0) {
                if (!in_array($m->id, $parent_ids)) {
                    $parent_ids[] = $m->id;
                }
            }
        }

        $real_parent_ids = array();
        foreach ($menus as $m) {
            if (intval($m->parent_id) !== 0) {
                if (!in_array($m->parent_id, $parent_ids) && !in_array($m->parent_id, $real_parent_ids)) {
                    $real_parent_ids[] = $m->parent_id;
                }
            }
        }

        if (count($real_parent_ids) > 0) {
            $menus = array_merge($menus, $this->gets($real_parent_ids));
        }
        return $menus;
    }

    public function get_list() {
        $this->db->from($this->table_name);
        $this->db->order_by('weight', 'DESC');
        return $this->db->get()->result();
    }

}
