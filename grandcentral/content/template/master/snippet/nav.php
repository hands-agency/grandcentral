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
//	Build nav
	$nav = array(
	//	Content
		'item' => array(
			'title' => i('site', current)['title'],
			'icon' => '&#xe02f;',
			'page' => 'list',
		//	Subnav
			'subnav' => array(
				'structure' =>  array(
					'title' => 'er',
					'display' => 'label',
					'link' => 'list',
					'bunch' => i('structure', array('key' => array('page', 'structure', 'version'), 'order()' => 'inherit(key)'), $_SESSION['pref']['handled_env']),
				),
				'major' => array(
					'display' => 'masonry',
					'link' => 'list',
					'bunch' => i('structure', array('system' => false, 'hasurl' => true, 'order()' => 'title'), $_SESSION['pref']['handled_env']),
				),
				'minor' => array(
					'display' => 'bubble',
					'link' => 'list',
					'bunch' => i('structure', array('system' => false, 'hasurl' => false, 'order()' => 'title'), $_SESSION['pref']['handled_env']),
				),
				'system' => array(
					'display' => 'col',
					'link' => 'list',
					'bunch' => i('structure', array('system' => true, 'key' => array('!=human', '!=group', '!=version', '!=logbook', '!=structure', '!=page', '!=site'), 'order()' => 'title'), $_SESSION['pref']['handled_env']),
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
					'bunch' => i('structure', array('key' => array('human', 'machine', 'group'), 'order()' => 'inherit(key)'), 'site'),
				),
			),
		),
	//	Apps
		'app' => array(
			'icon' => '&#xe00e;',
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