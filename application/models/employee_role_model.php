<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_role_model extends MY_Model {

    public function __construct() {
        parent::__construct('employee_role');
    }



    public function in_role($role_id, $employee_id) {

        $m = $this->db->get_where(
            $this->table_name,
            array(
                'role_id' => $role_id,
                'employee_id' => $employee_id,
            )
        )->row();

        return !empty($m);
    }

    public function add_to_role($role_id, $employee_id) {
        $data = array(
            'role_id' => $role_id,
            'employee_id' => $employee_id,
        );

        $this->db->insert($this->table_name, $data);
    }

    public function remove_from_role($role_id, $employee_id) {
        $this->db->delete(
            $this->table_name,
            array(
                'role_id' => $role_id,
                'employee_id' => $employee_id,
            )
        );
    }
    public function get_where_in($column_name , $column_arr=array()){
        $this->db->where_in($column_name , $column_arr);
        $res = $this->db->get($this->table_name);
        if($res){
            return $res->result();
        }else{
            return array();
        }
    }


}
