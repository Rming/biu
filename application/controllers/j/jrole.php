<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Jrole extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('role_model');
        $this->load->model('employee_role_model');
    }

    public function role_list() {

        $role_list = $this->role_model->role_array();

        $ret = array(
            'error_code' => 0,
            'result'     => array(
                'roles' => $role_list,
            ),
        );

        $this->output
             ->set_content_type('application/json;charset=utf-8')
             ->set_output(json_encode($ret));

    }
    public function add_role_by_employee($eid = 0){
        $data = array(
            'employee_id'=>$eid,
            'role_id'=>$_GET['role_id'],
        );

        $employee_role = $this->employee_role_model->where($data);

        if(!$employee_role) {
            $employee_role = $this->employee_role_model->save($data);
        }

        $ret = array(
            'error_code' => 0,
            'result'     => array(
                'employee_role' => $employee_role,
            ),
        );

        $this->output
             ->set_content_type('application/json;charset=utf-8')
             ->set_output(json_encode($ret));
    }

}
