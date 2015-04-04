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
//	$_APP->bind_css('css/zoning.css');
//	$_APP->bind_script('js/multipleselect.js');

/********************************************************************************************/
//	Make the form
/********************************************************************************************/
//	Get the section
//	list($app, $id) = explode('_', $_POST['handled_app']);
//	$section = i('section', $id);
	
//	Get the app
	$section = i('section', 'live');
	
//	Fetch the section
	$p = array(
		'value' => $section['app'],
	);
	$appField = new field_app('temp', $p);
?>