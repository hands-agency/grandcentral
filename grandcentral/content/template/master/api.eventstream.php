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
	if (isset($_GET['DEBUG']))
	{
		unset($_GET['DEBUG']);
		sentinel::debug('Debug ('.__FILE__.' line '.__LINE__.')', $_GET);
	}
	
/********************************************************************************************/
//	Headers
/********************************************************************************************/
	header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

/********************************************************************************************/
//	This API has the right content-type. Now Lets find the content
/********************************************************************************************/
//	Some vars
	$app = $_GET['app'];
	$key = $_GET['template'];
		
//	Call the right app
	echo app($app, $key);
?>