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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	Construction du premier niveau (la suite dans field.ajax)
/********************************************************************************************/
	$value = $_APP->get_value();
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
	// 	$fieldEdit = new field_select($_APP->get_name().'[type]', $param);
	// 	$param = array(
	// 		'css_class' => 'fieldInheritedValue',
	// 		'value' => json_encode($value),
	// 		'required' => true
	// 	);
	// 	$inheritedValue = new field_hidden($_APP->get_name().'[inheritedValue]', $param);
?>