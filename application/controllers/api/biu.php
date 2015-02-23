<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/core/REST_Controller.php';

class Biu extends  REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('biu_model');
        $this->load->model('member_model');
        $this->load->model('biu_attachment_model');
        $this->load->model('attachment_model');
        $this->load->model('attachment_tag_model');
        $this->load->model('tag_model');
        $this->load->model('tag_unique_model');
        $this->load->model('like_model');
        $this->load->model('comment_model');
        $this->load->library('comment_lib');
        $this->load->library('like_lib');
        $this->load->helper('constant');
    }
    public function create_post(){
        $attachment  = $this->json('attachment');
        $description = $this->json('description');

        $this->filter_empty_both($attachment , $description);

        //保存biu~
        $data = [
            'creator_id'  => $this->login_member->id,
            'description' => $description,
            'created_at'  => time(),
        ];
        $biu_save = $this->biu_model->save($data);

        $attachments_save = [];
        if(is_array($attachment) && count($attachment)) {
            foreach ($attachment as $att) {
                $att = (array)$att;
                //attachment保存
                $data = [
                    'type'       => isset($att['type'])?$att['type']:TYPE_IMAGE,
                    'url'        => isset($att['url'])?$att['url']:null,
                    'scale'      => isset($att['scale'])?$att['scale']:0,
                    'created_at' => time(),
                ];
                $data     = array_filter($data);
                $att_save = $this->attachment_model->save($data);
                //attachment 和 biu的关系
                $data = [
                    'biu_id'        => $biu_save->id,
                    'attachment_id' => $att_save->id,
                    'created_at'    => time(),
                ];
                $biu_att_map = $this->biu_attachment_model->save($data);
                //tag保存
                $tags_save = [];
                if(isset($att['tag']) && is_array($att['tag'])) {
                    foreach ($att['tag'] as $tag) {
                        $tag      = (array)$tag;
                        $tag_name = isset($tag['name'])?$tag['name']:null;
                        $tag_get  = $this->tag_unique_model->where_one(['name' => $tag_name]);
                        if(!$tag_get) {
                            //slug处理
                            $data = [
                                'name'       => $tag_name,
                                'slug'       => null,
                                'created_at' => time(),
                            ];
                            $tag_get  = $this->tag_unique_model->save($data);
                        }
                        $data = [
                            'tag_unique_id' => $tag_get->id,
                            'position_x'    => isset($tag['position_x'])?$tag['position_x']:null,
                            'position_y'    => isset($tag['position_y'])?$tag['position_y']:null,
                            'created_at'    => time(),
                        ];
                        $tag_save    = $this->tag_model->save($data);
                        $tag_save->name        = $tag_get->name;
                        $tag_save->description = $tag_get->description;
                        $tag_save->background  = $tag_get->background;
                        $tag_save->slug        = $tag_get->slug;
                        $tag_save->is_topic    = $tag_get->is_topic;
                        $tags_save[] = $tag_save;
                        //tag attachment 关系
                        $data = [
                            'attachment_id' => $att_save->id,
                            'tag_id'        => $tag_save->id,
                            'created_at'    => time(),
                        ];
                        $att_tag_map = $this->attachment_tag_model->save($data);
                    }
                    $att_save->tag = $tags_save;

                }

                $attachments_save[] = $att_save;
            }
        }
        $biu_save->attachment = $attachments_save;
        $ret = array(
            'error' => "200",
            'data'  => $biu_save?:(new stdClass),
        );
        $this->response($ret);
    }
    /**
     * 获取 指定筛选条件（当前用户/附近/推荐）指定数量的 biu 文
     *
     * @param string section
     * @param string offset
     * @param string limit
     * @param string order
     * @param string biu_id
     *
     */
    public function list_post(){
        $section = $this->json('section');
        $order   = $this->json('order');
        $limit   = $this->json('limit');
        $offset  = $this->json('offset');
        $biu_id  = $this->json('biu_id');

        $comment_limit = $this->json('comment_limit') ?: 0;
        $like_limit    = $this->json('like_limit')    ?: 0;

        if($biu_id) {
            //单个biu
            $biu_id = $this->filter_exist_biu($biu_id);
            $bius   = $this->get_section_one($biu_id);
        } else {
            //获取列表
            $order_by = $this->parse_order($order);

            if($section == SECTION_MY) {
                $bius = $this->get_section_my($limit,$offset,$order_by);
            } elseif($section == SECTION_FOLLOW) {
                $bius = $this->get_section_follow($limit,$offset,$order_by);
            } elseif($section == SECTION_NEAR) {
                $bius = $this->get_section_near($limit,$offset,$order_by);
            } elseif($section == SECTION_RECOMMEND) {
                $bius = $this->get_section_recommend($limit,$offset,$order_by);
            } else {
                $this->get_section_unknown();
            }
        }

        foreach ($bius as $biu) {
            $attachments     = [];
            $attachment_tags = [];
            $biu_attachments = $this->biu_attachment_model->where(['biu_id'=>$biu->id]);
            foreach ($biu_attachments as $biu_attachment) {
                $tags = [];
                $attachment = $this->attachment_model->get($biu_attachment->id);
                if($attachment) {
                    $attachments[]   = $attachment;
                    $attachment_tags = $this->attachment_tag_model->where(['attachment_id'=>$attachment->id]);
                    if($attachment_tags) {
                        foreach ($attachment_tags as $attachment_tag) {
                            $tag = $this->tag_model->get($attachment_tag->tag_id);
                            if($tag) {
                                $tag_unique = $this->tag_unique_model->get($tag->tag_unique_id);
                                if($tag_unique) {
                                    $tag->name        = $tag_unique->name;
                                    $tag->description = $tag_unique->description;
                                    $tag->background  = $tag_unique->background;
                                    $tag->slug        = $tag_unique->slug;
                                    $tag->is_topic    = $tag_unique->is_topic;
                                    $tags[] = $tag;
                                }
                            }
                        }
                    }
                    $attachment->tag = $tags?:[];
                }
            }
            $biu->attachments = $attachments;
            //creator
            $creator      = $this->member_model->get($biu->creator_id);
            $biu->creator = $creator?:(new stdClass);
            //comments_num
            $biu->comments_num = $this->comment_model->where_count(['biu_id'=>$biu->id]);
            //comment list
            $biu->comments     = $this->comment_lib->list_post($biu->id,0,$comment_limit);
            //like_num
            $biu->like_num     = $this->like_model->where_count(['biu_id'=>$biu->id]);
            //like list
            $biu->likes        = $this->like_lib->list_post($biu->id,0,$like_limit);
        }


        $ret = array(
            'error' => "200",
            'data'  => $bius?:(new stdClass),
        );
        $this->response($ret);

    }

    protected function get_section_one($biu_id = 0){
        $bius   = [];
        $bius[] = $this->biu_model->get($biu_id)?:[];
        return $bius;
    }
    protected function get_section_my($limit = 0,$offset = 0,$order_by = null){
        $where = ['creator_id'=>$this->login_member->id];
        $bius  = $this->biu_model->get_list($where,$limit,$offset,$order_by);
        return $bius;
    }

    protected function get_section_follow($limit = 0,$offset = 0,$order_by = null){
        $where = ['creator_id'=>$this->login_member->id];
        $bius  = $this->biu_model->get_list($where,$limit,$offset,$order_by);
        return $bius;
    }
    protected function get_section_near($limit = 0,$offset = 0,$order_by = null){
        $where = ['creator_id'=>$this->login_member->id];
        $bius  = $this->biu_model->get_list($where,$limit,$offset,$order_by);
        return $bius;
    }
    protected function get_section_recommend($limit = 0,$offset = 0,$order_by = null){
        $where = ['creator_id'=>$this->login_member->id];
        $bius  = $this->biu_model->get_list($where,$limit,$offset,$order_by);
        return $bius;
    }
    protected function get_section_unknown(){
        $ret = array(
            'error' => "442",
            'data'  => (new stdClass),
        );
        $this->response($ret);
    }

    protected function parse_order($order) {
        $orders = get_constants("ORDER_");
        $orders = array_flip($orders);
        if(isset($orders[$order])) {
            if($order == ORDER_TIME_ASC) {
                return "created_at ASC";
            } elseif($order == ORDER_TIME_DESC) {
                return "created_at DESC";
            } elseif($order == ORDER_LIKE_DESC) {
                return "created_at DESC";
            } elseif($order == ORDER_LIKE_ASC) {
                return "created_at DESC";
            } elseif($order == ORDER_COMMENT_DESC) {
                return "created_at DESC";
            } elseif($order == ORDER_COMMENT_ASC) {
                return "created_at DESC";
            }
        } else {
            return "created_at DESC";
        }
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

    protected function filter_empty_both($attachment , $description){
        if($description==='0'||$description===0){
            return true;
        }
        //both empty
        if(!$description || !$attachment){
            $ret = array(
                'error' => "430",
                'data'  => (new stdClass),
            );

            $this->response($ret);
        }
    }




}

/* End of file  */
/* Location: ./application/controllers/ */


