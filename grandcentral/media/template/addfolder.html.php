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
	$path = ($_POST['path'][0] != '/') ? '/'.$_POST['path'] : $_POST['path'];
	if ($path == '/') $path = null;
	$dir = ($_POST['dir'][0] != '/') ? '/'.$_POST['dir'] : $_POST['dir'];
	
/********************************************************************************************/
//	Create a directory
/********************************************************************************************/
	if (!file_exists($path))
	{
		if (mkdir($root.$path.$dir, 0777, true)) echo substr($dir, 1);
		else echo 'ko';
	}
	else echo 'ko';
?>