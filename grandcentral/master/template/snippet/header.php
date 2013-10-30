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
//	Bind
/********************************************************************************************/
	$_APP->bind_file('css', 'css/header.css');
	$_APP->bind_file('script', 'js/header.js');

/********************************************************************************************/
//	The title
/********************************************************************************************/
	$current = null;
	$back = null;
	$link = null;
	
	switch (cc('page', current)['key'])
	{	
	//	Edit
		case 'edit':
			$structure = cc('structure', $_GET['item'], $_SESSION['pref']['handled_env']);
		//	We have an item already
			if (isset($_GET['id']))
			{
				$item = cc($_GET['item'], $_GET['id'], $_SESSION['pref']['handled_env']);
				$link = $item->listing();
				$current = $item['title'];
			}
		//	New item
			else
			{
				$link = cc($_GET['item'], null, $_SESSION['pref']['handled_env'])->listing();
				$current = new attrString('[So new i don\'t even have a title]');
			}
		//	Go
			$back = $structure['title'];
			break;
			
	//	List
		case 'list':
			$structure = cc('structure', $_GET['item'], $_SESSION['pref']['handled_env']);
			$item = cc('page', 'home');
			$link = $item['url'];
			$back = $item['title'];
			$current = $structure['title'];
			break;
			
	//	App
		case 'app':
			$app = new app($_GET['app']);
			$ini = $app->get_ini();
			$page = cc('page', 'app');
			$link = $page['url'];
			$back = $page['title'];
			$current = new attrString($ini['about']['title']);
			break;
			
	//	Home
		case 'home':
			$item = cc('page', 'home');
			$link = 'javascript:openSite();';
			$back = cc('site', current)['title'];
			$current = cc('page', current)['title'];
			break;
		
		default:
			$item = cc('page', 'home');
			$link = $item['url'];
			$back = $item['title'];
			$current = cc('page', current)['title'];
			break;
	}
?>