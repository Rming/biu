<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/core/REST_Controller.php';

class service_SSO extends  REST_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function login_post(){
		//$service = $this->json('service');
		/*
		$ret = array(
			'error'   => "200",
			'service' => $service,
		);
		//$this->response($ret);
		// $this->json->get() == $this->json->request
		/*
		echo $this->json->get('service');
		echo $this->json->get();

		echo $this->json->request;

		echo $this->json();
		echo $this->json('service');

		*/
		//$this->json->response($aa);
		//$this->response($aa , 200);
	}

}

/* End of file  */
/* Location: ./application/controllers/ */
