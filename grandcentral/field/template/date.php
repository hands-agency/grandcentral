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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	load('jquery.clockpicker');
	$_APP->bind_script('js/date.js');
	$_APP->bind_css('css/date.css');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	
	$value = $_FIELD->get_value();
	// print'<pre>';print_r($value);print'</pre>';
	$date = mb_substr($value, 0, 10);
	$time = mb_substr($value, 11);
	// sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $_FIELD->get_value());
	// 	if ($_FIELD->get_value() == '')
	// 	{
	// 		list($date, $time) = explode(' ', $_FIELD->get_value());
	// 	}
	// 	else $date = $time = null;
?>