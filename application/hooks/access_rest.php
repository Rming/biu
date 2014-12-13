<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_rest {

	protected 	$CI;

	public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('member_model');
        $this->CI->load->model('request_log_model');
	}

	public function check() {
		$dir_name    = $this->CI->router->fetch_directory();
		$dir_name    = str_replace('/','',$dir_name);

		if($dir_name != 'api'){
			return true;
		}

		//保存request到request_log表
		$request = str_replace(PHP_EOL, '', $this->CI->json->request);
		$request = preg_replace('/\s+/', '', $request);
		$this->CI->request_log_model->save(array('request'=>$request));

		//不需要验证的 service / method
		//在 config.php 里设置 REST 白名单
		$allowned_uri = $this->CI->config->item('rest_allowned_uri');
		$class_name   = $this->CI->json->get('service');
		$method_name  = $this->CI->json->get('method');
		if(in_array(strtolower($class_name.'/'.$method_name), $allowned_uri)) {
			return true;
		}

		//需要验证其 token
		$token  = $this->CI->json->get('token');
		if($token){
			$member = $this->CI->member_model->where_one(array('token'=>strtoupper($token)));
			if($member){
				//store member info in super object
				$this->CI->login_member = $member;
				//if expired
				if($member->token_at && $member->token_at + TOKEN_EXPIRED_AFTER < time()){
					$ret = array('error' => '402');
				}else{
					return true;
				}
			}else{
				$ret = array('error'=> '403');
			}
		}else{
			$ret = array('error' => '401');
		}
		$this->CI->json->response($ret);

	}

}

/* End of file access_rest.php */
/* Location: ./application/hooks/access_rest.php */
