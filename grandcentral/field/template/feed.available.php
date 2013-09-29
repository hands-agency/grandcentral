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
//	Get and process from ajax
/********************************************************************************************/
//	The field name
//	$name = $_POST['name'];
	$name = $_SESSION['pref']['handled_env'].'_section';
	
//	sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $_POST);
	
	
//	Prepare values
	$available = cc('structure', 'app');
	$attr = (isset($available['attr'])) ? $available['attr'] : null;
	
//	Create a blank field (tweak)
/*	$param = array(
		'values' => json_decode($_POST['values']),
		'valuestype' => $_POST['valuestype'],
	);
	$multipleselect = new field_multipleselect(null, $param);
//	Get the available values
	$available = $multipleselect->prepare_values();
//	Refine
	if (isset($_POST['q'])) {
		echo 'refined with '.$_POST['q'];
	}
*/
?>