<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('employee_model');
        $this->load->model('menu_model');
        $this->load->model('Resource_model');
        $this->load->model('Resource_section_model');
        $this->load->model('Resource_action_model');
    }

    public function index() {
        $login_employee = $this->login_user;
        $permissions = $this->permission_checker->has_permission();
        $menus = array();
        foreach ($permissions as $permission) {
            $condition = array();
            $condition['resource_id'] = $permission->resource_id;
            $condition['action_id']   = empty($permission->action_id)?0:$permission->action_id;

            $menus_tmp = $this->db->where('resource_id',$condition['resource_id'])->where('action_id <=',$condition['action_id'])->get('menu')->result();

            $menus = array_merge($menus,$menus_tmp);
        }
        $array_unique_fb =  function($array2D){
            foreach ($array2D as $k=>$v){
                $v = (array)$v;
                $v = implode(",",$v); //降维
                $temp_v[$k] = $v;
            }
            $temp_v = array_unique($temp_v); //去掉重复的字符串
            foreach ($temp_v as  $v){
                $keys = array('id','name','parent_id','resource_id','action_id','weight','href');
                $value = explode(",",$v); //数组重新组装
                $temp[] = (object)array_combine($keys,$value);
            }
            return $temp;
        };
        $menus = $array_unique_fb($menus);

        $items = $this->menu_model->get_allowed_menus($menus);

        $menu = array();
        foreach ($items as $i) {
            if ($i->parent_id == '0') {
                $menu[] = $i;

                if ($i->name == '我') {
                    $i->name = $login_employee->fullname;
                }
            }
        }


        foreach ($menu as $m) {
            $sub_menu = array();
            foreach ($items as $i) {
                if ($i->parent_id == $m->id) {
                    $sub_menu[] = $i;
                }
            }
            $m->items = $sub_menu;
        }

        $ret = array(
            'error_code' => 0,
            'result'     => array(
                'menu'    => $menu
            ),
        );
        $this->output
             ->set_content_type('application/json;charset=utf-8')
             ->set_output(json_encode($ret));
    }

}
