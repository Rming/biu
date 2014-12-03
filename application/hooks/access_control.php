<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_control {

	protected 	$CI;

	public function __construct() {
        $this->CI =& get_instance();
	}

	public function permission_check() {
		$class_name  = $this->CI->router->fetch_class();
		$method_name = $this->CI->router->fetch_method();
		$dir_name    = $this->CI->router->fetch_directory();
		$dir_name    = str_replace('/','',$dir_name);

		//整个 文件目录
		$allowned_dir   = $this->CI->config->item('allowned_dir');
		//整个 controller
		$allowned_class = $this->CI->config->item('allowned_class');
		//该 controller/method
		$allowned_uri   = $this->CI->config->item('allowned_uri');

		if(in_array($dir_name, $allowned_dir)) {
			return true;
		}

		if(in_array($class_name, $allowned_class)) {
			return true;
		}

		if(in_array($class_name.'/'.$method_name, $allowned_uri)) {
			return true;
		}
		/*

		//Resource_model::MY 为基本权限
		$basic_ac = $this->CI->permission_checker->has_permission(Resource_model::MY)?TRUE:FALSE;
		if(!$basic_ac) {
			header("refresh:3;url=".site_url('logout'));
			show_error('employee account disabled.');
			return false;
		}
		*/
		//directory 判断
		/*
		switch ($dir_name) {
			case 'super':
				$this->CI->permission_checker->has_permission(Resource_model::SUPER)?:show_error('access denied.');
				break;
			case 'sys':
				$this->CI->permission_checker->has_permission(Resource_model::SYS)?:show_error('access denied.');
				break;
			case 'article':
				if($class_name=='question')
				$this->CI->permission_checker->has_permission(Resource_model::ARTICLE)?:show_error('access denied.');
				break;
			case 'customer':
				if($class_name=='booking' && $method_name=='my'){
					$this->CI->permission_checker->has_permission(Resource_model::CUSTOMER)?:show_error('access denied.');
				}elseif($class_name=='booking' && $method_name=='unassigned'){
					$this->CI->permission_checker->has_permission(Resource_model::CUSTOMER_UNASSIGNED)?:show_error('access denied.');
				}elseif($class_name=='booking' && $method_name=='show'){
					$p_read_1 = $this->CI->permission_checker->has_permission(Resource_model::CUSTOMER_UNASSIGNED,NULL,Resource_action_model::WRITABLE);
					$p_read_2 = $this->CI->permission_checker->has_permission(Resource_model::CUSTOMER,NULL,Resource_action_model::WRITABLE);
					($p_read_2||$p_read_2)?:show_error('access denied.');
				}
				break;
			case 'data':
				if($class_name=='data_contract' && $method_name=='index'){
					$this->CI->permission_checker->has_permission(Resource_model::DATA_CONTRACT)?:show_error('access denied.');
				}elseif($class_name=='data_customer' && $method_name=='index'){
					$this->CI->permission_checker->has_permission(Resource_model::DATA_CUSTOMER)?:show_error('access denied.');
				}elseif($class_name=='data_map' && $method_name=='index'){
					$this->CI->permission_checker->has_permission(Resource_model::DATA_MAP)?:show_error('access denied.');
				}elseif($class_name=='data_yuesaohui' && $method_name=='activation'){
					$this->CI->permission_checker->has_permission(Resource_model::DATA_YUESAOHUI)?:show_error('access denied.');
				} elseif ($class_name=='data_nanny') {
					$this->CI->permission_checker->has_permission(Resource_model::DATA_NANNY)?:show_error('access denied.');
				}
				break;
			case 'sanji':
				if($class_name=='focus_img'){
					$this->CI->permission_checker->has_permission(Resource_model::APP_YUESAOHUI)?:show_error('access denied.');
				}
				break;
			case 'sns':
				if($class_name=='weibo'){
					$this->CI->permission_checker->has_permission(Resource_model::SNS_WEIBO)?:show_error('access denied.');
				}elseif($class_name=='weixin'){
					$this->CI->permission_checker->has_permission(Resource_model::SNS_WECHAT)?:show_error('access denied.');
				}
				break;
			case 'tool':
				if($class_name=='qd'){
					$this->CI->permission_checker->has_permission(Resource_model::APP_MESSAGE)?:show_error('access denied.');
				}elseif($class_name=='qrcode'){
					$this->CI->permission_checker->has_permission(Resource_model::QRCODE)?:show_error('access denied.');
				}
				break;
			case 'j':
				// json 接口 暂时不设置权限验证
				break;
			case '':
				//无directory 直接 class/method 的情况
				if($class_name=='app'){
					switch ($method_name) {
						case 'index':
						case 'my_message':
						case 'message':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::APP_MESSAGE,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::APP_MESSAGE,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'new_message':
						case 'act_message':
							$this->CI->permission_checker->has_permission(Resource_model::APP_MESSAGE,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						default:
							show_error('unknown method 1.');
							break;
					}

				}elseif ($class_name=='comment') {
					switch ($method_name) {
						case 'index':
						case 'contract_comment':
						case 'latest_nanny':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::COMMENT,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::COMMENT,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'new_contract_comment':
						case 'new_contract_comment_cn':
						case 'delete':
						case 'undelete':
						case 'set_tag':
						case 'remove_tag':
							$this->CI->permission_checker->has_permission(Resource_model::COMMENT,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						default:
							show_error('unknown method 2.');
							break;
					}
				}elseif ($class_name=='contract') {
					switch ($method_name) {
						case 'index':
						case 'show':
						case 'recalc':
						case 'qc_show':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::CONTRACT,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::CONTRACT,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'quality_call':
						case 'quality_call_cn':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::QUALITY,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::QUALITY,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'create':
						case 'undo_cancel':
						case 'cancel':
						case 'fill_fund':
						case 'change_nanny':
						case 'change_nanny_on_service':
						case 'on_service':
						case 'end_service':
						case 'contract_edit':
						case 'rebuild_all':
							$this->CI->permission_checker->has_permission(Resource_model::CONTRACT,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						case 'coupon_list':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::COUPON,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::COUPON,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'new_coupon':
							$this->CI->permission_checker->has_permission(Resource_model::COUPON,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						default:
							show_error('unknown method 3.');
							break;
					}
				} elseif($class_name=='contract_nanny'){
					switch ($method_name) {
						case 'index':
							break;
						case 'rebuild':
							break;
						case 'check':
							break;
						default:
							show_error('unknown method 3.');
							break;
					}
				}elseif ($class_name=='event') {
					switch ($method_name) {
						case 'index':
						case 'show':
						case 'outexcel':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::EVENT,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::EVENT,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'create':
						case 'edit':
						case 'finish':
						case 'remove_customer':
						case 'attend_event':
						case 'leave_event':
						case 'add_manager':
						case 'remove_manager':
						case 'manager_score':
							$this->CI->permission_checker->has_permission(Resource_model::EVENT,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						default:
							show_error('unknown method 4.');
							break;
					}
				}elseif ($class_name=='salary') {
					switch ($method_name) {
						case 'fulldays':
						case 'save':
						case 'contract_nanny':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::SALARY,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::SALARY,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'index':
						case 'tosave':
						case 'history':
						case 'outexcel':
							$this->CI->permission_checker->has_permission(Resource_model::SALARY,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						default:
							show_error('unknown method 4.');
							break;
					}
				}elseif ($class_name=='manager') {
					switch ($method_name) {
						case 'show_nanny_eval':
							break;
						case 'eval_nanny':
							break;
						default:
							show_error('unknown method 5.');
							break;
					}
				}elseif ($class_name=='nanny') {
					switch ($method_name) {
						case 'index':
						case 'show':
						case 'stat':
                        case 'find_first_3':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::NANNY,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::NANNY,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'create':
						case 'edit':
						case 'calc_schedule':
						case 'schedule':
						case 'rebuild_yuesao_price':
						case 'check_introduce_nanny':
						case 'introduce':
						case 'introducer':
						case 'find_and_save_phone':
						case 'introduce_phone':
						case 'input_phone':
						case 'set_schedule':
							$this->CI->permission_checker->has_permission(Resource_model::NANNY,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						default:
							show_error('unknown method 6.');
							break;
					}

				}elseif ($class_name=='tag') {
					switch ($method_name) {
						case 'remove_tag':
						case 'parse':
						case 'search':
							$this->CI->permission_checker->has_permission(Resource_model::ARTICLE,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						default:
							show_error('unknown method 7.');
							break;
					}
				}elseif ($class_name=='video') {
					switch ($method_name) {
						case 'index':
						case 'show':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::VIDEO,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::VIDEO,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'upload':
							$this->CI->permission_checker->has_permission(Resource_model::VIDEO,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						default:
							show_error('unknown method 8.');
							break;
					}
				}elseif ($class_name=='weixin') {
					switch ($method_name) {
						case 'index':
							$p_read  = $this->CI->permission_checker->has_permission(Resource_model::SNS_WEBCHAT,NULL,Resource_action_model::READONLY);
							$p_write = $this->CI->permission_checker->has_permission(Resource_model::SNS_WEBCHAT,NULL,Resource_action_model::WRITABLE);
							($p_read||$p_write)?:show_error('access denied.');
							break;
						case 'menu':
							$this->CI->permission_checker->has_permission(Resource_model::SNS_WEBCHAT,NULL,Resource_action_model::WRITABLE)?:show_error('access denied.');
							break;
						default:
							show_error('unknown method 9.');
							break;
					}
				}elseif ($class_name=='timer') {
				}elseif ($class_name=='memo') {
				}elseif ($class_name=='dashboard') {
				}else{
					show_error('unknown controller.');
				}
				break;
			default:
				show_error('unknown controller directory.');
				break;
		}
		*/


	}

}

/* End of file access_control.php */
/* Location: ./application/hooks/access_control.php */
