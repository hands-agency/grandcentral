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
	$_APP->bind_file('css', 'css/zoning.css');
	$_APP->bind_file('script', 'js/multipleselect.js');
	$_APP->bind_file('script', 'js/zoning.js');
		
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Object
	$handled_item = $_GET['item'];
	$handled_id = $_GET['id'];
	
/********************************************************************************************/
//	?
/********************************************************************************************/
//	Fetch the zones
	$page = i('page', $handled_id, $handled_env);
	$html = new html($page, 'default', 'master');
	$zones = $html->get_zones();
		
//	Fetch the sections
	$sections = $page->get_rel('section');

//	Add the existing sections to the zones
	foreach ($sections as $section)
	{
		if (isset($zones[$section['zone']])) $zones[$section['zone']]['section'][] = $section;
	}
//	Show/hide Noda
	foreach ($zones as $key => $zone)
	{
		if (isset($zone['section'])) $zones[$key]['hideNodata'] = 'style="display:none;"';
		else $zones[$key]['hideNodata'] = null;
	}
//	DEBUG
#	sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $zones);

/********************************************************************************************/
//	Favourites items
/********************************************************************************************/
	$p = array(
		'key' => array('form'),
	);
	$favs = i('app', $p, 'admin');

/********************************************************************************************/
//	Sort of a repository of data for Ajax
/********************************************************************************************/
//	Name
	$param = array(
		'value' => 'zoning', /* todo */
		'disabled' => true,
		'cssclass' => 'name',
	);
	$name = new field_hidden(null, $param);
//	Values
	$param = array(
		'value' => htmlspecialchars(json_encode('app'), ENT_COMPAT),
		'disabled' => true,
		'cssclass' => 'values',
	);
	$values = new field_hidden(null, $param);
//	Valuestypes
	$param = array(
		'value' => 'bunch',
		'disabled' => true,
		'cssclass' => 'valuestype',
	);
	$valuestype = new field_hidden(null, $param);
?>