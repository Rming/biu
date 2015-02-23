<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/core/REST_Controller.php';

class Like extends  REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('biu_model');
        $this->load->model('like_model');
        $this->load->library('like_lib');
        $this->load->helper('constant');
    }

    /**
     * 为指定biu_id的 biu 赞
     *
     * @param string biu_id
     *
     */
    public function create_post(){
        //检查biu是否存在，状态是否允许评论
        $biu_id  = $this->json('biu_id');

        //是否存在这个 biu_id
        $biu_id = $this->like_lib->filter_exist_biu($biu_id);

        $data = [
            'biu_id'     => $biu_id,
            'creator_id' => $this->login_member->id,
            'created_at' => time(),
        ];
        $like_save = $this->like_model->save($data);

        $ret = array(
            'error' => "200",
            'data'  => $like_save?:(new stdClass),
        );
        $this->response($ret);

    }
    /**
     * 获取指定biu，指定数量，评论的列表
     * @param string biu_id
     * @param string offset
     * @param string limit
     * @param string order ORDER_TIME_DESC / ORDER_TIME_ASC
     *
     */
    public function list_post(){
        $members = $this->like_lib->list_post();
        $ret = array(
            'error' => "200",
            'data'  => $members,
        );
        $this->response($ret);
    }

}

/* End of file comment.php */
/* Location: ./application/controllers/comment.php */
