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
//	?
/********************************************************************************************/
	list($class, $method) = explode('::', $_GET['method']);
	$method = $_ITEM->data;
//	Methods
	$arg = null;
	if (isset($method['param'])) 
	{
		for ($i=0; $i < count($method['param']) ; $i++) $arg[] = $method['param'][$i]['name'];
		$arg = implode(', ', $arg);
	}
?>