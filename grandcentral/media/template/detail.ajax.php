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
//	Make the detail
/********************************************************************************************/
	$file = media($_POST['root']);
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