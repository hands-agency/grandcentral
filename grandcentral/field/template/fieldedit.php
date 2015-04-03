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
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('css/fieldedit.css');
	$_APP->bind_script('js/fieldedit.js');

/********************************************************************************************/
//	Construction du premier niveau (la suite dans field.ajax)
/********************************************************************************************/
	$value = $_APP->get_value();
	$param = array(
		'cssclass' => 'fieldEdit',
		'label' => 'type : ',
		'placeholder' => '...',
		'valuestype' => 'array',
		'values' => form::get_declared_fields(),
		'value' => $value['type'],
		'required' => true
	);
	$field = new field_select($_APP->get_name().'[type]', $param);
	$label = $field->get_label();
	$field->set_label('');
	$selector = '<li data-type="'.$field->get_type().'"><div class="wrapper">'.$field.'</div></li>';

//	???
	$param = array(
		'cssclass' => 'fieldInheritedValue',
		'value' => json_encode($value),
		'required' => true
	);
	$inheritedValue = new field_hidden($_APP->get_name().'[inheritedValue]', $param);
?>