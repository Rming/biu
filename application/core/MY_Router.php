<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Router extends CI_Router {


	function __construct(){
		parent::__construct();
	}

	function _validate_request($segments){

		if (count($segments) == 0)
		{
			return $segments;
		}

		// Does the requested controller exist in the root folder?
		if (file_exists(APPPATH.'controllers/'.$segments[0].'.php'))
		{
			return $segments;
		}

		//custom api router
		$x = $this->api_router($segments);
		if($x){
			return $x;
		}

		// Is the controller in a sub-folder?
		if (is_dir(APPPATH.'controllers/'.$segments[0]))
		{
			// Set the directory and remove it from the segment array
			$this->set_directory($segments[0]);
			$segments = array_slice($segments, 1);

			if (count($segments) > 0)
			{
				// Does the requested controller exist in the sub-folder?
				if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$segments[0].'.php'))
				{
					if ( ! empty($this->routes['404_override']))
					{
						$x = explode('/', $this->routes['404_override']);

						$this->set_directory('');
						$this->set_class($x[0]);
						$this->set_method(isset($x[1]) ? $x[1] : 'index');

						return $x;
					}
					else
					{
						show_404($this->fetch_directory().$segments[0]);
					}
				}
			}
			else
			{
				// Is the method being specified in the route?
				if (strpos($this->default_controller, '/') !== FALSE)
				{
					$x = explode('/', $this->default_controller);

					$this->set_class($x[0]);
					$this->set_method($x[1]);
				}
				else
				{
					$this->set_class($this->default_controller);
					$this->set_method('index');
				}

				// Does the default controller exist in the sub-folder?
				if ( ! file_exists(APPPATH.'controllers/'.$this->fetch_directory().$this->default_controller.'.php'))
				{
					$this->directory = '';
					return array();
				}

			}
			return $segments;
		}


		// If we've gotten this far it means that the URI does not correlate to a valid
		// controller class.  We will now see if there is an override
		if ( ! empty($this->routes['404_override']))
		{
			$x = explode('/', $this->routes['404_override']);

			$this->set_class($x[0]);
			$this->set_method(isset($x[1]) ? $x[1] : 'index');

			return $x;
		}

		// Nothing else to do at this point but show a 404
		show_404($segments[0]);
	}


	public function api_router($segments) {
		$x = array();
        if(count($segments) > 1 && strtolower($segments[0]) == 'api' && strtolower($segments[1]) == 'base'){
			$http_body = trim(file_get_contents('php://input'));
			$isEncrypt = isset($_GET['isEncrypt'])?$_GET['isEncrypt']:false;
			if($isEncrypt){
				require_once APPPATH.'libraries/RNCryptor/autoload.php';
				$cryptor = new \RNCryptor\Decryptor();
				$http_body = $cryptor->decrypt($http_body, $this->encrypt_pass);

			}
			$request_body = $http_body;

            $request_obj = json_decode($request_body);
            if(is_object($request_obj) && isset($request_obj->service , $request_obj->method)) {
                $this->set_directory('api');

				$service = strtolower($request_obj->service);
				$method  = strtolower($request_obj->method);
                if ( file_exists(APPPATH.'controllers/api/'.$service.'.php')){
                	$x = array($service,$method);
                }else{
                	$x = array();
                }
            }
        }
        return $x;
	}


}
// END Router Class

/* End of file Router.php */
/* Location: ./system/core/Router.php */
