<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('json_ret')){

	function json_ret($err_code = 0 , $data = array(),$error_message = '' ,$redirect = ''){
		$CI =& get_instance();
		$json_t = $CI->input->get('t');

		if($json_t){

	        $ret = array(
				'error_code'    => $err_code,
				'error_message' => $error_message,
				'redirect'      => $redirect,
				'data'          => $data,
	        );

	        header("Content-Type:application/json;charset=utf-8");
	        echo json_encode($ret);
	        exit();
        }
	}

}


if ( ! function_exists('json_output')){

	function json_output($err_code = 0 , $error_message = '' , $jsonp = FALSE){
    	$ret = array(
			'error_code'    => $err_code,
			'error_message' => $error_message,
        );
        header("Content-Type:application/json;charset=utf-8");
        $output = json_encode($ret);
        if($jsonp){
        	$callback_func = isset($_GET['callback'])?$_GET['callback']:md5(time());
        	$output = $callback_func.'('.$output.')';
        }
        echo $output;
        exit();
    }

}

