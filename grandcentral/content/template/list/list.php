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
	$_APP->bind_file('script', 'list/js/list.js');
	$_APP->bind_file('css', 'list/css/list.css');
	
/********************************************************************************************/
//	Some apps
/********************************************************************************************/
	load('jquery.infinitescroll', 'jquery.viewport');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Object
	$handled_item = (isset($_GET['item'])) ? $_GET['item'] : trigger_error('You should have an Item by now', E_USER_WARNING);

//	Reuse sent params
	if (isset($_POST['param'])) $_PARAM = $_POST['param'];
//	Refine
	if (isset($_POST['q'])) $_PARAM['title'] = '%'.$_POST['q'].'%';
	
//	Amount of items to be displayed at one time
	$limit = 50;
	
//	Count
	$count = count::get($handled_item, $_PARAM, $handled_env);
?>