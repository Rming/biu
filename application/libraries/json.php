<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json{

	public      $request;

	public      $response;

	protected   $encrypt_pass = "123456789";

	public function __construct(){
		$this->request = $this->_get_request_body();
	}

	function  get($key = NULL){
		if(!$key){
			return $this->request;
		}

		$request_obj      = json_decode($this->request);
		if(isset($request_obj->$key)){
			return $request_obj->$key;
		}else{
			return NULL;
		}
	}

	protected function _get_request_body(){
		$http_body = trim(file_get_contents('php://input'));

		$isEncrypt = isset($_GET['isEncrypt'])?$_GET['isEncrypt']:false;
		if($isEncrypt){
			//解密
			require_once APPPATH.'libraries/RNCryptor/autoload.php';
			$cryptor = new \RNCryptor\Decryptor();
			$http_body = $cryptor->decrypt($http_body, $this->encrypt_pass);

		}
		return $http_body;
	}

	public function set_response($data){
		if(!$data){
			$data = '';
		}

		if(is_array($data) || is_object($data)){
			$data = json_encode($data);
		}

		$isEncrypt = isset($_GET['isEncrypt'])?$_GET['isEncrypt']:false;
		if($isEncrypt){
			//解密
			require_once APPPATH.'libraries/RNCryptor/autoload.php';
			$cryptor = new \RNCryptor\Encryptor();
			$http_body = $cryptor->encrypt(trim($data), $this->encrypt_pass);
		}else{
			$http_body = trim( $data);
		}

		$this->responce = $http_body;

		return $http_body;
	}

	public function response($data){
		//header?
		echo $this->set_response($data);
		exit;
	}



}

/* End of file libraryName.php */
/* Location: ./application/libraries/libraryName.php */
