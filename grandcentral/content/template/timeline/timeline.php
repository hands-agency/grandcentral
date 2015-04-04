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
	$_APP->bind_script('timeline/js/timeline.js');
	$_APP->bind_css('timeline/css/timeline.css');
	
/********************************************************************************************/
//	Some apps
/********************************************************************************************/
	load('jquery.infinitescroll', 'jquery.viewport');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
	$handled_item = isset($_GET['item']) ? $_GET['item'] : null;
	$handled_id = isset($_GET['id']) ? $_GET['id'] : null;

//	Reuse sent params
	if (isset($_POST['param'])) $_PARAM = $_POST['param'];
//	Refine
	if (isset($_POST['q'])) $_PARAM['title'] = '%'.$_POST['q'].'%';
	
//	Amount of items to be displayed at one time
	$limit = 300;

//	Pref
	$pref_filter = isset($_POST['filter']) ? $_POST['filter'] : null;
	$pref_value = isset($_POST['value']) ? $_POST['value'] : null;
	
/********************************************************************************************/
//	Save pref
/********************************************************************************************/
	if ($pref_filter && $pref_value) $_SESSION['user']->set_pref('timeline', $handled_item, $pref_filter, $pref_value);
?>