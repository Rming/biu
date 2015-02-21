<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/core/REST_Controller.php';

class Biu extends  REST_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('biu_model');
        $this->load->model('biu_attachment_model');
        $this->load->model('attachment_model');
        $this->load->model('attachment_tag_model');
        $this->load->model('tag_model');
        $this->load->model('tag_unique_model');
        $this->load->model('like_model');
        $this->load->model('comment_model');
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
     */
    public function list_post(){
        $section = $this->json('section');
        $order   = $this->json('order');
        $limit   = $this->json('limit');
        $offset  = $this->json('offset');

        $this->list_section_filter($section);

    }

    protected function list_section_filter(){
        $sections = get_constants("SECTION_");
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


