<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class service_SSO extends  REST_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function login_post(){
		/*
		echo $this->json->get('service');
		echo $this->json->get();
		echo $this->json->request;

		*/
		$aa = "hahah";
		//$this->json->response($aa);
		//$this->response($aa , 200);
	}

}

/* End of file  */
/* Location: ./application/controllers/ */
