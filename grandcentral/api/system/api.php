<?php
/**
 * Api Library
 *
 * @author	Sylvain Frigui <sf@hands.agency>
 * @access	public
 * @link		http://grandcentral.fr
 */

/**
 * App factory
 *
 * @param	string	app 1
 * @param	string	app 2...
 * @access	public
 */
	function api($method, $hash, $arg = null)
	{
	//	Load the class
		$a = app('api');
		$a->load();
		
	//	Override some vars
		$a->url = 'api.xxx/'.$hash;
		$a->method = $method;
		$a->contenttype = 'php';
		if (!is_null($arg)) $_GET = $arg;

	//	Prepare API
		$a->prepare();
		
	//	And return
		return $a->param['api']['result'];
	}
?>
