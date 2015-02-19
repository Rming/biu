<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


//标记位使用的true / false
define('STATUS_TRUE',            1);
define('STATUS_FALSE',           0);

//Token 10年有效期
define('TOKEN_EXPIRED_AFTER',  10*365*24*60*60);

//性别
define('MALE',                   10);
define('FEMALE',                 11);

//biu文类型
define('TYPE_IMAGE',             20);
define('TYPE_VIDEO',             21);

//信息记录的状态
define('STATUS_NORMAL',          30);
define('STATUS_DELETED',         31);
define('STATUS_DISABLED',        32);

//section
define('SECTION_MY',             40);
define('SECTION_FOLLOW',         41);
define('SECTION_NEAR',           42);
define('SECTION_RECOMMEND',      43);

//order
define('ORDER_TIME_DESC',         50);
define('ORDER_LIKE_DESC',         51);
define('ORDER_COMMENT_DESC',      52);

/* End of file constants.php */
/* Location: ./application/config/constants.php */
