<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('resource_model.php');
class resource_action_model extends CI_Model {

	//resource_action
	const READONLY = 10;
	const WRITABLE = 20;

	//special action
	const QUALITY = 15;

   	public function get_list(){
   		$action_list = array(
   			array(
				'id'   => $this::READONLY,
				'name' => '仅读取',
   			),
   			array(
				'id'   => $this::WRITABLE,
				'name' => '可添加',
   			),
		);
		array_walk($action_list, function(&$row){$row = (object)$row;});

		return $action_list;
   	}
   	public function special_list(){
   		return array();
   	}
/*
   	public function special_list(){
   		$action_list = array(
   			array(
   				'for' => Resource_model::CONTRACT,
				'id'   => $this::QUALITY,
				'name' => '评价录入',
   			),
		);
		array_walk($action_list, function(&$row){$row = (object)$row;});

		return $action_list;
   	}
*/

}
