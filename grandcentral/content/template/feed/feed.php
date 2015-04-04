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
	require ADMIN_THEME_ROOT.'/section/edit/admin_item_form.php';
	$form = new admin_item_form($handled_env, $handled_item, $section, $handled_id);
?>