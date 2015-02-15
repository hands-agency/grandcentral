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
//	Some bind
/********************************************************************************************/
	$_APP->bind_css('field/css/link.css');
	$_APP->bind_script('field/js/link.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Iframe Link (Worst.Method.Ever)
	$iframeLink = '/grandcentral/sirtrevor/template/field/link.html';
//	Get the things you can link to
	$items = i('item', array(
		'hasurl' => true,
	//	'order()' => 'title',
	), 'site');
?>