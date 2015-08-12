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
	$_APP->bind_css('appini/css/appini.css');
	$_APP->bind_script('appini/js/appini.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$skipAbout = array('title', 'descr', 'intro', 'cover');
	
/********************************************************************************************/
//	Get stuff
/********************************************************************************************/
//	App ini
	$app = app($_GET['app']);
	$ini = $app->get_ini();
	
//	Template list
	$templates = $app->get_templates();
	
//	The doc
	$doc = app('content', 'doc/code', array('app' => $app->get_key()));
?>
