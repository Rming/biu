<?php
/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
$dev_domain = array(
	'nvrenbang.com',
);


if(in_array($_SERVER['SERVER_NAME'],$dev_domain)){
	define('ENVIRONMENT', 'development');
}else{
	define('ENVIRONMENT', 'production');
}

if (defined('ENVIRONMENT'))
{
	switch (ENVIRONMENT)
	{
		case 'development':
			ini_set('display_errors', 1);
			error_reporting(E_ALL);

			define('DOMAIN',		'nvrenbang.com');
		break;

		case 'testing':
		case 'production':
			ini_set('display_errors', 0);
			error_reporting(0);

			define('DOMAIN',         'app.zaofenxiang.com');
		break;

		default:
			exit('The application environment is not set correctly.');
	}
}

