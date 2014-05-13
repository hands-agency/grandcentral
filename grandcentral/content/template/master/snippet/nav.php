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
//	Some binds
/********************************************************************************************/
	$_APP->bind_file('script', 'master/js/nav.js');
	$_APP->bind_file('css', 'master/css/nav.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	App list
	foreach (registry::get(registry::app_index) as $app)
	{
		$array = $app->get_ini()['about'];
		$array['key'] = $app->get_key();
		$apps[] = $array;
	}
//	List page
	$listPage = i('page', 'list');
//	Edit page
	$editPage = i('page', 'edit');

/********************************************************************************************/
//	Config
/********************************************************************************************/
	$nav = array(
	//	Me
		'me' => array(
			'title' => $_SESSION['user']['title'],
			'image' => $_SESSION['user']['profilepic'][0]['url'],
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'digest' =>  array(
					'title' => 'er',
					'display' => 'big',
					'link' => 'page',
					'bunch' => i('page', array('key' => array('home'), 'order()' => 'inherit(key)'), 'admin'),
				),
				'byebye' =>  array(
					'title' => 'er',
					'display' => 'big',
					'link' => 'page',
					'bunch' => i('page', array('key' => array('logout.post'), 'order()' => 'inherit(key)'), 'site'),
				),
			),
		),
	//	Site
		'site' => array(
			'title' => i('site', current)['title'],
			'image' => i('site', current)['favicon'][0]['url'],
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'structure' =>  array(
					'title' => 'er',
					'display' => 'big',
					'link' => 'list',
					'bunch' => i('item', array('key' => array('page', 'item', 'site', 'version'), 'order()' => 'inherit(key)'), $_SESSION['pref']['handled_env']),
				),
				'play and fix' =>  array(
					'title' => 'er',
					'display' => 'big',
					'link' => 'page',
					'bunch' => i('page', array('key' => array('doc', 'lab'), 'order()' => 'inherit(key)'), 'admin'),
				),
			),
		),
	//	Content
		'content' => array(
			'title' => 'Content',
			'icon' => '&#xF150',
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'major' => array(
					'display' => 'tiles',
					'link' => 'list',
					'bunch' => i('item', array('system' => false, 'hasurl' => true, 'order()' => 'title'), $_SESSION['pref']['handled_env']),
				),
				'social' => array(
					'display' => 'big',
					'link' => 'list',
					'bunch' => i('item', array('key' => array('human', 'machine', 'group'), 'order()' => 'inherit(key)'), 'site'),
				),
				'minor' => array(
					'display' => 'tiles',
					'link' => 'list',
					'bunch' => i('item', array('system' => false, 'hasurl' => false, 'order()' => 'title'), $_SESSION['pref']['handled_env']),
				),
				'system' => array(
					'display' => 'col',
					'link' => 'list',
					'bunch' => i('item', array('system' => true, 'key' => array('!=human', '!=group', '!=version', '!=logbook', '!=item', '!=page', '!=site'), 'order()' => 'title'), $_SESSION['pref']['handled_env']),
				),
			),
		),
	//	Apps
		'app' => array(
			'icon' => '&#xF12D',
			'page' => 'edit',
		//	Subnav
			'subnav' => array(
				'apps' => array(
					'display' => 'tiles',
					'link' => i('page', 'app')['url'],
					'array' => $apps,
				),
			),
		),
	);

/********************************************************************************************/
//	Get the list of level1 pages
/********************************************************************************************/
	foreach ($nav as $key => $value) $keys[] = $key;
	$level1 = i('page', array
	(
		'key' => $keys,
		'order()' => 'inherit(key)',
	));
	
/********************************************************************************************/
//	Grab the Gravatar
/********************************************************************************************/
	$grabatar = null;
/*
	$email = 'mvd@eranos.fr';
	$hash = md5($email);
	$url = 'http://www.gravatar.com/'.$hash.'.php';
	$data = file_get_contents($url);
	$profile = unserialize($data);
	$grabatar = $profile['entry'][0];
*/
?>