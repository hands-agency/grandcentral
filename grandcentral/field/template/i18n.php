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
	
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
	
//	A fake counter to keep track of the labels and field arrays
	$i = 0;
	
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('css/i18n.css');
	$_APP->bind_script('js/i18n.js');
	
/********************************************************************************************/
//	Fetch the versions
/********************************************************************************************/
	$db = database::connect($handled_env);
 	$q = 'SELECT DISTINCT `lang` FROM `version`';
	$r = $db->query($q);
	
//	Loop through the versions
	foreach ($r['data'] as $lang)
	{
	//	Build the label
		$labels[] = $lang['lang'];
	//	Build the field
		$class = $_FIELD->get_field();
		$value = $_FIELD->get_value();
		$value = (isset($value[$lang['lang']])) ? $value[$lang['lang']] : '';
		$params = array(
		//	'label' => null,
			'value' => $value,
			'disabled' => $_FIELD->is_disabled()
		);
		$fields[] = new $class($_FIELD->get_name().'['.$lang['lang'].']', $params);
	}
?>