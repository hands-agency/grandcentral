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
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @access	public
 */
	public function prepare()
	{
	//	Chop down the URL
		$url = mb_substr(URL, mb_strlen(ADMIN_URL)+1);
		$method = strtolower($_SERVER['REQUEST_METHOD']);
		
	//	Explode parameters
		$array = explode('/', $url);

	//	Api (ie: api.json)
		if (isset($array[0])) $this->param['api']['key'] = $array[0];
	//	Version (ie: v1)
		if (isset($array[1])) $this->param['api']['v'] = $array[1];
	//	Class (ie: pref)
		if (isset($array[2])) $this->param['api']['class'] = $array[2];
	//	Item (ie: page)
		if (isset($array[3])) $this->param['api']['item'] = $array[3];
	//	ItemId (ie: 123)
		if (isset($array[4])) $this->param['api']['itemid'] = $array[4];
	//	Attr (ie: child)
		if (isset($array[5])) $this->param['api']['attr'] = $array[5];
	//	Attr Id(ie: 456)
		if (isset($array[6])) $this->param['api']['attrid'] = $array[6];
	
	//	Param (ie array('save' => true))
		if (isset($_GET) && !empty($_GET)) $this->param['api']['param'] = $_GET;
	//	Data
		if (isset($_POST) && !empty($_POST)) $this->param['api']['data'] = $_POST;

	//	Require the api class
		$class = $this->param['api']['class'].'/api'.ucfirst($this->param['api']['class']).'.php';
		$pathToClass = $this->get_templateroot(env).'/'.$this->param['api']['v'].'/'.$class;
		if (is_file($pathToClass))
		{
			require($pathToClass);
	
		//	Instantiate the api
			$api = 'api'.ucfirst($this->param['api']['class']);
			$o = new $api($this->param['api']);
			$o->$method();
			
		//	Fetch & print the results
			if (method_exists($api, $method)) $this->param['api']['result'] = $o->{master::get_content_type()}();
			else trigger_error('Sorry, no such method as as "'.$api.'::'.$method.'"', E_USER_ERROR);
		}
		else trigger_error('Sorry, no such API class as "'.$class.'".', E_USER_ERROR);
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
		$strCookie = 'PHPSESSID=' . $_COOKIE['PHPSESSID'] . '; path=/';
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

	    $result = curl_exec($curl);

	    curl_close($curl);

	    return $result;
	}
}
?>