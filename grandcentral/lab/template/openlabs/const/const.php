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
//	Some binds
/********************************************************************************************/	
	$_APP->bind_file('css', 'openlabs/const/css/const.css');
	$_APP->bind_file('script', 'openlabs/const/js/const.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$defaultVersion = 'en';
	
	$versions = i('version', array
	(
		'order()' => 'key ASC', 
	));
	
/********************************************************************************************/
//	Fetch the constants version by version
/********************************************************************************************/
	foreach ($versions as $version)
	{
		$consts[$version['key']->get()] = i('const', array
		(
			'version' => $version['id']->get(),
			'order()' => 'key ASC',
		))->set_index('key');
	}
?>