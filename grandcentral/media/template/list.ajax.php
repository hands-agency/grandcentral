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
//	Some binds
/********************************************************************************************/
	// $_APP->bind_script('js/upload.js');
	
/********************************************************************************************/
//	Some apps
/********************************************************************************************/
	load('jquery.masonry');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$maxPreviews = 3;
	$here = (isset($_POST['param']['root'])) ? $_POST['param']['root'] : $_POST['root']; /* Search as you type */

/********************************************************************************************/
//	Save pref
/********************************************************************************************/
	$_SESSION['user']->set_pref('media', 'currentroot', $here);

/********************************************************************************************/
//	Make the Library
/********************************************************************************************/
//	Get the content
	$gallery = new dir(SITE_ROOT.'/media/'.$here);
	$gallery->get();
	
//	Filter
	if (isset($_POST['q']) && !empty($_POST['q'])) $gallery->filter($_POST['q']);
	
//	Order files by last uploaded
	$gallery->sortbydate();
	
//	We split dirs and files
	foreach ((array) $gallery->data as $value)
	{
		if (is_a($value, 'dir')) $directories[] = $value; 
		else $files[] = media($value->get_root());
	}
?>