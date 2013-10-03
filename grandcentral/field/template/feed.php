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
	$_APP->bind_css('css/feed.css');
	$_APP->bind_script('js/multipleselect.js');
	$_APP->bind_script('js/feed.js');
		
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Object
	$handled_item = $_GET['item'];
	$handled_id = $_GET['id'];
	
	$selectedList = array();
	$hideNodataList = null;
	
	$selectedDetail = array();
	$hideNodataDetail = null;

/********************************************************************************************/
//	Sort of a repository of data for Ajax
/********************************************************************************************/
//	Name
	$param = array(
		'value' => 'feed', /* todo */
		'disabled' => true,
		'cssclass' => 'name',
	);
	$name = new field_hidden(null, $param);
//	Values
	$param = array(
		'value' => json_encode('app'),
		'disabled' => true,
		'cssclass' => 'values',
	);
	$values = new field_hidden(null, $param);
//	Valuestypes
	$param = array(
		'value' => 'array',
		'disabled' => true,
		'cssclass' => 'valuestype',
	);
	$valuestype = new field_hidden(null, $param);
?>