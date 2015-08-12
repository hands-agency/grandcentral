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
	$_APP->bind_css('master/css/nav.css');
	$_APP->bind_script('master/js/nav.js');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Profile pic
	$profilePic = $_SESSION['user']['profilepic'];
//	Site
	$siteTitle = i('site', current)['title'];
	$sitePic = i('site', current)['favicon'];
	
//	Item list
	$items = i('item', array('system' => false, 'hasurl' => true, 'order()' => 'title'), $_SESSION['pref']['handled_env']);
	$items->get('item', array('system' => false, 'hasurl' => false, 'order()' => 'title'), $_SESSION['pref']['handled_env']);
	$items->get('item', array('key' => array('section', 'const'), 'order()' => 'title'), $_SESSION['pref']['handled_env']);
//	Social list
	$socials = i('item', array('key' => array('human', 'machine', 'group'), 'order()' => 'inherit(key)'), 'site');
//	Help list
	$helps = i('page', array('key' => array('doc', 'lab'), 'order()' => 'inherit(key)'), 'admin');
//	Logs list
	$logs = i('page', array('key' => array('logout')), 'site');
	
//	List page
	$listPage = i('page', 'list', 'admin');
//	Edit page
	$editPage = i('page', 'edit', 'admin');
//	Apps page
	$appsPage = i('page', 'apps', 'admin');
?>