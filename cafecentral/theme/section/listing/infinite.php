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
	$_VIEW->bind_app('shapeshift');
	$_VIEW->bind('script', '/js/infinite.js');
	$_VIEW->bind('css', '/css/infinite.css');

/********************************************************************************************/
//	Fetch the section
/********************************************************************************************/
	$section = cc('section', $_POST['section']);

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Object
	$handled_item = $_GET['item'];

/********************************************************************************************/
//	Fetch the structure
/********************************************************************************************/
	$structure = cc('structure', $handled_item, $handled_env);
	
/********************************************************************************************/
//	Fetch the bunch of items
/********************************************************************************************/
	$param = array(
		'status' => $section['data']['status'],
	);
//	Order
	if (isset($_POST['filter'])) $param[$_POST['filter'].'()'] = $_POST['value'];
//	Refine ?
	if (isset($_POST['q'])) $param['title'] = '%'.$_POST['q'].'%';
//	Fetch the bunch
	$bunch = cc($handled_item, $param, $handled_env);
	
/********************************************************************************************/
//	Some prepross
/********************************************************************************************/
//	Ensure we have a title, otherwise use the ref
	foreach($bunch as $item) if (empty($item['title'])) $item['title'] = (empty($item['title'])) ? $item->get_ref() : $item['title'];

//	Image preview
	foreach ($bunch as $item)
	{
	//	TODO
		if (isset($structure['attr']['photo']))
		{
			$mediaAttr = 'photo';
		}
	}

/********************************************************************************************/
//	Abstract
/********************************************************************************************/
	$abstract = $bunch->count().' '.$handled_item.' ordered by this, edited by him, displayed in stack';
	$abstract = null;
?>