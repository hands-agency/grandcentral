<?
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
//	Update the properties of a field in a form
/********************************************************************************************/
//	The new properties of this field come from jQuery.serialize()
	$properties = array();
	parse_str($_POST['properties'], $properties);
//	Our formName and properties
	$formName = key($properties);
	$properties = $properties[$formName]['field'];
	
//	Fetch the form we want to edit
	$form = new item_form($formName);
	$form['field'] = array_merge($form['field'], $properties);
	$form->save();

/********************************************************************************************/
//	Update the html for this field now
/********************************************************************************************/
//	The current field, for control
	$class = 'field_'.$_POST['currentType'];
	$currentField = new $class(null);
	$currentDatatype = $currentField->get_datatype();
	
//	Create the new field
	$key = key($properties);
	$param = $properties[$key];
	$class = 'field_'.$param['type'];
	$field = new $class($formName.'['.$param['key'].']', $param);
	$datatype = $field->get_datatype();
	
//	Try to reroute the value that is in the field
	if ($currentDatatype == $datatype)
	{
		$value = array();
		parse_str($_POST['value'], $value);
		$value = $value[$formName][$key];
		$field->set_value($value);
	}
?>