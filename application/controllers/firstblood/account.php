<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Account extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('role_model');
        $this->load->model('employee_model');
        $this->load->model('employee_role_model');

    }

    public function index() {

        $employee_list = $this->employee_model->get_list();

        $employee_id_arr = array_map(function($employee){
            return $employee->id;
        }, $employee_list);

        $employee_roles = $this->employee_role_model->get_where_in('employee_id',$employee_id_arr);

        $data = array(
            'tpl'            => 'firstblood/tpl_account',
            'employee_list'  => $employee_list,
            'employee_roles' => $employee_roles,
        );

        $this->load->view('tpl_layout', $data);
    }


    public function create() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', '用户名', 'trim|required|is_unique[employee.name]');
        $this->form_validation->set_rules('phone', '电话', 'trim|required');
        $this->form_validation->set_rules('password', '密码', 'trim|required');
        $this->form_validation->set_rules('fullname', '姓名', 'trim|required');

        if($this->form_validation->run()) {

            $password = $this->input->post('password');

            $data = array(
                'name'       => $this->input->post('name'),
                'fullname'   => $this->input->post('fullname'),
                'password'   => '',
                'phone'      => $this->input->post('phone'),
                'updated_at' => date('Y-m-d H:i:s', time()),
                'created_at' => date('Y-m-d H:i:s', time()),
            );

            $employee = $this->employee_model->create($data, $password);
        }


        $data = array(
            'tpl' => 'firstblood/tpl_new_account',
        );

        $this->load->view('tpl_layout', $data);
    }
}
