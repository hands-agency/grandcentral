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
	require 'adminItemForm.class.php';
	
	
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Item
	$handled_item = (isset($_GET['item'])) ? $_GET['item'] : null;
	$handled_id = (isset($_GET['id'])) ? $_GET['id'] : null;

	if (!empty($handled_item))
	{
		$form = new adminItemForm($handled_env, $handled_item, $handled_id);
	}
	else
	{
		$form = null;
	}
	
?>