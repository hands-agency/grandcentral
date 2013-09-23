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
//	Debug
/********************************************************************************************/
//	Fetch the form we're working on
	$form = cc('form', $_POST['form']);
	$fields = $form['field'];
//	The new order
	$fieldOrder = (array)$_POST['order'];

/********************************************************************************************/
//	Reorder !
/********************************************************************************************/
	$newFields = array();
	foreach ($fieldOrder as $key) $newFields[$key] = $fields[$key];
	$form['field'] = $newFields;
//	And save!
	$form->save();
//	TODO : exit to avoid going to the view (there's none...)
	exit;
?>