<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Base extends CI_Controller{

	function __construct(){
        parent::__construct();
    }

    public function index(){
    	$ret = array(
			'error' => "400",
			'data'  => array(),
		);
    	$this->json->response($ret);
    }

}
