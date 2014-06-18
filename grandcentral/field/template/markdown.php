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
	$_APP->bind_css('css/wysiwyg.css');
	$_APP->bind_script('js/wysiwyg/wysihtml5-0.3.0.min.js');
	$_APP->bind_script('js/wysiwyg/advanced.js');
	$_APP->bind_script('js/wysiwyg.js');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
//	$values = $_FIELD->prepare_values();
//	$placeholder = $_FIELD->get_placeholder();
	
//	$value = $_APP->get_value();
//	$attrs = $_APP->get_attr();
?>