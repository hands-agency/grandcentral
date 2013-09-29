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
//	Construction du premier niveau (la suite dans field.ajax)
/********************************************************************************************/
	$value = $_ITEM->get_value();
	$param = array(
		'cssclass' => 'fieldEdit',
		'label' => 'type : ',
		'placeholder' => '...',
		'valuestype' => 'array',
		'values' => form::get_declared_fields(),
		'value' => $value['type'],
		'required' => true
	);
	$field = new field_select($_ITEM->get_name().'[type]', $param);
	$label = $field->get_label();
	$field->set_label('');
	$selector = '<li data-type="'.$field->get_type().'"><div class="wrapper">'.$field.'</div></li>';

//	???
	$param = array(
		'cssclass' => 'fieldInheritedValue',
		'value' => json_encode($value),
		'required' => true
	);
	$inheritedValue = new field_hidden($_ITEM->get_name().'[inheritedValue]', $param);
?>