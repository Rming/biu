<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission_checker{

  	protected 	$CI;

	public function __construct(){

        $this->CI =& get_instance();
	}

    public function has_permission($resource = NULL,$resource_section = NULL,$resource_action = NULL) {

        $role_arr = array();
        $roles = $this->CI->employee_role_model->where(array('employee_id'=>$this->CI->login_user->id));
        foreach ($roles as $role) {
            $role_arr[] = $role->role_id;
        }

        if(empty($role_arr)) {
            return FALSE;
        }

        $this->CI->db->where_in('role_id',$role_arr);
        if(!empty($resource)) {
            $this->CI->db->where('resource_id',$resource);
        }
        if(!empty($resource_section)) {
            $this->CI->db->where('section_id',$resource_section);
        }
        if(!empty($resource_action)) {
            $this->CI->db->where('action_id',$resource_action);
        }
        $permissions = $this->CI->role_permission_model->get_list();

        return $permissions;
    }
    public function employee_has_permission($resource = NULL,$resource_section = NULL,$resource_action = NULL) {
        if(!empty($resource)) {
            $this->CI->db->where('resource_id',$resource);
        }
        if(!empty($resource_section)) {
            $this->CI->db->where('section_id',$resource_section);
        }
        if(!empty($resource_action)) {
            $this->CI->db->where('action_id',$resource_action);
        }
        $permissions = $this->CI->role_permission_model->get_list();
        $role_ids = array_map(function($role_permissions){
            return $role_permissions->role_id;
        },$permissions);
        if(!$role_ids){
            return array();
        }
        $query = $this->CI->db->select('employee_id')->distinct('employee_id')
                            ->where_in('role_id',$role_ids)->get('employee_role');
        if($query){
            $employee_roles = $query->result();
            $employee_ids = array_map(function($role){
                return $role->employee_id;
            },$employee_roles);
            return $employee_ids;
        }else{
            return array();
        }

    }



}

/* End of file permission_checker.php */
/* Location: ./application/libraries/permission_checker.php */
