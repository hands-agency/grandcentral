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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('master/css/nav.css');
	$_APP->bind_script('master/js/nav.js');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Profile pic
	$profilePic = $_SESSION['user']['profilepic'];
//	Site pic
	$sitePic = i('site', current)['favicon'];
	
//	App list
	foreach (registry::get(registry::app_index) as $app)
	{
		$array = $app->get_ini()['about'];
		$array['key'] = $app->get_key();
		$apps[] = $array;
	}
//	Item list
	$items = i('item', array('system' => false, 'hasurl' => true, 'order()' => 'title'), $_SESSION['pref']['handled_env']);
	$items->get('item', array('system' => false, 'hasurl' => false, 'order()' => 'title'), $_SESSION['pref']['handled_env']);
	$items->get('item', array('key' => array('section', 'const', 'site'), 'order()' => 'title'), $_SESSION['pref']['handled_env']);
//	Social list
	$socials = i('item', array('key' => array('human', 'machine', 'group'), 'order()' => 'inherit(key)'), 'site');
//	Help list
	$helps = i('page', array('key' => array('doc', 'lab'), 'order()' => 'inherit(key)'), 'admin');
//	Logs list
	$logs = i('page', array('key' => array('logout'), 'order()' => 'inherit(key)'), 'site');
	
//	List page
	$listPage = i('page', 'list', 'admin');
//	App pate
	$appPage = i('page', 'app', 'admin');
?>