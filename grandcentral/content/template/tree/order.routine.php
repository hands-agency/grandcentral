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