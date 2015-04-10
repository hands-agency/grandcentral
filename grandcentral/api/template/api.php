<?php
/**
 * Description: This is the description of the document.
 * You can add as many lines as you want.
 * Remember you're not coding for yourself. The world needs your doc.
 * Example usage:
 * <pre>
 * if (Example_Class::example()) {
 *    echo "I am an example.";
 * }
 * </pre>
 *
 * @author		Michaël V. Dandrieux <mvd@eranos.fr>
 * @copyright	Copyright ©2014 Eranos
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	Some security
/********************************************************************************************/
	if (!$_SESSION['user']->is_admin()) trigger_error('Sorry, admin only', E_USER_ERROR);

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$url = mb_substr(URL, mb_strlen(ADMIN_URL)+1);
	$method = strtolower($_SERVER['REQUEST_METHOD']);
	$array = explode('/', $url);		
	
//	Api (ie: api.json)
	if (isset($array[0])) $p['api'] = $array[0];
//	Template (ie: pref)
	if (isset($array[1])) $p['template'] = $array[1];
//	Item (ie: page)
	if (isset($array[2])) $p['item'] = $array[2];
	
//	Param (ie array('save' => true))
	if (isset($_GET)) $p['param'] = $_GET;
//	Data
	if (isset($_POST)) $p['data'] = $_POST;

/********************************************************************************************/
//	Get the right 
/********************************************************************************************/
//	Require the api class
	$class = $p['template'].'/api'.ucfirst($p['template']).'.php';
	require($class);
	
//	Instantiate the api
	$api = 'api'.ucfirst($p['template']);
	$result = new $api($p);
	
//	Fetch & print the results
	$result->$method();
?>