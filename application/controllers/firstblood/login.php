<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends MY_Controller {

	public function __construct(){
		parent::__construct(false);
	}

	public function index(){
		//已经登陆状态 ， 跳转到首页
		if($this->get_login_employee()){
			redirect('/firstblood/');
		}

		$this->form_validation->set_rules('username',  '用户名',    'required|trim|strip_tags|strtolower');
		$this->form_validation->set_rules('password',  '密码',      'required|trim|strip_tags');
		$this->form_validation->set_rules('vcode',     '验证码',     'required|trim|strtoupper|callback_vcode_check');

		if ($this->form_validation->run()){
			$password = $this->input->post('password');
			$name     = $this->input->post('username');

			$user_row = $this->employee_model->by_name($name);
            $verified = false;
            if ($user_row) {
                $verified = $this->employee_model->verify_login($user_row, $password);
            }
            if ($verified) {
                $token = $this->employee_model->gen_token($user_row);
                $cookie = array (
                    'name'     => 'user_token',
                    'expire'   => 0,
                    'value'    => $token,
                    'domain'   => DOMAIN,
                    'path'     => '/',
                    //'secure'   => TRUE
                );
                $this->input->set_cookie($cookie);
            }else{
            	$error['username'] = '用户名或密码不正确';
            }
			$error_code = count($error)?1:0;
			json_ret($error_code,$error);
		}else{
			$error = array(
				'username' => form_error('username'),
				'password' => form_error('password'),
				'vcode'    => form_error('vcode'),
			);
			$error = array_filter($error);
			json_ret('1',$error);
		}

        $data = array(
            'tpl'            => 'firstblood/tpl_user_login',
        );

        $this->load->view('tpl_layout', $data);
	}

	function vcode_check($str){
		$auth_code = $this->session->userdata('auth_code');
		$this->session->unset_userdata('auth_code');
		if ($str!==$auth_code){
			$this->form_validation->set_message('vcode_check', '验证码不正确。');
			return false;
		}else {
			return $str;
		}
	}
}

/* End of file login.php */
/* Location: ./application/controllers/user/login.php */
