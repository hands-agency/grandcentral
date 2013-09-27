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
	$_APP->bind_script('js/tabs.js');
	$_APP->bind_css('css/tabs.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$page = cc('page', current);
	if (isset($_GET['item'])) $handled_item = $_GET['item'];

/********************************************************************************************/
//	Fetch the original sections
/********************************************************************************************/
	$sections = $page['section'];
	
/********************************************************************************************/
//	Remove sections on the fly
/********************************************************************************************/
//	List
	$onlyfor['list'] = array(
		'treemap' => array('page'),
	);
	$stripfrom['list'] = array(
		'live' => array('page'),
	);
	
//	Edit
	$onlyfor['edit'] = array(
		'zoning' => array('site', 'version', 'page'),
		'feed' => array('page'),
		'appconfig' => array('app'),
		'appini' => array('app'),
	);
	
//	Add and remove sections
	foreach ($sections as $section)
	{
		if (
		//	Some sections are only for some pages
			(isset($onlyfor[$page['key']][$section['key']]) && !in_array($handled_item, $onlyfor[$page['key']][$section['key']])) OR
		//	Some sections must be striped from some pages
			(isset($stripfrom[$page['key']][$section['key']]) && in_array($handled_item, $stripfrom[$page['key']][$section['key']]))
		) {
			$page->delete_rel($section->get_nickname());
		}
	}

/********************************************************************************************/
//	Fetch the altered sections
/********************************************************************************************/
	$sections = $page['section']->unfold();
	
//	Find the default section
	if ($defaults = $page['sectiondefault'])
	{
		foreach ($defaults as $key => $default)
		{
			foreach ($sections as $key => $section)
			{
				if ($section['key'] == $default['key'])
				{
					$defaultSection = $default['key'];
					break;
				}
			}
		}
	}
?>
