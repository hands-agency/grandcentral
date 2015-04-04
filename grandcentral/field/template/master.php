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
//	Some vars
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	
/********************************************************************************************/
//	Some bind
/********************************************************************************************/
	$_APP->bind_css('css/master.css');
	$_APP->bind_script('js/master.js');
	
/********************************************************************************************/
//	construction du champ app
/********************************************************************************************/
	$page = i('page');
	$p = array(
		'label' => 'type : ',
		'values' => array_keys($page->get_authorised_mime()),
		'valuestype' => 'array',
		'value' => 'html'
	);
	$field = new fieldSelect($_FIELD->get_name().'[type]', $p);
	
/********************************************************************************************/
//	Préchargement auto
/********************************************************************************************/
	$value = $_FIELD->get_value();

//	type
	if (isset($value['type']) && !empty($value['type'])) $field->set_value($value['type']);
//	template
	$template = (isset($value['key']) & !empty($value['key'])) ? $value['key'] : null;
?>