<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends MY_Model {

    public function __construct() {
        parent::__construct('member');
    }

    public function verify_login($user_row, $password) {
        $prefix_pos = strpos($user_row->password, ':');
        $prefix = '';
        if ($prefix_pos > -1) {
            $prefix = substr($user_row->password, 0, $prefix_pos);
        }

        if ($prefix == 'plain')  {
            $passwd = substr($user_row->password, $prefix_pos + 1);

            if ($passwd == $password) {
                // Verified
                return TRUE;
            } else {
                return FALSE;
            }
        } else if ($prefix == '') {
            // use sha1 encoded
            $password = sha1($user_row->id . ":" . $password);
            if ($user_row->password == $password) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    public function create($data, $password) {

        $this->db->insert('member', $data);
        $id = $this->db->insert_id();

		$pwd   = sha1($id . ':' . $password);
		$token = sha1($id . 'token' . $password);

        $member = $this->get($id);

        $data = array(
            'password' => $pwd,
            'token' => strtoupper($token),
            'token_at' => time(),
        );
        $data['id'] = $member->id;
        $member = $this->save($data);
        return $member;
    }

}
