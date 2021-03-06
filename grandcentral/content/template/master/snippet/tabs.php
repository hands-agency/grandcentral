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
//	Some binds
/********************************************************************************************/
	$_APP->bind_script('master/js/tabs.js');
	$_APP->bind_css('master/css/tabs.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$page = i('page', current, 'admin');
	$sections = $page['section']->unfold();
	$handled_item = (isset($_GET['item'])) ? $_GET['item'] : null;

//	For the title
	$current = null;
	$back = null;
	$link = null;

/********************************************************************************************/
//	The title
/********************************************************************************************/
	switch (i('page', current, 'admin')['key'])
	{	
	//	Edit
		case 'edit':
			$structure = i('item', $_GET['item'], $_SESSION['pref']['handled_env']);
		//	We have an item already
			if (isset($_GET['id']))
			{
				$item = i($_GET['item'], $_GET['id'], $_SESSION['pref']['handled_env']);
				$link = $item->listing();
				$current = $item['title'];
			}
		//	New item
			else
			{
				$link = i($_GET['item'], null, $_SESSION['pref']['handled_env'])->listing();
				$current = new attrString('[So new i don\'t even have a title]');
			}
		//	Go
			$back = $structure['title'];
			break;
			
	//	List
		case 'list':
			$structure = i('item', $_GET['item'], $_SESSION['pref']['handled_env']);
			$item = i('page', 'home', 'admin');
			$link = $item['url'];
			$back = $item['title'];
			$current = $structure['title'];
			break;
			
	//	App
		case 'app':
			$app = app($_GET['app']);
			$ini = $app->get_ini();
			$page = i('page', 'app', 'admin');
			$link = $page['url'];
			$back = $page['title'];
			$current = new attrString($ini['about']['title']);
			break;
			
	//	Home
		case 'home':
			$item = i('page', 'home', 'admin');
			$link = 'javascript:openSite();';
			$back = i('site', current, 'admin')['title'];
			$current = i('page', current, 'admin')['title'];
			break;
		
		default:
			$item = i('page', 'home', 'admin');
			$link = $item['url'];
			$back = $item['title'];
			$current = i('page', current, 'admin')['title'];
			break;
	}
	
/********************************************************************************************/
//	Remove sections on the fly
/********************************************************************************************/
//	List
	$onlyfor['list'] = array(
		'tree' => array('page'),
		'edit' => array('page'),
	);
	$stripfrom['list'] = array(
		'live' => array('page'),
	);
	
//	Edit
	$onlyfor['edit'] = array(
		'zoning' => array('site', 'version', 'page'),
		'feed' => array('page'),
		'appconfig' => array('app'),
		'appini' => array('app'),
	);
	
//	Add and remove sections
	foreach ($sections as $section)
	{
		if (
		//	Some sections are only for some pages
			(isset($onlyfor[$page['key']->get()][$section['key']->get()]) && !in_array($handled_item, $onlyfor[$page['key']->get()][$section['key']->get()])) OR
		//	Some sections must be striped from some pages
			(isset($stripfrom[$page['key']->get()][$section['key']->get()]) && in_array($handled_item, $stripfrom[$page['key']->get()][$section['key']->get()]))
		) {
		//	Delete relation
			$i = array_search($section->get_nickname(), $page['section']->get());
			unset($sections[$i]);
		}
	}

/********************************************************************************************/
//	Fetch the altered sections
/********************************************************************************************/
//	Find the default section
	if (!$page['sectiondefault']->is_empty())
	{
		foreach ($page['sectiondefault']->unfold() as $key => $default)
		{
			foreach ($sections as $key => $section)
			{
				if ($section['key'] == $default['key'])
				{
					$defaultSection = $default['key'];
					break;
				}
			}
		}
	}
?>
