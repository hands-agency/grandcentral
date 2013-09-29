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
//	Bind
/********************************************************************************************/
	$_VIEW->bind('css', '/css/wysiwyg.css');
	$_VIEW->bind('script', '/js/wysiwyg/wysihtml5-0.3.0.min.js');
	$_VIEW->bind('script', '/js/wysiwyg/advanced.js');
	$_VIEW->bind('script', '/js/wysiwyg.js');
	
	$value = $_ITEM->get_value();
	$attrs = $_ITEM->get_attr();
?>