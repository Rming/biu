<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/core/REST_Controller.php';

class Member extends  REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('member_model');
	}
	public function check_username_post(){
		$username = $this->json('username');

		$this->filter_empty_username_password($username , 'password');

		//if unique username
		$username_unique = $this->form_validation->is_unique($username , "member.username");
		if(!$username_unique){
			$error_code = "409";
		}else{
			$error_code = "200";
		}

		$ret = array(
			'error' => $error_code,
			'data'  => isset($json_data)?$json_data:(new stdClass),
		);

		$this->response($ret);

	}
	/**
	 * 注册接口
	 * @param username , json param 用户名
	 * @param password , json param 密码
	 * @return member json data 用户信息
	 */
	public function signup_post(){
		$username = $this->json('username');
		$password = $this->json('password');

		$this->filter_empty_username_password($username , $password);

		//if unique username
		$username_unique = $this->form_validation->is_unique($username , "member.username");
		if(!$username_unique){
			$error_code = "409";
		}else{
			$data = array(
				'username'   => $username,
				'created_at' => time(),
			);

			$member = $this->member_model->create($data , $password);
			if($member){
				$error_code = "200";
				$json_data  = $member;
			}else{
				$error_code = "500";
			}
		}

		$ret = array(
			'error' => $error_code,
			'data'  => isset($json_data)?$json_data:(new stdClass),
		);

		$this->response($ret);
	}


	/**
	 * 登陆验证接口
	 * @param username , json param 用户名
	 * @param password , json param 密码
	 * @return member json data 用户信息
	 */

	public function login_post(){
		$username = $this->json('username');
		$password = $this->json('password');

		$this->filter_empty_username_password($username , $password);

		$member = $this->member_model->where_one(array('username'=>$username));
		if($member){
			$login_check = $this->member_model->verify_login($member , $password);
			if($login_check){
				$error_code = "200";
				$json_data  = $member;
			}else{
				$error_code = "408";
			}
		}else{
			$error_code = "407";
		}

		$ret = array(
			'error' => $error_code,
			'data'  => isset($json_data)?$json_data:(new stdClass),
		);

		$this->response($ret);
	}


	public function update_post(){
		$member = $this->login_member;
		if($member){
			$data = array(
				'nickname'    => $this->json('nickname'),
				'description' => $this->json('description'),
				'gender'      => $this->json('gender'),
				'birthday'    => $this->json('birthday'),
				'phone'       => $this->json('phone'),
				'avatar'      => $this->json('avatar'),
				'background'  => $this->json('background'),
				'lat'         => $this->json('lat'),
				'lon'         => $this->json('lon'),
				'address'     => $this->json('address'),
				'from_where'  => $this->json('from_where'),
				'third_nick'  => $this->json('third_nick'),
			);
			$data = array_filter($data, function($v){
				return !($v===NULL || $v===FALSE || $v==='');
			});
			$data['id'] = $member->id;

			$member_saved = $this->member_model->save($data);
			$error_code = "200";
			$json_data  = $member_saved;
		}else{
			$error_code = "403";
		}

		$ret = array(
			'error' => $error_code,
			'data'  => isset($json_data)?$json_data:(new stdClass),
		);

		$this->response($ret);
	}

	protected function filter_empty_username_password($username , $password){
		//empty username
		if(!$username){
			$ret = array(
				'error' => "405",
				'data'  => array(),
			);

			$this->response($ret);
		}

		//empty password
		if($username && !$password){
			$ret = array(
				'error' => "406",
				'data'  => (new stdClass),
			);

			$this->response($ret);
		}

	}




}

/* End of file  */
/* Location: ./application/controllers/ */


