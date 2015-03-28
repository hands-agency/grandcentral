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
	$_APP->bind_css('master/snippet/greenbutton/css/greenbutton.context.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$sectionkey = (isset($_POST['sectionkey'])) ? $_POST['sectionkey'] : null;
	$item = (isset($_GET['item'])) ? $_GET['item'] : null;
	$id = (isset($_GET['id'])) ? $_GET['id'] : null;
	$handled_item = (isset($item) && isset($id)) ? i($item, $id, $_SESSION['pref']['handled_env']) : null;
	$handled_itemItem = (isset($item) && isset($id)) ? i('item', $item) : null;
	
/********************************************************************************************/
//	Fetch the actions
/********************************************************************************************/
	$actions = ($sectionkey) ? i('section', $sectionkey, 'admin')['greenbutton']->unfold() : null;
	
/********************************************************************************************/
//	Some filters
/********************************************************************************************/
	if ($handled_item)
	{
	//	Only for items with URLs
		if (!$handled_itemItem->has_url())
		{
			/* TODO */
		}
	//	Can't set to the same status
		
	}
?>