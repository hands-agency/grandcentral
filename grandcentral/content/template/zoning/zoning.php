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
//	Some vars
/********************************************************************************************/	
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Item
	$handled_item = $_GET['item'];
	$handled_id = (isset($_GET['id'])) ? $_GET['id'] : null;
//	Current section
	$section = $_POST['section'];

/********************************************************************************************/	
//	Create the new form if not already existing
/********************************************************************************************/	
	require ADMIN_ROOT.'/content/template/edit/adminItemForm.class.php';
	$form = new adminItemForm($handled_env, $handled_item, $section, $handled_id);
?>