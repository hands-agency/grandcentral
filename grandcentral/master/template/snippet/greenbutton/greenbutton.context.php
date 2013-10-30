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
//	Bind
/********************************************************************************************/
	$_APP->bind_css('snippet/greenbutton/css/greenbutton.context.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$sectionid = (isset($_POST['sectionid'])) ? $_POST['sectionid'] : null;
	$item = (isset($_GET['item'])) ? $_GET['item'] : null;
	$id = (isset($_GET['id'])) ? $_GET['id'] : null;
	$handled_item = (isset($item) && isset($id)) ? cc($item, $id) : null;
	$handled_itemStructure = (isset($item) && isset($id)) ? cc('structure', $item) : null;
	
/********************************************************************************************/
//	Fetch the actions
/********************************************************************************************/
	$actions = ($sectionid) ? cc('section', $sectionid)['greenbutton']->unfold() : null;
	
/********************************************************************************************/
//	Some filters
/********************************************************************************************/
	if ($handled_item)
	{
	//	Only for items with URLs
		if (!$handled_itemStructure->has_url())
		{
			/* TODO */
		}
	//	Can't set to the same status
		
	}
?>