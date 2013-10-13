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

/********************************************************************************************/
//	Fetch the structure
/********************************************************************************************/
	$structure = cc('structure', $handled_item, $handled_env);

/********************************************************************************************/
//	Fetch the bunch of items
/********************************************************************************************/
	$param['order()'] = 'title';
//	Order
	if (isset($_POST['filter'])) $param[$_POST['filter'].'()'] = $_POST['value'];
//	Refine ?
	if (isset($_POST['q'])) $param['title'] = '%'.$_POST['q'].'%';
//	Fetch the bunch
	$bunch = cc($handled_item, $param, $handled_env);
	
/********************************************************************************************/
//	Some prepross
/********************************************************************************************/
	foreach ($bunch as $item)
	{
	//	Ensure we have a title, otherwise use the ref
		if (empty($item['title'])) $item['title'] = (empty($item['title'])) ? $item->get_nickname() : $item['title'];
	//	Image preview TODO
		if (isset($structure['attr']['photo']))
		{
			
		}
	}

/********************************************************************************************/
//	Abstract
/********************************************************************************************/
	$abstract = $bunch->count().' '.$handled_item.' ordered by this, edited by him, displayed in stack';
	$abstract = null;
?>