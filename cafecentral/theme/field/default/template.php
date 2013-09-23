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
	$_VIEW->bind('css', '/css/template.css');
	$_VIEW->bind('script', '/js/template.js');
	
/********************************************************************************************/
//	construction du champ app
/********************************************************************************************/
	$values = array('html', 'xml', 'routine', 'json', 'eventstream');
	$p = array(
		'label' => 'type : ',
		'values' => $values,
		'valuestype' => 'array',
		'value' => 'html'
	);
	$field = new field_select($_ITEM->get_name().'[type]', $p);
	
/********************************************************************************************/
//	Préchargement auto
/********************************************************************************************/
	$value = $_ITEM->get_value();
	// print '<pre>';print_r($value);print'</pre>';
//	type
	if (isset($value['type']) && !empty($value['type'])) $field->set_value($value['type']);
//	theme
	$theme = (isset($value['theme']) & !empty($value['theme'])) ? $value['theme'] : null;
//	template
	$template = (isset($value['template']) & !empty($value['template'])) ? $value['template'] : null;
?>