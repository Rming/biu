<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class resource_model extends CI_model {
	//resources category
    const CATE_BASIC    = 10;
    const CATE_TOOL     = 20;
    const CATE_SNS      = 30;
    const CATE_APP      = 40;
    const CATE_GENERAL  = 50;
    const CATE_DATA     = 60;
    const CATE_ADVANCED = 70;

    //basic permission
    const MY = 100;
    const NOTISHOW  = 111;

    //tool
    const COUPON = 210;
    const VIDEO  = 220;
    const QRCODE = 230;
    const CALCULATE = 400;

    //SNS
    const SNS_WECHAT = 1100;
    const SNS_WEIBO  = 1200;

    //APP
    const APP_YUESAOHUI   = 2100;
    const APP_MESSAGE     = 2600;
    const APP_MESSAGE_SYS = 2700;

    //general resources
    const CUSTOMER            = 3000;
    const CUSTOMER_UNASSIGNED = 3100;
    const CUSTOMER_DIGGER     = 3300;


    const NANNY    = 4000;
    const CONTRACT = 5000;
    const QUALITY  = 5500;
    const COMMENT  = 6000;
    const EVENT    = 7000;
    const ARTICLE  = 8000;
    const DIARY    = 8100;

    //salary
    const SALARY   = 8888;

    //data
    const DATA_CUSTOMER  = 9000;
    const DATA_CONTRACT  = 9100;
    const DATA_MAP       = 9200;
    const DATA_YUESAOHUI = 9300;
    const DATA_NANNY     = 9400;
    const DATA_NANNY_MAP = 9500;
    const DATA_MATRIX    = 9600;

    //advanced permission
    const SYS          = 9999;
    const SUPER        = 10000;


    public function get_list(){
        $resources_list = array(
            array(
                'id'   => $this::MY,
                'name' => '个人中心',
                'cate_id' => $this::CATE_BASIC,
            ),
            array(
                'id'   => $this::COUPON,
                'name' => '优惠活动',
                'cate_id' => $this::CATE_TOOL,
            ),
            array(
                'id'   => $this::VIDEO,
                'name' => '视频',
                'cate_id' => $this::CATE_TOOL,
            ),
            array(
                'id'   => $this::QRCODE,
                'name' => '二维码',
                'cate_id' => $this::CATE_TOOL,
            ),
            array(
                'id'   => $this::CALCULATE,
                'name' => '抢单计算器',
                'cate_id' => $this::CATE_TOOL,
            ),
            array(
                'id'   => $this::SNS_WECHAT,
                'name' => '微信',
                'cate_id' => $this::CATE_SNS,
            ),
            array(
                'id'   => $this::SNS_WEIBO,
                'name' => '微博',
                'cate_id' => $this::CATE_SNS,
            ),
            array(
                'id'   => $this::APP_YUESAOHUI,
                'name' => '月嫂汇',
                'cate_id' => $this::CATE_APP,
            ),
            array(
                'id'   => $this::APP_MESSAGE,
                'name' => '月嫂抢单消息',
                'cate_id' => $this::CATE_APP,
            ),
            array(
                'id'   => $this::APP_MESSAGE_SYS,
                'name' => '月嫂抢单系统消息',
                'cate_id' => $this::CATE_APP,
            ),
            array(
                'id'   => $this::CUSTOMER,
                'name' => '已分配客户',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::CUSTOMER_UNASSIGNED,
                'name' => '未安排客户',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::CUSTOMER_DIGGER,
                'name' => '待挖掘客户',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::NANNY,
                'name' => '服务员',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::CONTRACT,
                'name' => '合同',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::QUALITY,
                'name' => '质量回访',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::COMMENT,
                'name' => '评价管理',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::EVENT,
                'name' => '活动',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::ARTICLE,
                'name' => '文章',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::DIARY,
                'name' => '月嫂日记',
                'cate_id' => $this::CATE_GENERAL,
            ),
            array(
                'id'   => $this::DATA_CUSTOMER,
                'name' => '客户数据',
                'cate_id' => $this::CATE_DATA,
            ),
            array(
                'id'   => $this::DATA_CONTRACT,
                'name' => '合同数据',
                'cate_id' => $this::CATE_DATA,
            ),
            array(
                'id'   => $this::DATA_MAP,
                'name' => '地图数据',
                'cate_id' => $this::CATE_DATA,
            ),
            array(
                'id'   => $this::DATA_MATRIX,
                'name' => '综合数据',
                'cate_id' => $this::CATE_DATA,
            ),
            array(
                'id'   => $this::DATA_YUESAOHUI,
                'name' => '月嫂汇数据',
                'cate_id' => $this::CATE_DATA,
            ),
            array(
                'id'   => $this::DATA_NANNY,
                'name' => '月嫂数据',
                'cate_id' => $this::CATE_DATA,
            ),
            array(
                'id'   => $this::DATA_NANNY_MAP,
                'name' => '月嫂地图',
                'cate_id' => $this::CATE_DATA,
            ),
            array(
                'id'   => $this::SYS,
                'name' => '系统管理',
                'cate_id' => $this::CATE_ADVANCED,
            ),
            array(
                'id'   => $this::SUPER,
                'name' => '平台管理',
                'cate_id' => $this::CATE_ADVANCED,
            ),
            array(
                'id'   => $this::NOTISHOW,
                'name' => '提醒功能',
                'cate_id' => $this::CATE_BASIC,
            ),
            array(
                'id'   => $this::SALARY,
                'name' => '服务员薪水',
                'cate_id' => $this::CATE_GENERAL
            )
        );
        array_walk($resources_list, function(&$row){$row = (object)$row;});

        return $resources_list;
    }

    public function cate_list(){
        $cate_list = array(
            array(
                'id'   => $this::CATE_BASIC,
                'name' => '基本权限',
            ),
            array(
                'id'   => $this::CATE_TOOL,
                'name' => '工具权限',
            ),
            array(
                'id'   => $this::CATE_SNS,
                'name' => '社交媒体',
            ),
            array(
                'id'   => $this::CATE_APP,
                'name' => '手机应用',
            ),
            array(
                'id'   => $this::CATE_GENERAL,
                'name' => '其他权限',
            ),
            array(
                'id'   => $this::CATE_DATA,
                'name' => '统计数据',
            ),
            array(
                'id'   => $this::CATE_ADVANCED,
                'name' => '高级权限',
            ),

        );
        array_walk($cate_list, function(&$row){$row = (object)$row;});

        return $cate_list;
    }

    public function menu_resources(){

        $cate_list = $this->cate_list();
        $resources_list = $this->get_list();

        array_walk($cate_list,function($cate) use ($resources_list){
            $resources = array_filter($resources_list,function($resource) use ($cate){
                return $resource->cate_id==$cate->id;
            });
            $cate->resource = $resources;
        });

        $menu_resources = $cate_list;
        return $menu_resources;
    }
}
