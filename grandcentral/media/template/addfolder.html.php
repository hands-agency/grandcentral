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
//	Some vars
/********************************************************************************************/
	$media = new app('media');
	$root = SITE_ROOT.'/media';
	$path = $_POST['path'];
	
/********************************************************************************************/
//	Some functions
/********************************************************************************************/
	function sanitize($string = '', $is_filename = FALSE)
	{
		$string = preg_replace('/[^\w\-'. ($is_filename ? '~_\.' : ''). ']+/u', '-', $string);
		return mb_strtolower(preg_replace('/--+/u', '-', $string), 'UTF-8');
	}
	
/********************************************************************************************/
//	Sanitize the string
/********************************************************************************************/
	$path = sanitize($path);
	
/********************************************************************************************/
//	Create a directory
/********************************************************************************************/
	if (!file_exists($path))
	{
		if (mkdir($root.'/'.$path, 0777, true)) echo $path;
		else echo 'ko';
	}
	else echo 'ko';
?>