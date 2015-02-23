<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comment_lib{
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
        $order_by = $this->parse_order($order);
        return $this->ci->comment_model->get_list(['biu_id'=>$biu_id],$limit,$offset,$order_by);
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
