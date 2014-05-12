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
//	Some binds
/********************************************************************************************/	
	$_APP->bind_file('css', 'workflow/css/workflow.css');

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
	
//	Preparing the <table>
	$th = null;
	$td = null;
	
/********************************************************************************************/
//	Fetch the workflows
/********************************************************************************************/
	$workflow = i('workflow', array(
		'item' => 'structure_'.$structure['id'],
	), 'site');

	if ($workflow->count > 0) $workflowstatuses = $workflow[0]['workflowstatus']->unfold();
?>