<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/core/REST_Controller.php';

class Comment extends  REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('biu_model');
        $this->load->model('comment_model');
        $this->load->library('comment_lib');
        $this->load->helper('constant');
    }

    /**
     * 为指定biu_id的 biu 文创建评论
     *
     * @param string biu_id
     * @param string content
     *
     */
    public function create_post(){
        //检查biu是否存在，状态是否允许评论
        $biu_id  = $this->json('biu_id');
        $content = $this->json('content');

        //是否存在这个 biu_id
        $biu_id  = $this->comment_lib->filter_exist_biu($biu_id);
        //评论内容检查
        $content = $this->filter_empty($content);

        $data = [
            'biu_id'     => $biu_id,
            'creator_id' => $this->login_member->id,
            'content'    => $content,
            'created_at' => time(),
        ];
        $comment_save = $this->comment_model->save($data);

        $ret = array(
            'error' => "200",
            'data'  => $comment_save?:(new stdClass),
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
        $comments = $this->comment_lib->list_post();
        $ret = array(
            'error' => "200",
            'data'  => $comments?:(new stdClass),
        );
        $this->response($ret);
    }
    protected function filter_empty($comment_content){
        if($comment_content==='0'||$comment_content===0){
            return $comment_content;
        }
        if(!$comment_content){
            $ret = array(
                'error' => "440",
                'data'  => (new stdClass),
            );

            $this->response($ret);
        }

        return $comment_content;
    }
}

/* End of file comment.php */
/* Location: ./application/controllers/comment.php */
