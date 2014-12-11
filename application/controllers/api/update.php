<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/core/REST_Controller.php';

class Update extends  REST_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function check_post(){
		$ret = array(
			'error' => '200',
			'data'  => array(
				'forceUpdate'       => '1',
				'needUpdate'        => '1',
				'updateDescription' => '有新功能了',
				'downloadUrl'       => 'https://itunes.apple.com/us/app/chong-wu-shuo-ni-chong-wu/id914242691?l=zh&ls=1&mt=8',
				'platform'          => 'iOS',
				'vcode'             => '1.2.2',
				'vname'             => '1.2.2',
			),
		);
		$this->json->response($ret);
		exit;
	}

}

/* End of file  */
/* Location: ./application/controllers/ */


