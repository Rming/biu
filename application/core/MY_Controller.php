<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct($check=TRUE) {
        parent::__construct();

        //$this->output->enable_profiler(TRUE);

        if ($check) {
            $ci             = & get_instance();
            $ci->login_user = $this->check_login();
        }
    }



    protected function check_login() {

        $user = $this->get_login_employee();
        if ($user == null) {
            redirect('/firstblood/login');
        }

        //var_dump($user);
        return $user;
    }

    public function get_login_employee() {
        $user_token = $this->input->cookie('user_token');

        $user_array = preg_split('/\./', $user_token);

        if (count($user_array) != 4) {
            return null;
        }

        list($format_version, $type, $info_data, $verify_code) = $user_array;
        if ($format_version == '1') {
            $code = substr(md5($info_data), 8, 16);
            if ($verify_code == $code) {
                $user_array = json_decode(base64_decode($info_data));
                $user_id = $user_array->id;

                $user = $this->db->get_where($type, array('id' => $user_id))->row();

                empty($user->company_id)?redirect('logout'):'';

                return $user;
            }
        }

        return null;
    }

}
