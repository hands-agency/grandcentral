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
 * @copyright	Copyright © 2004-2013, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_file('css', 'css/i18n.css');
	
/********************************************************************************************/
//	Fetch the versions
/********************************************************************************************/	
	$db = database::connect('site');
 	$q = 'SELECT DISTINCT `lang` FROM `version`';
	$r = $db->query($q);
	
	foreach ($r['data'] as $lang)
	{
		$class = $_FIELD->get_field();
		$value = $_FIELD->get_value();
		$value = (isset($value[$lang['lang']])) ? $value[$lang['lang']] : '';
		$params = array(
			'label' => $lang['lang'],
			'value' => $value
		);
		$fields[] = new $class($_FIELD->get_name().'['.$lang['lang'].']', $params);
	}
?>