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
	$current = null;
	$back = null;
	$link = null;

//	Edit: we got an item
	if (isset($_GET['item']) && (isset($_GET['id'])))
	{
		$structure = cc('structure', $_GET['item'], $_SESSION['pref']['handled_env']);
		$item = cc($_GET['item'], $_GET['id'], $_SESSION['pref']['handled_env']);
		$link = $item->listing();
	//	Go
		$back = $structure['title'];
		$current = $item['title'];
	}
//	Listing : we got a structure
	else if (isset($_GET['item']))
	{
		$structure = cc('structure', $_GET['item'], $_SESSION['pref']['handled_env']);
		$item = cc('page', 'home');
		$link = $item['url'];
	//	Go
		$back = $item['title'];
		$current = $structure['title'];
	}
//	Listing : we got a structure
	else if (isset($_GET['app']))
	{
		$app = new app($_GET['app']);
		$ini = $app->get_ini();
		$page = cc('page', 'app');
		$link = $page['url'];
	//	Go
		$back = $page['title'];
		$current = $ini['about']['title'];
	}
//	Else, default page title
	else if (cc('page', current)['key'] == 'home')
	{
		$item = cc('page', 'home');
		$link = 'javascript:openSite();';
	//	Go
		$back = cc('site', current)['title'];
		$current = cc('page', current)->get_attr('title');
	}
//	Else, default page title
	else
	{
		$item = cc('page', 'home');
		$link = $item['url'];
	//	Go
		$back = $item['title'];
		$current = cc('page', current)->get_attr('title');
	}
?>