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
//	Apps
	// load('sirtrevor');
	$_APP->bind_script('js/underscore.js', true);
	$_APP->bind_script('js/eventable.js', true);
	$_APP->bind_script('js/sir-trevor.js', true);
	$_APP->bind_script('js/break.js', true);
	$_APP->bind_script('js/imagegc.js', true);
//	CSS & Scripts
	$_APP->bind_css('css/sirtrevor.css');
	$_APP->bind_script('js/sirtrevor.js');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	$value = $_FIELD->get_value();
	$attrs = $_FIELD->get_attrs();
?>