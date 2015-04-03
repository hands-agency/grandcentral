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
//	Ajax
/********************************************************************************************/
	$app = app('content');
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
		$field = new fieldSelect($_POST['name'].'[key]', $params);
		if (!empty($_POST['value'])) $field->set_value($_POST['value']);
	}
?>