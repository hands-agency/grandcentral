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
	$_APP->bind_file('script', 'js/tabs.js');
	$_APP->bind_file('css', 'css/tabs.css');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$page = cc('page', current);
	$handled_item = (isset($_GET['item'])) ? $_GET['item'] : null;

/********************************************************************************************/
//	Fetch the original sections
/********************************************************************************************/
	$sections = $page['section']->unfold();
	
/********************************************************************************************/
//	Remove sections on the fly
/********************************************************************************************/
//	List
	$onlyfor['list'] = array(
		'tree' => array('page'),
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
			(isset($onlyfor[$page['key']->get()][$section['key']->get()]) && !in_array($handled_item, $onlyfor[$page['key']->get()][$section['key']->get()])) OR
		//	Some sections must be striped from some pages
			(isset($stripfrom[$page['key']->get()][$section['key']->get()]) && in_array($handled_item, $stripfrom[$page['key']->get()][$section['key']->get()]))
		) {
		//	Delete relation
			$i = array_search($section->get_nickname(), $page['section']->get());
			unset($sections[$i]);
		}
	}

/********************************************************************************************/
//	Fetch the altered sections
/********************************************************************************************/
//	Find the default section
	if (!$page['sectiondefault']->is_empty())
	{
		foreach ($page['sectiondefault']->unfold() as $key => $default)
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
