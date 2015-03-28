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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/	
	$_APP->bind_css('workflow/css/workflow.css');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/	
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Item
	$handled_item = $_GET['item'];
	$handled_id = (isset($_GET['id'])) ? $_GET['id'] : null;
	$item = i($handled_item, $handled_id, $handled_env);
	$structure = i('item', $handled_item, $handled_env);
	
//	Preparing the flow
	$flow = null;
	
/********************************************************************************************/
//	Fetch the workflows
/********************************************************************************************/
	$workflow = i('workflow', array(
		'item' => $structure['key'],
		'item' => 'item_'.$structure['id'],
	), 'site');

	$workflowstatuses = $structure['workflowstatus']->unfold();
?>