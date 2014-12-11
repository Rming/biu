<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Base extends CI_Controller{

	function __construct(){
        parent::__construct();
    }

    public function index(){
    	$this->ret->set($data,$error_code = 200,$error_message = '');
    	echo $this->json('service');
        //echo "service and method params required.";
    }

}
