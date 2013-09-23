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
	$_VIEW->bind('css', '/css/fieldedit.css');
	$_VIEW->bind('script', '/js/fieldedit.js');

/********************************************************************************************/
//	Build the main field selector (detail in stored in field.ajax)
/********************************************************************************************/
//	Some vars
	$value = $_ITEM->get_value();
	$form = $_POST['form'];
	$name = $form.'[field]['.$value['key'].']';
//	Create the main field type selector (a number ? a textarea ? ...)
	$param = array(
		'cssclass' => 'fieldEdit',
		'label' => 'Field type',
		'valuestype' => 'array',
		'values' => form::get_declared_fields(),
		'value' => $value['type'],
		'required' => true,
	);
	$field = new field_select($name.'[type]', $param);
//	Move label
	$label = $field->get_label();
	$field->set_label('');
//	The main field type selector
	$selector = '<li data-type="'.$field->get_type().'"><label>'.$label.'</label><div class="wrapper">'.$field.'<div class="help"></div></div></li>';
?>