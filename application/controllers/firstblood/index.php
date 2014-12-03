<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data = array(
			'tpl'   => 'firstblood/tpl_fb_home',
		);
		$this->load->view('tpl_layout',$data);
	}
}

