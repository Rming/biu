<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_constants')){

	function get_constants ($prefix) {

		$constants = array();

	    foreach (get_defined_constants() as $key=>$value){
			if (substr($key,0,strlen($prefix))==$prefix)
				$constants[$key] = $value;
	    }

	   	return $constants;
	}

}

