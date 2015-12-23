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
	$_APP->bind_script('list/js/list.js');
	$_APP->bind_css('list/css/list.css');

/********************************************************************************************/
//	Some apps
/********************************************************************************************/
	load(
		'jquery.infinitescroll',
		'jquery.viewport',
	//	'jquery.adaptive-backgrounds',
		'color-thief',
		'jquery.imagesloaded'
	);

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Object
	$handled_item = (isset($_GET['item'])) ? $_GET['item'] : trigger_error('You should have an Item by now', E_USER_WARNING);
//	Item
	$item = i('item', $handled_item, $handled_env);

//	Reuse sent params
	if (isset($_POST['param'])) $_PARAM = $_POST['param'];
	else $_PARAM = array();
//	Refine
	if (isset($_POST['q'])) $_PARAM['param']['title'] = '%'.$_POST['q'].'%';
	// always
	$_PARAM['param']['status'] = array('live','asleep');
//	Amount of items to be displayed at one time
	$limit = 50;

//	Count
	$count = count::get($handled_item, $_PARAM, $handled_env);

//	Pref
	$pref_filter = isset($_POST['filter']) ? $_POST['filter'] : null;
	$pref_value = isset($_POST['value']) ? $_POST['value'] : null;

/********************************************************************************************/
//	Save pref
/********************************************************************************************/
	if ($pref_filter && $pref_value) $_SESSION['user']->set_pref('list', $handled_item, $pref_filter, $pref_value);
?>
