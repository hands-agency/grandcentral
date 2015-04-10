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
/**
 * Class constructor (Don't forget it is an abstract class)
 *
 * @access	public
 */
	public function prepare()
	{

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