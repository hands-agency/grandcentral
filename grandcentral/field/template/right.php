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
//	GO
/********************************************************************************************/
	$attrs = $_APP->get_attr();
	
	$admin_structures = cc('structure', all, 'admin');
	// print '<pre>admin : ';print_r($admin_structures->get_attr('title'));print'</pre>';
	// print '<pre>';print_r($admin_rights->get_attr('title'));print'</pre>';
	$site_structures = cc('structure', all, 'site');
	// print '<pre>site : ';print_r($site_structures->get_attr('title'));print'</pre>';
	// print '<pre>';print_r($site_rights->get_attr('title'));print'</pre>';
	
	foreach ($admin_structures as $structure)
	{
		$items = cc($structure['key'], all, 'admin');
		foreach ($items as $item)
		{
			$matrix['admin'][$structure['key']][$item['id']] = (!empty($item['title'])) ? $item['title'] : $item['key'];
		}
	}
	
	foreach ($site_structures as $structure)
	{
		$items = cc($structure['key'], all, 'site');
		foreach ($items as $item)
		{
			$matrix['site'][$structure['key']][$item['id']] = (!empty($item['title'])) ? $item['title'] : $item['key'];
		}
	}
	
	// print '<pre>';print_r($matrix);print'</pre>';
?>