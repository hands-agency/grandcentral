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
	$_VIEW->bind('css', '/css/addable.css');
	$_VIEW->bind('css', '/css/attr.css');
	$_VIEW->bind('script', '/js/addable.js');
	$_VIEW->bind('script', '/js/attr.js');
	$_VIEW->bind('script', '$(\'li[data-type="attr"]\').addable();');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Hide or show the nodata
	$hideNodata = '';
//	The data from the DB
	$data = '';
//	The add buttons
	$addbuttons = '';
//	The html templates for jQuery
	$template = '';
	
/********************************************************************************************/
//	Set defaults
/********************************************************************************************/
//	List of available attr
	$available = array('int', 'string', 'decimal', 'bool', 'date', 'array');

//	Default field attributes for all fields	
	$params['key'] = array(
		'name' => 'key',
		'type' => 'text',
		'label' => 'Key',
		'max' => 32,
		'required' => true,
		'customdata' => array('associative' => 'attr'),
	);
	$params['type'] = array(
		'name' => 'type',
		'type' => 'text',
		'required' => true,
		'readonly' => true,
	);
	$params['title'] = array(
		'name' => 'title',
		'type' => 'text',
		'label' => 'Title',
		'max' => 255,
		'required' => true
	);
	$params['min'] = array(
		'name' => 'min',
		'type' => 'number',
		'label' => 'Min'
	);
	$params['max'] = array(
		'name' => 'max',
		'type' => 'number',
		'label' => 'Max'
	);
	$params['required'] = array(
		'name' => 'required',
		'type' => 'bool',
		'label' => 'Required',
		'labelbefore' => true
	);
	$params['index'] = array(
		'name' => 'index',
		'type' => 'select',
		'label' => 'Index',
		'valuestype' => 'array',
		'values' => array('index', 'unique', 'primary'),
		'placeholder' => '...'
	);

//	Set defaults now
	foreach ($available as $field) $fields[$field] = $params;
	
/********************************************************************************************/
//	Somes specifics, field by field
/********************************************************************************************/
//	Int
	$fields['int']['auto_increment'] = array(
		'name' => 'auto_increment',
		'type' => 'bool',
		'label' => 'Auto increment',
		'labelbefore' => true,
	);

//	Decimal
	$fields['decimal']['round'] = array(
		'name' => 'round',
		'type' => 'number',
		'label' => 'Round'
	);

//	Bool
	unset($fields['bool']['min'], $fields['bool']['max']);

//	Date
	unset($fields['date']['min'], $fields['date']['max'], $fields['date']['index']);
	$fields['date']['format'] = array(
		'name' => 'format',
		'type' => 'select',
		'label' => 'Format',
		'valuestype' => 'array',
		'values' => array('datetime', 'date')
	);
	
//	Array
	unset($fields['array']['min'], $fields['array']['max'], $fields['array']['index']);
		
/********************************************************************************************/
//	The list of add buttons
/********************************************************************************************/
	foreach ($available as $field) $addbuttons .= '<li><button type="button" data-type="'.$field.'">'.$field.'</button></li>';

/********************************************************************************************/
//	Print the data from the Database
/********************************************************************************************/
	$values = $_ITEM->get_value();
	foreach ((array) $values as $key => $value)
	{
		$li = '';
		$hideRows = '';
		foreach ($fields[$value['type']] as $param)
		{
		//	Field
			if ($param['name'] == 'key') unset($param['customdata']);
			$class = 'field_'.$param['type'];
			$field = new $class($_ITEM->get_name().'['.$key.']['.$param['name'].']', $param);
			if (isset($value[$param['name']])) $field->set_value($value[$param['name']]);
		//	Label
			if ($field->get_label()) $label = '<label for="'.$field->get_name().'">'.$field->get_label().'</label>';
			else $label = null;
			$field->set_label('');
		//	LI
			$li .= '<li data-type="'.$field->get_type().'" data-key="'.$param['name'].'" '.$hideRows.'>'.$label.'<div class="wrapper">'.$field.'</div></li>';
			if (empty($hideRows)) $hideRows = 'style="display:none;"';
		}
		
		$data .= '<li><ol>'.$li.'</ol><button type="button" class="delete"></button></li>';
	}
//	No data
	if ($values) $hideNodata = 'style="display:none;"';
	
/********************************************************************************************/
//	Now we can build the templates used when creating new fields
/********************************************************************************************/
//	It's a template, these fields MUST be disabled (appending will enable them)
	foreach ($fields as $name => $field)
	{
		foreach ($field as $key => $param) $fields[$name][$key]['disabled'] = true;
	}
	
	foreach ($fields as $key => $fieldtype)
	{
		$li = '';
		foreach ($fieldtype as $param)
		{
		//	Field
			if ($param['name'] == 'type') $param['value'] = $key;
			$class = 'field_'.$param['type'];
			$field = new $class($_ITEM->get_name().'[]['.$param['name'].']', $param);
		//	Label
			if ($field->get_label()) $label = '<label for="'.$field->get_name().'">'.$field->get_label().'</label>';
			else $label = null;
			$field->set_label('');
		//	Li
			$li .= '<li data-type="'.$field->get_type().'" data-key="'.$param['name'].'"><label for="'.$field->get_name().'">'.$label.'</label><div class="wrapper">'.$field.'</div></li>';
		}
	//	We store them in jscript vars, so that the addable.js plugin can retrieve them
		$html = '<li style="display:none;"><ol>'.$li.'</ol><button type="button" class="delete"></button></li>';
		$template[$key] = $html;
	}
?>