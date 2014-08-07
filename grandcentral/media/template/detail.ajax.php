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
//	Make the detail
/********************************************************************************************/
	$file = media(stripslashes($_POST['root']));
	// print '<pre>';print_r($file);print'</pre>';
	$key = $file->get_key();
//	$root = $file->get_root();
	$url = $file->get_url();
	$path = null;
	$type = $file->get_mime();
	$size = $file->get_size();
	$created = $file->get_created();
	$updated = $file->get_updated();
	if (is_a($file, 'image'))
	{
		$thumbnail = $file->thumbnail(400, 600);
		$dimensions['width'] = $file->get_width();
		$dimensions['height'] = $file->get_height();
	}
?>