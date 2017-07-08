<?php
/**
 * The generic Api of Grand Central
 * <pre>
 * // Get the page_1 in json
 * $api = app('api');
 * $api->call('get', ADMIN_URL.'/api.json/item/page?id=1');
 * $json = $api->json();
 * // Post a new page and retrieve it in json
 * $api = app('api');
 * $data = array('title' => 'My new page');
 * $api->call('post', ADMIN_URL.'/api.json/item/page', $data);
 * $json = $api->json();
 * </pre>
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link	http://grandcentral.fr
 */
class appApi extends _apps
{
	public $param;
	public $url = null;
	public $method = null;
	public $contenttype = null;
/**
 * key constructor (Don't forget it is an abstract key)
 *
 * @access	public
 */
	public function prepare()
	{
	//	Chop down the URL
		$url = (is_null($this->url)) ? mb_substr(URLR, 1) : $this->url;
		$method = (is_null($this->method)) ? strtolower($_SERVER['REQUEST_METHOD']) : $this->method;
	//	Get content type
		$contenttype = (is_null($this->method)) ? master::get_content_type() : $this->contenttype; 
	//	Explode parameters
		$array = explode('/', $url);

	//	Mime (ie: api.json)
		if (isset($array[0])) $this->param['api']['mime'] = $array[0];
	//	Version (ie: v1)
		if (isset($array[1])) $this->param['api']['v'] = $array[1];
	//	API (ie: pref)
		if (isset($array[2])) $this->param['api']['key'] = $array[2];
		
	//	Hash (add the rest of the hash)
		if (isset($array[3]))
		{
			$this->param['api']['hash'] = array();
			for ($i=3; $i < count($array); $i++)
			{
				$this->param['api']['hash'][] = $array[$i];
			}
		}

	//	Require the api key
		$key = $this->param['api']['key'].'/api'.ucfirst($this->param['api']['key']).'.php';
		$pathTokey = $this->get_templateroot(env).'/'.$this->param['api']['v'].'/'.$key;
		if (is_file($pathTokey))
		{
		//	require_once($pathTokey);
		
		//	Instantiate the api
			$api = 'api'.ucfirst($this->param['api']['key']);
			$o = new $api($this->param['api']);
			$o->request($method);
			
		//	Fetch & print the results
			if (method_exists($api, $method)) $this->param['api']['result'] = $o->$contenttype();
			else trigger_error('Sorry, no such method as as "'.$api.'::'.$method.'"', E_USER_ERROR);
		}
		else trigger_error('Sorry, no such API key as "'.$key.'".', E_USER_ERROR);
	}
/**
 * Loads app files and dependencies
 *
 * @access	public
 */
	public function load()
	{
		parent::load();
		
		$dir = new dir($this->get_templateroot());
		$files = $this->_explore_dir($dir);
		foreach ($files as $file)
		{
			require_once $file->get_root();
		}
	}
/**
 * explore_dir
 *
 * @private	public
 */
	private function _explore_dir($dir)
	{
		$keys = array();
		$elements = $dir->get();
		foreach ($elements as $e)
		{
			if (is_a($e, 'dir'))
			{
				$keys = array_merge($keys, $this->_explore_dir($e));
			}
			else
			{
				$key = $e->get_key();
				if (fnmatch('api[a-zA-Z]*.php', $key))
				{
					$keys[] = $e;
				}
				
			}
		}
		return $keys;
	}
/**
 * Get api list
 *
 * @access	public
 */
	public function get_list()
	{
		$dir = new dir($this->get_templateroot());
		$files = $this->_explore_dir($dir);
		return $files;
	}

/**
 * Call an API
 *
 * @param	string	The Request Method ('put', 'post', 'get', "delete')
 * @param	string	The Api URL
 * @param	array	The eventual data array
 * @access	public
 */
	public function call($method, $url, $data = false)
	{
	//	Maintain session
		$strCookie = isset($_COOKIE['PHPSESSID']) ? 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/' : null;
		session_write_close();
		
	//	Init Curl
	    $curl = curl_init();
	
	    switch (strtoupper($method))
	    {
	        case 'POST':
	            curl_setopt($curl, CURLOPT_POST, 1);
	            if ($data)
	                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	            break;
	        case 'GET':
	            curl_setopt($curl, CURLOPT_URL, 1);
	            break;
	        case 'PUT':
	            curl_setopt($curl, CURLOPT_PUT, 1);
	            break;
	        default:
	            if ($data)
	                $url = sprintf("%s?%s", $url, http_build_query($data));
	    }

	//	Optional Authentication:
	//	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	//	curl_setopt($curl, CURLOPT_USERPWD, "username:password");
	
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_COOKIE, $strCookie);
		/* Force pass user-agent: http://stackoverflow.com/questions/8194795/the-curl-user-agent */
		curl_setopt($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);

	    $result = curl_exec($curl);

	    curl_close($curl);
		session_start();
	    return $result;
	}
}
?>