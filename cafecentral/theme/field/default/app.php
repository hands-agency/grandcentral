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
	$_VIEW->bind('css', '/css/app.css');
	$_VIEW->bind('script', '/js/app.js');
	
/********************************************************************************************/
//	construction du champ app
/********************************************************************************************/
	$apps = registry::get('admin', registry::app_index);
	foreach ($apps as $app)
	{
		$values[$app->get_attr('key')] = $app->get_attr('title');
	}
	natcasesort($values);
	$p = array(
		'label' => 'App :',
		'placeholder' => '...',
		'values' => $values,
		'valuestype' => 'array'
	);
	$field = new field_select($_ITEM->get_name().'[app]', $p);
	
/********************************************************************************************/
//	Préchargement auto
/********************************************************************************************/
	$value = $_ITEM->get_value();
	//print '<pre>';print_r($value);print'</pre>';
//	app
	if (isset($value['app']) && !empty($value['app'])) $field->set_value($value['app']);
//	theme
	$theme = (isset($value['theme']) & !empty($value['theme'])) ? $value['theme'] : null;
//	template
	$template = (isset($value['template']) & !empty($value['template'])) ? $value['template'] : null;
//	param
	$params = (isset($value['param']) & !empty($value['param'])) ? htmlspecialchars(json_encode($value['param']), ENT_COMPAT, 'UTF-8') : null;
?>