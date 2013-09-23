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
	$_VIEW->bind('script', '/js/navcc.js');
	$_VIEW->bind('css', '/css/navcc.css');

/********************************************************************************************/
//	Config
/********************************************************************************************/
//	Current env
	$env = cc($_SESSION['pref']['handled_env'], current);

//	Build nav
	$nav = array(
	//	User
		'me' => array(
			'title' => null,
			'descr' => null,
			'icon' => true,
			'flag' => false,
			'page' => 'list',
		//	Subnav
			'subnav' => array(),
		),
	//	Environment
		'env' => array(
			'title' => false,
			'descr' => false,
			'icon' => true,
			'flag' => false,
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'structure' =>  array(
					'display' => 'hive',
					'link' => 'list',
					'bunch' => cc('structure', array('key' => array('structure', 'page', 'version', 'site')), $_SESSION['pref']['handled_env']),
				),
				'support' =>  array(
					'display' => 'hive',
					'link' => 'list',
					'bunch' => cc('page', 'env', 'admin')->get_rel('child'),
				),
			),
		),
	//	Search
		'search' => array(
			'title' => null,
			'descr' => null,
			'icon' => false,
			'flag' => null,
			'page' => 'list',
		//	Subnav
			'subnav' => array(),
		),
	//	Items
		'item' => array(
			'title' => true,
			'descr' => true,
			'icon' => true,
			'flag' => false,
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'everyday' => array(
					'display' => 'hive',
					'link' => 'list',
					'bunch' => cc('structure', array('system' => false, 'order()' => 'title'), $_SESSION['pref']['handled_env']),
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
			'title' => true,
			'descr' => true,
			'icon' => true,
			'flag' => false,
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'social' => array(
					'display' => 'hive',
					'link' => 'list',
					'bunch' => cc('structure', array('key' => array('human', 'machine', 'group'), 'order()' => 'title'), 'site'),
				),
			),
		),
	//	Apps
		'app' => array(
			'title' => true,
			'descr' => true,
			'icon' => true,
			'flag' => false,
			'page' => 'edit',
		//	Subnav
			'subnav' => array(
				'general' => array(
					'display' => 'hive',
					'link' => 'edit',
					'bunch' => cc('app', array('order()' => 'title'), 'admin'),
				),
			),
		),
	);

/********************************************************************************************/
//	Get the list of level1 pages
/********************************************************************************************/
	foreach ($nav as $key => $value) $keys[] = $key;
	$p = array(
		'key' => $keys,
		'order()' => 'inherit(key)',
	);
	$level1 = cc('page', $p);
	
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