<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Base extends CI_Controller{

	function __construct(){
        parent::__construct();
    }

    public function index(){
    	//echo $this->json->get('service');
        //echo "service and method params required.";
    }

}
