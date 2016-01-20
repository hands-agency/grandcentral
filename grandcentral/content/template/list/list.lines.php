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
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Object
	$handled_item = $_GET['item'];
//	Default order & sort
	$defaultOrder = 'updated';
	$defaultSort = 'DESC';

//	Falling from the sky
	$limit = (isset($_POST['limit'])) ? $_POST['limit'] : trigger_error('You should have a limit', E_USER_WARNING);
	$order = (isset($_SESSION['user']['pref']['list'][$handled_item]['order'])) ? $_SESSION['user']['pref']['list'][$handled_item]['order'] : $defaultOrder;
	$sort = (isset($_SESSION['user']['pref']['list'][$handled_item]['sort'])) ? $_SESSION['user']['pref']['list'][$handled_item]['sort'] : $defaultSort;

/********************************************************************************************/
//	Some functions
/********************************************************************************************/
	$attrOrder = registry::get($handled_env, registry::attr_index, $handled_item, 'attr', $order, 'type');
	switch ($attrOrder)
	{
		case 'id':
			function formatSeparator($val)
			{
				$h = (ceil($val->get()/100))*100;
				return ($h-100).' - '.($h-1);
			}
			break;
		case 'string':
			function formatSeparator($val) {return strtoupper(mb_substr($val, 0, 1));}
			break;
		case 'key':
			function formatSeparator($val) {return explode('_', $val)[0];}
			break;
		case 'date':
		case 'created':
		case 'updated':
			function formatSeparator($val) {return $val->format('l d F Y');}
			break;

		default:
			function formatSeparator($val) {return $val;}
			break;
	}

/********************************************************************************************/
//	Fetch the bunch of items
/********************************************************************************************/
//	Build the params
	$param = (isset($_POST['param']['param'])) ? $_POST['param']['param'] : null;
	$param['order()'] = $order.' '.$sort;
	$param['limit()'] = $limit;
//	Fetch the bunch
	$bunch = i($handled_item, $param, $handled_env);
//	Fetch the structure
	$item = i('item', $handled_item, $handled_env);

/********************************************************************************************/
//	Some prepross
/********************************************************************************************/
//	Find the first media attr
	$coverField = null;
	if ($bunch->count > 0)
	{
		foreach($bunch[0] as $attr)
		{
			if(is_a($attr, 'attrMedia'))
			{
				$coverField = $attr->get_key();
				break;
			}
		}
	}
?>
