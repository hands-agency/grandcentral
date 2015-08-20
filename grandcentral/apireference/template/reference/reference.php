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
 * @author		Michaël V. Dandrieux <mvd@eranos.fr>
 * @copyright	Copyright ©2014 Eranos
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some apps
/********************************************************************************************/
	load('jquery', 'bootstrap', 'highlightjs');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$requests = array('get', 'post', 'put', 'delete');
	$apiPage = i('page', 'api.json');
	
/********************************************************************************************/
//	Some functions
/********************************************************************************************/
	function extract_example($string)
	{
		preg_match_all('#\((.*?)\)#', $string, $matches);
		if (isset($matches[0][0])) return trim($matches[0][0], '()');
		else return false;
	}
	
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('reference/css/reference.css');
	$_APP->bind_script('reference/js/reference.js');
	
/********************************************************************************************/
//	Let's get to work
/********************************************************************************************/
	$app = app('api');
	$app->load();
	$apis = $app->get_list();
?>