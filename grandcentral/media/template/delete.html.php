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
	if ($_SESSION['user']->is_admin())
	{
		$path = ($_POST['path'][0] != '/') ? '/'.$_POST['path'] : $_POST['path'];
		$media = media($path);
		if ($media->exists())
		{
			$media->delete();
			echo '1';
			exit;
		}
	}
	echo '0';
	exit;
?>
