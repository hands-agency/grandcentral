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
	$_APP->bind_file('css', 'css/app.css');
	$_APP->bind_file('script', 'js/app.js');
	
/********************************************************************************************/
//	construction du champ app
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	$apps = registry::get(registry::app_index);
	// print'<pre>';print_r();print'</pre>';
//	look for apps with template
	foreach ($apps as $app)
	{
		if ($t = $app->get_templates(null, $_SESSION['pref']['handled_env']))
		{
			$about = $app->get_ini('about');
			$values[$app->get_key()] = $app->get_key();//$about['title'];
		}
	}
//	sort
	natcasesort($values);
//	field
	$p = array(
		'label' => 'App :',
		'placeholder' => '...',
		'values' => $values,
		'valuestype' => 'array'
	);
	$field = new fieldSelect($_FIELD->get_name().'[key]', $p);
	
/********************************************************************************************/
//	Autoload values
/********************************************************************************************/
	$value = $_FIELD->get_value();
//	app
	if (isset($value['key']) && !empty($value['key'])) $field->set_value($value['key']);
//	template
	$template = (isset($value['template']) & !empty($value['template'])) ? $value['template'] : null;
//	param
	$params = (isset($value['param']) & !empty($value['param'])) ? htmlspecialchars(json_encode($value['param']), ENT_COMPAT, 'UTF-8') : null;
?>