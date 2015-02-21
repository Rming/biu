<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/core/REST_Controller.php';

class Like extends  REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('biu_model');
        $this->load->model('like_model');
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
        $biu_id = $this->filter_exist_biu($biu_id);

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
        //检查biu是否存在，状态是否允许评论
        $biu_id  = $this->json('biu_id');
        $offset  = $this->json('offset');
        $limit   = $this->json('limit');
        //是否存在这个 biu_id
        $biu_id   = $this->filter_exist_biu($biu_id);
        //like获取，默认时间顺序
        $order_by = "created_at ASC";

        $likes = $this->like_model->get_list($limit,$offset,$order_by);
        if($likes && is_array($likes) && count($likes)) {
            $members_id = array_map(function($v){
                return $v->creator_id;
            },$likes);
            $members_id = array_unique($members_id);
            if($members_id) {
                $members = $this->member_model->gets($members_id);
                $members = array_filter($members);
                $members_id_order = array_flip($members_id);
                usort($members, function($a,$b) use ($members_id_order){
                    return $members_id_order[$a->id] < $members_id_order[$b->id] ?-1:1;
                });
            }
        }
        $ret = array(
            'error' => "200",
            'data'  => isset($members)?$members:(new stdClass),
        );
        $this->response($ret);
    }


    protected function filter_exist_biu($biu_id) {
        $biu = $this->biu_model->get($biu_id);
        if(!$biu) {
            $ret = array(
                'error' => "441",
                'data'  => (new stdClass),
            );

            $this->response($ret);
        }
        return $biu_id;
    }
}

/* End of file comment.php */
/* Location: ./application/controllers/comment.php */
