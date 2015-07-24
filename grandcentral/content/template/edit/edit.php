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
	require 'adminItemForm.class.php';

//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Item
	$handled_item = (isset($_GET['item'])) ? $_GET['item'] : null;
	$handled_id = (isset($_GET['id'])) ? $_GET['id'] : null;
	
/********************************************************************************************/
//	Some greenbuttons?
/********************************************************************************************/
	if (isset($_POST['greenbutton']))
	{
	//	Bind the style sheet
		$_APP->bind_css('master/snippet/greenbutton/css/greenbutton.context.css');
	//	Get the greenbuttons
		$greenbuttons = i('greenbutton', array('key' => $_POST['greenbutton']), 'admin');
	}
	
/********************************************************************************************/
//	Let's get to work
/********************************************************************************************/
//	Fetch item
	$item = i($handled_item, null, $handled_env);
	if ($handled_item && $handled_id)
	{
		$item->get(array
		(
			'id' => $handled_id,
			'status' => null,
		));
	}
//	You can prefill the form through _GET (&fill[title]=something&fill[system]=0...)
	if (isset($_GET['fill']))
	{
		foreach ($_GET['fill'] as $key => $value)
		{
			if (isset($item[$key])) $item[$key] = $value;
		}
	}
	
/********************************************************************************************/
//	One exception for the workflow
/********************************************************************************************/
	if ($handled_item == 'workflow' && $item->exists())
	{
	//	Create a new temporary item
		$tmp = i($item['item']->get(), null, $handled_env);
	//	Fetch the data from the workflow
		$item = $item['data']->get();
	}

/********************************************************************************************/
//	Build form
/********************************************************************************************/
	if (!empty($handled_item))
	{
	//	Skip some attr
		switch ($handled_item)
		{
			case 'page':
				//$skip = array('child', 'section');
				$skip = array();
				break;
			default:
				$skip = array();
				break;
		}
	//	Build
		$form = new adminItemForm($item, $skip);
	}
	else
	{
		$form = null;
	}
?>