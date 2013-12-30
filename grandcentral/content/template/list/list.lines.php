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
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Object
	$handled_item = $_GET['item'];
//	Default order
	$defaultOrder = 'updated';

//	Falling from the sky
	$limit = (isset($_POST['limit'])) ? $_POST['limit'] : trigger_error('You should have a limit', E_USER_WARNING);
	$order = (isset($_POST['filter']) && $_POST['filter'] == 'order') ? $_POST['value'] : $defaultOrder;

/********************************************************************************************/
//	Some functions
/********************************************************************************************/
	switch ($order)
	{
		case 'title':
			function formatSeparator($val) {return strtoupper(mb_substr($val, 0, 1));}
			break;
		case 'key':
			function formatSeparator($val) {return explode('_', $val)[0];}
			break;
		case 'created':
		case 'updated':
			function formatSeparator($val) {return $val->format('d m Y');}
			break;
		
		default:
			function formatSeparator($val) {return $val;}
			break;
	}

/********************************************************************************************/
//	Fetch the bunch of items
/********************************************************************************************/
//	Build the params
	$param = (isset($_POST['param'])) ? $_POST['param'] : null;
	$param['order()'] = $order;
	$param['limit()'] = $limit;

//	Fetch the bunch
	$bunch = cc($handled_item, $param, $handled_env);
	
/********************************************************************************************/
//	Some prepross
/********************************************************************************************/
//	Find the first media attr
	$iconField = null;
	if ($bunch->count > 0)
	{
		foreach($bunch[0] as $attr)
		{
			if(is_a($attr, 'attrMedia'))
			{
				$iconField = $attr->get_key();
				break;
			}
		}
	}

//	Some preprocessing
	foreach ($bunch as $item)
	{
	//	Ensure we have a title, otherwise use the nickname
		if (empty($item['title'])) $item['title'] = (empty($item['title'])) ? $item->get_nickname() : $item['title'];
	}
?>