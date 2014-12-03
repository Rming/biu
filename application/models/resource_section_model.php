<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('resource_model.php');
class resource_section_model extends CI_Model {

	//resource_section
	const OWNED   = 100;
	const COMPANY = 200;
	const SHARED  = 300;

	//special section

   	public function get_list(){
   		$section_list = array(
   			array(
				'id'   => $this::OWNED,
				'name' => '仅所有者',
   			),
   			array(
				'id'   => $this::COMPANY,
				'name' => '仅本公司',
   			),
   			array(
				'id'   => $this::SHARED,
				'name' => '含共享',
   			),
		);
		array_walk($section_list, function(&$row){$row = (object)$row;});

		return $section_list;
   	}

}
