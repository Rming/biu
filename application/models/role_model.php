<?php


class Role_model extends MY_Model {

    public function __construct() {
        parent::__construct('role');
    }

    public function role_array() {
        return $this->db->get($this->table_name)->result_array();
    }

    public function role($role_id) {

        foreach ($this->role_array() as $r) {
            if ($r['id'] == $role_id) {
                return $r;
            }
        }

        return NULL;
    }

}
