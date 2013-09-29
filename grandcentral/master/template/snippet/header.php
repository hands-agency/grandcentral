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
	$_APP->bind_css('css/header.css');
	$_APP->bind_script('js/header.js');

/********************************************************************************************/
//	The title
/********************************************************************************************/
	$item = null;
	$title = null;
	$icon = null;
	$h1_nav = '<a class="nav">☰</a>';

//	Edit: we got an item
	if (isset($_GET['item']) && (isset($_GET['id'])))
	{
		$structure = cc('structure', $_GET['item'], $_SESSION['pref']['handled_env']);
	//	if (isset($structure['icon'])) $icon = '<i class="icon-'.$structure['icon'].'"></i>';
		$item = cc($_GET['item'], $_GET['id'], $_SESSION['pref']['handled_env']);
	//	Go
		$h1_structure = null;
		$h1_item = '<a href="'.$item->listing().'" class="item">'.$icon.' '.$item['title'].'</a>';
	}
//	Listing : we got a structure
	else if (isset($_GET['item']))
	{
		$structure = cc('structure', $_GET['item'], $_SESSION['pref']['handled_env']);
	//	if (isset($structure['icon'])) $icon = '<i class="icon-'.$structure['icon'].'"></i>';
	//	Go
		$h1_structure = '<a href="'.ADMIN_URL.'" class="structure">'.$icon.$structure['title'].'</a>';
		$h1_item = null;
	}
//	Else, default page title
	else
	{
	//	Go
		$h1_structure = '<a href="'.ADMIN_URL.'" class="structure">'.cc('page', current)->get_attr('title').'</a>';
		$h1_item = null;
	}
	
//	Concaténer
	$h1 = $h1_nav.' '.$h1_structure.' '.$h1_item;
?>