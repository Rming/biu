<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Request_log_model extends MY_Model {

    public function __construct() {
        parent::__construct('request_log');
    }
}
