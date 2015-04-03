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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	DEBUG
/********************************************************************************************/
	if (isset($_POST['DEBUG']))
	{
		unset($_POST['DEBUG']);
		sentinel::debug('AJAX debug ('.__FILE__.' line '.__LINE__.')', $_POST);
	}
/********************************************************************************************/
//	This API has the right content-type. Now Lets find the content
/********************************************************************************************/
//	Some vars
	$app = $_POST['app'];
	$key = $_POST['template'];
	$param = (isset($_POST['param'])) ? $_POST['param'] : null;
	if (is_string($param)) $_POST['param'] = $param = json_decode($param, true);
	
//	Reroute original $_GET passed as $_POST['_GET'] the $_GET
	if (isset($_POST['_GET']))
	{
		$_GET = $_POST['_GET'];
		unset($_POST['_GET']);
	}

//	We want the CSS and script zones soooo badly
	echo '<!-- ZONE:css -->';
	echo '<!-- ZONE:script -->';
		
//	Call the right app
	echo app($app, $key, $param);
?>