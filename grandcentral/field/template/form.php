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
//	Construction du premier niveau (la suite dans field.ajax)
/********************************************************************************************/
	$value = $_ITEM->get_value();
	print '<pre>';print_r($value);print'</pre>';
	// $param = array(
	// 		'css_class' => 'fieldEdit',
	// 		'label' => 'type : ',
	// 		'placeholder' => '...',
	// 		'valuestype' => 'array',
	// 		'values' => form::get_declared_fields(),
	// 		'value' => $value['type'],
	// 		'required' => true
	// 	);
	// 	$fieldEdit = new field_select($_ITEM->get_name().'[type]', $param);
	// 	$param = array(
	// 		'css_class' => 'fieldInheritedValue',
	// 		'value' => json_encode($value),
	// 		'required' => true
	// 	);
	// 	$inheritedValue = new field_hidden($_ITEM->get_name().'[inheritedValue]', $param);
?>