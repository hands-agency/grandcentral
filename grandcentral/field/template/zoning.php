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
	
//	Name of the section field we are replacing
	$formName = constant(mb_strtoupper($handled_env).'_KEY').'_'.$handled_item;
	$fieldName = $formName.'[section]';
	
//	Iframe Link
	$iframe = i('page', 'iframe', 'admin');
	
//	Fetch the zones
	$page = i('page', $handled_id, $handled_env);
	$master = $page['type']['master'];
	$app = $master['app'];
	$template = $master['template'];
	if ($handled_env == 'admin') $template = '/template'.$template;
	$root = constant(strtoupper($handled_env.'_root')).'/'.$app.$template.'.html.php';
	$z = master::get_zones($root);

//	Separate in-zones and out-zones
	$outZones = array('meta', 'css', 'script');
	$zones = array('in' => array(), 'out' => array());
	foreach ($z as $key => $value)
	{
		if (in_array($key, $outZones)) $zones['out'][$key] = $value;
		else $zones['in'][$key] = $value;
	}
		
//	Fetch the sections
	$sections = $page['section']->unfold();
	
/********************************************************************************************/
//	Add the existing sections to the zones
/********************************************************************************************/
	foreach ($sections as $section)
	{
		foreach ($zones as $zoneType => $x)
		{
			if (isset($zones[$zoneType][$section['zone']->get()])) $zones[$zoneType][$section['zone']->get()]['section'][] = $section;
		}
	}

//	DEBUG
//	sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $zones);

/********************************************************************************************/
//	Sort of a repository of data for Ajax
/********************************************************************************************/
/*
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
	
/********************************************************************************************/
//	Sort of a repository of data for Ajax
/********************************************************************************************/
	$name = $fieldName;
	$values = '[{"item":"section"}]';
	$valuestype = 'bunch';
?>