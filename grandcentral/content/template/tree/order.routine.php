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
//	Reorder the tree
/********************************************************************************************/
//	Our new list of pages
	$tree = $_POST['tree'];

//	Loop through the branches of pages
	foreach ($tree as $branch)
	{
		if (isset($branch['children']))
		{
		//	fetch the complete page
			$page = i($branch['item'], null, $_SESSION['pref']['handled_env']);
		//	Check if the children have changed
			if ($page['child']->get() != $branch['children'])
			{
			//	Assign new children
				$page['child']->set($branch['children']);
			//	Save
				$page->save();
			}
		}
	}
//	TODO !!!
	exit;
?>