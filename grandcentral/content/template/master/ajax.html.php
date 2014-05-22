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
 * @package		The package
 * @author		Michaël V. Dandrieux <mvd@cafecentral.fr>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2013, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
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
	$_POST['param'] = $param = isset($_POST['param']) ? json_decode($_POST['param'], true) : null;
	
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