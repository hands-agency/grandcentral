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
//	The field name & idz
	$name = $_POST['name'];
	
//	Create a blank field (tweak)
	$param = array(
		'values' => $_POST['values'],
		'valuestype' => $_POST['valuestype'],
	);
	$multipleselect = new fieldMultipleselect(null, $param);
	
//	Get the available values
	$available = $multipleselect->prepare_values();
	
//	HACK MULTI TABLE
	if (count($param['values']) > 1 && is_array($param['values']))
	{
		$tmp = array();
		foreach ($available as $key => $value)
		{
			$tmp = array_merge($tmp, $value);
		}
	// print '<pre>';print_r($tmp);print'</pre>';
		$available = $tmp;
	}
	
//	Refine
	if (isset($_POST['q'])) {
		echo 'refined with '.$_POST['q'];
	}
?>