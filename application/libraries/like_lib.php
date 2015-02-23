<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class like_lib{
    protected     $ci;

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->model('biu_model');
        $this->ci->load->model('comment_model');
        $this->ci->load->helper('constant');
    }

    public function list_post($biu_id = 0,$offset = 0, $limit = 0 ,$order = null){
        //检查biu是否存在，状态是否允许评论
        $biu_id  = $biu_id ?: $this->ci->json('biu_id');
        $offset  = $offset ?: $this->ci->json('offset');
        $limit   = $limit  ?: $this->ci->json('limit');
        $order   = $order  ?: $this->ci->json('order');
        //是否存在这个 biu_id
        $biu_id   = $this->filter_exist_biu($biu_id);
        //like获取，默认时间顺序
        $order_by = $this->parse_order($order);

        $likes = $this->ci->like_model->get_list(['biu_id'=>$biu_id],$limit,$offset,$order_by);
        $members = [];
        if($likes && is_array($likes) && count($likes)) {
            $members_id = array_map(function($v){
                return $v->creator_id;
            },$likes);
            $members_id = array_unique($members_id);
            if($members_id) {
                $members = $this->ci->member_model->gets($members_id);
                $members = array_filter($members);
                $members_id_order = array_flip($members_id);
                usort($members, function($a,$b) use ($members_id_order){
                    return $members_id_order[$a->id] < $members_id_order[$b->id] ?-1:1;
                });
            }
        }

        return $members;
    }

    public function parse_order($order) {
        $orders = get_constants("ORDER_TIME_");
        $orders = array_flip($orders);
        if(isset($orders[$order])) {
            if($order == ORDER_TIME_ASC) {
                return "created_at ASC";
            } elseif($order == ORDER_TIME_DESC) {
                return "created_at DESC";
            }
        } else {
            return "created_at DESC";
        }
    }

    public function filter_exist_biu($biu_id) {
        $biu = $this->ci->biu_model->get($biu_id);
        if(!$biu) {
            $ret = array(
                'error' => "441",
                'data'  => (new stdClass),
            );

            $this->ci->response($ret);
        }
        return $biu_id;
    }

}

/* End of file comment_lib.php */
/* Location: ./application/libraries/comment_lib.php */
