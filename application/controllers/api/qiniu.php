<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/core/REST_Controller.php';

class qiniu extends  REST_Controller {

	const ACCESS_KEY = 'oExPi3tNsgEJiXK1ZBaDkf23kXaI6xeMqptTMW-w';
	const SECRET_KEY = 'rl1cQZlV9Usl-qswTVIyVwCWfLYkpS8kzrMsMPBC';

	public function __construct(){
		parent::__construct();

	}

	public function get_token_post(){
		$bucket = $this->json('qiniu_bucket');
		//onemin

		$this->filter_empty_bucket($bucket);

		//generate uptoken
		require_once(APPPATH.'libraries/qiniu/rs.php');
		$accessKey = self::ACCESS_KEY;
		$secretKey = self::SECRET_KEY;
		Qiniu_setKeys($accessKey, $secretKey);
		$putPolicy = new Qiniu_RS_PutPolicy($bucket);
		$upToken = $putPolicy->Token(null);

		$json_data = array(
			'qiniu_bucket' => $bucket,
			'qiniu_token'  => $upToken,
		);
		$ret = array(
			'error' => "200",
			'data'  => isset($json_data)?$json_data:(new stdClass),
		);

		$this->response($ret);

	}

	protected function filter_empty_bucket($bucket){
		//empty username
		if(!$bucket){
			$ret = array(
				'error' => "420",
				'data'  => (new stdClass),
			);

			$this->response($ret);
		}
	}


}

/* End of file  */
/* Location: ./application/controllers/ */


