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
	$_APP->bind_css('css/zoning.css');
	$_APP->bind_script('js/multipleselect.plugin.js');
	$_APP->bind_script('js/zoning.js');
		
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	For easier access
	$_FIELD = $_PARAM['field'];
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
//	Object
	$handled_item = $_GET['item'];
	$handled_id = $_GET['id'];
	
//	Name of the field
	$fieldName = constant(mb_strtoupper($handled_env).'_KEY').'_'.$handled_item.'[section]';
	
//	Fetch the zones
	$page = i('page', $handled_id, $handled_env);
	$master = $page['type']['master'];
	$app = $master['app'];
	$template = $master['template'];
	$root = SITE_ROOT.'/'.$app.$template.'.html.php';
	$zones = master::get_zones($root);
//	TODO Zones that are out of the zoning
	$outZones = array('css', 'script');
		
//	Fetch the sections
	$sections = $page['section']->unfold();
	
/********************************************************************************************/
//	Add the existing sections to the zones
/********************************************************************************************/
	foreach ($sections as $section)
	{
		if (isset($zones[$section['zone']->get()])) $zones[$section['zone']->get()]['section'][] = $section;
	}

//	DEBUG
//	sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $zones);

/********************************************************************************************/
//	Sort of a repository of data for Ajax
/********************************************************************************************/
//	Name
	$param = array(
		'value' => 'zoning',
		'disabled' => true,
		'cssclass' => 'name',
	);
	$name = new fieldHidden(null, $param);
//	Values
	$param = array(
		'value' => htmlspecialchars(json_encode('app'), ENT_COMPAT),
		'disabled' => true,
		'cssclass' => 'values',
	);
	$values = new fieldHidden(null, $param);
//	Valuestypes
	$param = array(
		'value' => 'bunch',
		'disabled' => true,
		'cssclass' => 'valuestype',
	);
	$valuestype = new fieldHidden(null, $param);
?>