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
	$item = isset($_POST['item']) ? $_POST['item'] : trigger_error('Sorry, you need to give me an item to work with', E_USER_ERROR);
	$parent = isset($_POST['parent']) ? $_POST['parent'] : trigger_error('Sorry, you need to give me a parent for this page', E_USER_ERROR);
	$status = isset($_POST['status']) ? $_POST['status'] : trigger_error('Sorry, you need to give me a workflow status', E_USER_ERROR);
	
//	The original and the new draft in the workflow
	$original = i($item, null, $_SESSION['pref']['handled_env']);
	$draft = i('workflow', null, $_SESSION['pref']['handled_env']);
	
/********************************************************************************************/
//	Do the workflow thinggie
/********************************************************************************************/
//	Edit our original item
	$original['title'] = 'New '.$item;
	$original['parent'] = $parent;

//	Create a new workflow item
	$draft->enroll($original, $status);
	$draft->save();

/********************************************************************************************/
//	Return
/********************************************************************************************/
	$return = json_encode($draft['id']->get());
?>