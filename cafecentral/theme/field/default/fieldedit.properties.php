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
//	Some vars
/********************************************************************************************/
//	The form we are working on
	$form = cc('form', $_POST['form']);
//	The field type (text, textarea, select...)
	$field = 'field_'.$_POST['type'];
	$name = $_POST['form'].'[field]['.$_POST['field'].']';
//	The properties of the field
	$properties = $field::get_defined_properties();
	$propertiesValues = $form['field'][$_POST['field']];
	
/********************************************************************************************/
//	Build the form
/********************************************************************************************/
	$li = '';
	foreach ($properties as $key => $property)
	{
	//	???
		unset($param);
		if (!is_array($property))
		{
			$param['type'] = $property;
		}
		else
		{
			$param = $property;
		}
	//	Label
		if (!isset($param['label']))
		{
			$param['label'] = $key;
		}
	//	Current value for this property
		if (isset($propertiesValues[$key]))
		{
			$param['value'] = $propertiesValues[$key];
		}
		
		$class = 'field_'.$param['type'];
		$field = new $class($name.'['.$key.']', $param);
		$label = $field->get_label();
		$field->set_label('');
	//	Collapse
		$value = $field->get_value();
		$collapse = (empty($value) && $field->is_required() === false) ? 'class="collapse"' : null;
	//	The line
		$li .= '<li data-type="'.$field->get_type().'" '.$collapse.'><label for="'.$field->get_name().'">'.$label.'</label><div class="wrapper">'.$field.'</div></li>';
	}
	//print '<pre>';print_r($fields);print'</pre>';

/********************************************************************************************/
//	Can we try to reroute the data ?
/********************************************************************************************/
//	We will reroute the data if the current field has the same datatype as the new one
	$newDatatype = $field->get_datatype();
	$class = 'field_'.$_POST['currentType'];
	$currentField = new $class(null);
	$currentDatatype = $currentField->get_datatype();
//	Compare
	if ($currentDatatype == $newDatatype) $msg = 'Hurray, if you choose this field, we can save your data!';
 	else $msg = 'Dammit! These fields are too different, you will loose their data.';
?>