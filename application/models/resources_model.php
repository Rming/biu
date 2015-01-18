<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resources_model extends MY_Model {

    const TYPE_IMAGE = 1;
    const TYPE_VIDEO = 2;

    public function __construct() {
        parent::__construct('resources');
    }
}
