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
//	Some vars
/********************************************************************************************/	
//	Test the api key
//	if (!$_GET['apikey']) trigger_error('You should have an apikey in your POST', E_USER_ERROR);
//	if (i('machine', $_GET['apikey'])->exists() === false) trigger_error('Sorry, this apikey does not exist', E_USER_ERROR);
//	api vars
	if (isset($_GET['pref'])) $pref = $_GET['pref']; else trigger_error('You should have a pref in your POST', E_USER_ERROR);
	
/********************************************************************************************/
//	Save the pref
/********************************************************************************************/
	$value = array($pref[1] => $pref[2]);
	$_SESSION['user']['pref'][$pref[0]] = $value;
	
/********************************************************************************************/
//	Return
/********************************************************************************************/
	$return = 'success';
?>