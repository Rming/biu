<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends MY_Model {

    public function __construct() {
        parent::__construct('employee');
    }

    public function create($data, $password) {

        $this->db->insert('employee', $data);
        $id = $this->db->insert_id();

        $pwd = sha1($id . ':' . $password);
        $employee = $this->get($id);
        $employee->password = $pwd;

        $this->db->update('employee', $employee, array('id' => $id));
        return $employee;
    }

    public function by_name($name) {
        $query = $this->db->get_where('employee', array('name' => $name));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function verify_login($user_row, $password) {
        $prefix_pos = strpos($user_row->password, ':');
        $prefix = '';
        if ($prefix_pos > -1) {
            $prefix = substr($user_row->password, 0, $prefix_pos);
        }

        if ($prefix == 'plain')  {
            $passwd = substr($user_row->password, $prefix_pos + 1);

            if ($passwd == $password) {
                // Verified
                return TRUE;
            } else {
                return FALSE;
            }
        } else if ($prefix == '') {
            // use sha1 encoded
            $password = sha1($user_row->id . ":" . $password);
            if ($user_row->password == $password) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function gen_token($user_row) {
        $params = array(
            'id'    => $user_row->id,
            'name'  => $user_row->name,
            'ts'    => time(),
        );


        ksort($params);
        $s = json_encode($params);
        // token = $format_version.$data_info.$verifyed
        // data_info = base64_encoded(data_info)

        $s = base64_encode($s);
        $checking_code = md5($s);

        $checking_code = substr($checking_code, 8, 16);

        $s = "1.employee." . $s . "." . $checking_code;

        return $s;
    }

    public function list_by_role($role_id ) {
        $query = $this->db->get_where('employee_role', array('role_id' => $role_id));
        $mapping = $query->result();
        $employee_ids = array();
        foreach ($mapping as $m) {
            $employee_ids[] = $m->employee_id;
        }

        if (count($employee_ids) == 0) {
            return array();
        } else {
            $this->db->from($this->table_name);
            $this->db->where_in('id', $employee_ids);
            $this->db->order_by('id');
            return $this->db->get()->result();
        }
    }
}
