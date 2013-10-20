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
 * @copyright	Copyright © 2004-2012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */	
/********************************************************************************************/
//	Bind
/********************************************************************************************/
	$_APP->bind_script('list/js/list.js');
	$_APP->bind_css('list/css/list.css');

/********************************************************************************************/
//	Fetch the section
/********************************************************************************************/
	$section = cc('section', $_POST['section']);
	$param = $section['app']['param'];

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Object
	if (!isset($_GET['item'])) trigger_error('You should have an Item by now', E_USER_WARNING);
	else $handled_item = $_GET['item'];

//	Falling from the sky
	$order = (isset($_POST['filter']) && $_POST['filter'] == 'order') ? $_POST['value'] : 'title';
	
/********************************************************************************************/
//	Some functions
/********************************************************************************************/
	switch ($order)
	{
		case 'title':
			function formatSeparator($val) {return strtoupper(substr($val, 0, 1));}
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
//	Order
	$param['order()'] = $order;
//	Refine ?
	if (isset($_POST['q'])) $param['title'] = '%'.$_POST['q'].'%';
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
	
	foreach ($bunch as $item)
	{
	//	Ensure we have a title, otherwise use the nickname
		if (empty($item['title'])) $item['title'] = (empty($item['title'])) ? $item->get_nickname() : $item['title'];
	
	}

/********************************************************************************************/
//	Abstract
/********************************************************************************************/
	$abstract = $bunch->count().' '.$handled_item.' ordered by this, edited by him, displayed in stack';
	$abstract = null;
?>