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
 * @copyright	Copyright © 2004-2012, Café Central
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
//	Some vars
/********************************************************************************************/
	$app = $_GET['app'];
	$theme = $_GET['theme'];
	$template = $_GET['template'];
	
//	API to use
	$api = ROOT.'/theme/'.$app.'/'.$theme.'/'.$template.'.json.php';
	require $api;
?>