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
	$return = '';

/********************************************************************************************/
//	Change the live status of an item
/********************************************************************************************/
	if (isset($_POST['item']))
	{
	//	Some vars
		$item = i($_POST['item'], null, $_SESSION['pref']['handled_env']);
	//	Change live status
		//$item['live'] = $_POST['live']; /* #4.3 */
		$item['status'] = $_POST['status'];
		$item->save();
		$return = 'ok';
	}

/********************************************************************************************/
//	Trash a media
/********************************************************************************************/
	else if (isset($_POST['path']))
	{
		$return = media($_POST['path'])->delete() ? 'ok' : 'ko';
	}
?>