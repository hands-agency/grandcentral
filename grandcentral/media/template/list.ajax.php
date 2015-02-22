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
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_script('js/upload.js');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$maxPreviews = 3;
	$here = $_POST['root'];

/********************************************************************************************/
//	Save pref
/********************************************************************************************/
	$_SESSION['user']->set_pref('media', 'currentroot', $here);

/********************************************************************************************/
//	Make the Library
/********************************************************************************************/
	$gallery = new dir(SITE_ROOT.'/media'.$here);
	$gallery->get();
//	Order files by last uploaded
	$gallery->sortbydate();
	
	foreach ((array) $gallery->data as $value)
	{
	//	We split dirs and files
		if (is_a($value, 'dir')) $directories[] = $value; 
		else $files[] = media($value->get_root());
	}
?>