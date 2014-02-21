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
//	Reorder the sitetree
/********************************************************************************************/
//	Our new list of pages
	$sitetree = $_POST['sitetree'];

//	Loop through the pages
	foreach ($sitetree as $sitetree)
	{
		if (isset($sitetree['children']))
		{
		//	fetch the complete page
			list($item, $id) = explode('_', $sitetree['item']);
			$page = cc($item, $id, $_SESSION['pref']['handled_env']);
		//	Reset the children pages
			$page->set_rel('child', null);
		//	Add the new one by one
			foreach ($sitetree['children'] as $child)
			{
				$page->add_rel('child', $child);
			}
		//	Save
			$page->save();
		}
	}
//	TODO !!!
	exit;
?>