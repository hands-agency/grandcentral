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
 * @copyright	Copyright © 20042012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	if (isset($_GET['item']))
	{
	//	The item
		$table = $_GET['item'];
	//	The parameters
		$param = (isset($_GET['param'])) ? $_GET['param'] : array();
	//	The joker param
		if (isset($_GET['q'])) $param['report'] = '%'.$_GET['q'].'%';
	}
	else
	{
		$table = 'page';
		$param = 'error_404';
	}

/********************************************************************************************/
//	Get items
/********************************************************************************************/
	$items = cc($table, $param);
?>