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
	$_VIEW->bind('css', '/css/multipleselect.css');
	$_VIEW->bind('script', '/js/multipleselect.js');
	
/********************************************************************************************/
//	The rel
/********************************************************************************************/
	$attrs = $_ITEM->get_attr();
	
//	Get the selected value
	$selected = $_ITEM->get_value();
	if (empty($selected)) $selected[] = array('title' => 'nodata');
	
//	Get the available values
	$available = $_ITEM->prepare_values();
	
/********************************************************************************************/
//	Ajax
/********************************************************************************************/
//	Values
	$param = array(
		'value' => json_encode($attrs['values']),
		'required' => true,
		'css_class' => 'values',
	);
	$values = new field_hidden($_ITEM->get_name().'[values]', $param);
//	Valuestypes
	$param = array(
		'value' => $attrs['valuestype'],
		'required' => true,
		'css_class' => 'valuestype',
	);
	$valuestype = new field_hidden($_ITEM->get_name().'[valuestype]', $param);
?>