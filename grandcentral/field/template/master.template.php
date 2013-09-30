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
//	Ajax
/********************************************************************************************/
	$app = new app('master');
	$templates = $app->get_templates($_POST['pagetype'], $_SESSION['pref']['handled_env']);
//	construction du select
	$field = 'template : nodata';
	if (!empty($templates))
	{
		$params = array(
			'label' => 'template : ',
			'values' => $templates,
			'valuestype' => 'array',
			'value' => 'master'
		);
		$field = new fieldSelect($_POST['name'].'[template]', $params);
		if (!empty($_POST['value'])) $field->set_value($_POST['value']);
	}
?>