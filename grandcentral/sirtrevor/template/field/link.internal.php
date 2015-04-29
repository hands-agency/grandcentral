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
//	item
	$item = $_POST['param']['item'];
	$p['order()'] = 'updated DESC';
//	Param
	
//	We have a query
	if ($_POST['q'])
	{
		$p['title'] = '%'.$_POST['q'].'%';
	}
//	No query
	else
	{
		$p['limit()'] = 15;
		$p['live'] = true;
		$p['system'] = false;
	}

/********************************************************************************************/
//	Get the items
/********************************************************************************************/
	$items = i($item, $p, 'site');
?>