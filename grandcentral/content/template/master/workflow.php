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
//	list($item, $id) = explode('_', $_POST['item']);
	$item = isset($_POST['item']) ? $_POST['item'] : trigger_error('Sorry, you need to give me an item to work with', E_USER_ERROR);
	$status = isset($_POST['status']) ? $_POST['status'] : trigger_error('Sorry, you need to give me a workflow status', E_USER_ERROR);
//	The original and the new copy in the workflow
	$original = i($item);
	$copy = i('workflow', null, $_SESSION['pref']['handled_env']);
	
/********************************************************************************************/
//	Do the workflow thinggie
/********************************************************************************************/
//	Fetch our item
	$original['title'] = 'success';
//	Create a new workflow
	$copy->grab($original, $status);
	
//	$workflow->unleash();

/********************************************************************************************/
//	Return
/********************************************************************************************/
	$return = json_encode('ok');
?>