<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Role extends MY_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('role_model');
        $this->load->model('resource_model');
        $this->load->model('resource_action_model');
        $this->load->model('resource_section_model');

    }

    public function index() {

        $data = array(
            'role_array' => $this->role_model->role_array(),
            'tpl'        => 'firstblood/tpl_role_index'
        );

        $this->load->view('tpl_layout', $data);
    }

    public function show($role_id) {


        $role = $this->role_model->role($role_id);
        $all_employees = $this->employee_model->get_list();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $employee_id = $this->input->post('employee_id');

            if (!$this->employee_role_model->in_role($role_id, $employee_id)) {
                $this->employee_role_model->add_to_role($role_id, $employee_id);
            }
        }

        $employee_array = $this->employee_model->list_by_role($role_id);
        $data = array(
            'role'           => $role,
            'employee_array' => $employee_array,
            'all_employees'  => $all_employees,
            'tpl'            => 'firstblood/tpl_single_role'
        );

        $this->load->view('tpl_layout', $data);
    }

    public function remove_employee() {
        $role_id = $this->input->get('role_id');
        $employee_id = $this->input->get('employee_id');

        $this->employee_role_model->remove_from_role($role_id, $employee_id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function edit($role_id) {

        $role             = $this->role_model->role($role_id);
        $role_permissions = $this->role_permission_model->where(array('role_id'=>$role_id));
        $resources        = $this->resource_model->get_list();
        $menu_resources   = $this->resource_model->menu_resources();
        $resource_section = $this->resource_section_model->get_list();
        $resource_action  = $this->resource_action_model->get_list();

        $resource_action_special = $this->resource_action_model->special_list();


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->role_permission_model->delete_where(array('role_id'=> $role_id));
            foreach ($resources as $resource) {
                $data           = array();
                $has_permission = FALSE;
                if(isset($_POST['permissions']['resource-'.$resource->id]['section'])){
                    $data['section_id'] = $_POST['permissions']['resource-'.$resource->id]['section'];
                    $has_permission     = TRUE;
                }
                if(isset($_POST['permissions']['resource-'.$resource->id]['action'])){
                    $data['action_id'] = $_POST['permissions']['resource-'.$resource->id]['action'];
                    $has_permission    = TRUE;
                }

                $data['resource_id'] = $resource->id;
                $data['role_id']     = $role_id;

                if($has_permission) {
                    $this->role_permission_model->save($data);
                    $role_permissions = $this->role_permission_model->where(array('role_id'=>$role_id));
                }
            }
        }

        $data = array(
            'role'             => $role,
            'role_permissions' => $role_permissions,
            'menu_resources'   => $menu_resources,
            'resource_section' => $resource_section,
            'resource_action'  => $resource_action,
            'special_action'   => $resource_action_special,
            'tpl'              => 'firstblood/tpl_role_edit',
        );

        $this->load->view('tpl_layout', $data);

    }

    public function create() {
        $this->_modify();
    }
    public function modify($role_id){
        $this->_modify($role_id);
    }

    public function _modify($role_id = 0){
        $role = $this->role_model->get($role_id);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('role_name',    '角色名称', 'trim|required');
        if($this->form_validation->run()){
            $role_data = array('name'=>$this->input->post('role_name'));
            if ($role) {
                $role_data['id'] = $role->id;
            }

            $role_get = $this->role_model->save($role_data);

            if(!$role){
                $basic_permission = array(
                    'role_id'     =>$role_get->id,
                    'resource_id' => Resource_model::MY,
                    'section_id'  => Resource_section_model::OWNED,
                    'action_id'   => Resource_action_model::WRITABLE,
                );
                $this->role_permission_model->save($basic_permission);
            }
        }
        $data = array(
            'role'=>$role,
            'tpl' => 'firstblood/tpl_role_create',
        );
        $this->load->view('tpl_layout', $data);

    }
    public function remove($role_id){

        $this->role_model->delete($role_id);
        $this->db->where('role_id',$role_id)->delete('role_permission');

        redirect($_SERVER['HTTP_REFERER']);
    }

}
