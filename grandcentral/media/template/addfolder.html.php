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
//	Some vars
/********************************************************************************************/
	$media = new app('media');
	$root = $media->get_templateroot('site');
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