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
	$_APP->bind_script('js/nav.js');
	$_APP->bind_css('css/nav.css');

/********************************************************************************************/
//	Config
/********************************************************************************************/
//	Current env
	$env = cc($_SESSION['pref']['handled_env'], current);

//	Build nav
	$nav = array(
	//	User
		'me' => array(
			'title' => $_SESSION['user']['key'],
			'descr' => null,
			'icon' => 'http://placehold.it/50x50',
			'page' => 'list',
		//	Subnav
			'subnav' => '<input type="search" name="" placeholder="Search '.cc('site', current)['title'].' " />',
		),
	//	Environment
		'env' => array(
			'title' => cc('site', current)['title'],
			'icon' => '&#xe02f;',
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'structure' =>  array(
					'display' => 'big',
					'link' => 'list',
					'bunch' => cc('structure', array('key' => array('page', 'structure', 'version', 'site'), 'order()' => 'inherit(key)'), $_SESSION['pref']['handled_env']),
				),
				'support' =>  array(
					'display' => 'hive',
					'link' => 'list',
					'bunch' => cc('page', 'env', 'admin')['child']->unfold(),
				),
			),
		),
	//	Items
		'item' => array(
			'icon' => '&#xe01e;',
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'major' => array(
					'display' => 'hive',
					'link' => 'list',
					'bunch' => cc('structure', array('system' => false, 'hasurl' => true, 'order()' => 'title'), $_SESSION['pref']['handled_env']),
				),
				'minor' => array(
					'display' => 'hive',
					'link' => 'list',
					'bunch' => cc('structure', array('system' => false, 'hasurl' => false, 'order()' => 'title'), $_SESSION['pref']['handled_env']),
				),
				'system' => array(
					'display' => 'col',
					'link' => 'list',
					'bunch' => cc('structure', array('system' => true, 'order()' => 'title'), $_SESSION['pref']['handled_env']),
				),
			),
		),
	//	Social
		'social' => array(
			'icon' => '&#xe014;',
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'social' => array(
					'display' => 'big',
					'link' => 'list',
					'bunch' => cc('structure', array('key' => array('human', 'machine', 'group'), 'order()' => 'title'), 'site'),
				),
			),
		),
	//	Apps
		'app' => array(
			'icon' => '&#xe00e;',
			'page' => 'edit',
		//	Subnav
			'subnav' => array(),
		),
	);

/********************************************************************************************/
//	Get the list of level1 pages
/********************************************************************************************/
	foreach ($nav as $key => $value) $keys[] = $key;
	$level1 = cc('page', array
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