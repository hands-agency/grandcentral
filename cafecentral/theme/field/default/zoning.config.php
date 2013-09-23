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
//	$_VIEW->bind('css', '/css/zoning.css');

/********************************************************************************************/
//	Make the form
/********************************************************************************************/
//	Get the section
	list($section, $id) = explode('_', $_POST['handled_section']);
	$section = cc('section', $id);
	
//	Get the app
	$app = cc('app', $section['template']['app']);

/********************************************************************************************/	
//	Create the new form if not already existing
/********************************************************************************************/	
	$form = new item_form('admin_section_popup');
	$form->set_fieldparam('data', 'value', $section['template']);
?>