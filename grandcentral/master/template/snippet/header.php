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
//	Bind
/********************************************************************************************/
	$_APP->bind_file('css', 'css/header.css');
	$_APP->bind_file('script', 'js/header.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	if (cc('page', current)['key'] == 'home')
	{
		$invite = '<div class="clapalong">Clap along if you feel like <span>adding</span> a <span>page</span> called <span>something new</span>.</div>';
	}
	else $invite = null;
?>