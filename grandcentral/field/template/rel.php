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
	$_APP->bind_css('css/addable.css');
	$_APP->bind_script('js/addable.js');
	$_VIEW->bind('script', '$(\'li[data-type="rel"]\').addable();');
	$_APP->bind_script('js/rel.js');
	
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
//	List of available rel
	$available = array('child');
	
//	Default field attributes for all fields
	$params[] = array(
		'name' => 'key',
		'type' => 'text',
		'label' => 'Key',
		'max' => 32,
		'required' => true,
		'customdata' => array('associative' => 'rel'),
	);
	// $params[] = array(
	// 		'name' => 'title',
	// 		'type' => 'text',
	// 		'label' => 'Title',
	// 		'max' => 255,
	// 		// 'required' => true
	// 	);
	$values = new bunch('structure', null, $_SESSION['pref']['handled_env']);
	foreach ($values as $table)
	{
		$tables[$table['key']] = $table['title'];
	}
	$params[] = array(
		'name' => 'item',
		'type' => 'bunch',
		'label' => 'Build your list of items',
	//	'valuestype' => 'array',
	//	'values' => $tables,
	//	'required' => true
	);
	$params[] = array(
		'name' => 'min',
		'type' => 'number',
		'label' => 'Minimum amount of relations'
	);
	$params[] = array(
		'name' => 'max',
		'type' => 'number',
		'label' => 'Maximum amount of relations'
	);
	$params[] = array(
		'name' => 'required',
		'type' => 'bool',
		'label' => 'Required',
		'labelbefore' => true
	);
		
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
		foreach ($params as $param)
		{
		//	Field
			$class = 'field'.ucfirst($param['type']);
			$field = new $class($_ITEM->get_name().'['.$key.']['.$param['name'].']', $param);
			if (isset($value[$param['name']])) $field->set_value($value[$param['name']]);
		//	Label
			if ($field->get_label()) $label = '<label for="'.$field->get_name().'">'.$field->get_label().'</label>';
			else $label = null;
			$field->set_label('');
		//	LI
			$li .= '<li data-type="'.$field->get_type().'" '.$hideRows.'>'.$label.'<div class="wrapper">'.$field.'</div></li>';
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
 	for ($i=0; $i < count($params); $i++) $params[$i]['disabled'] = true;
	$li = '';
	foreach ($params as $param)
	{
		$class = 'field'.ucfirst($param['type']);
		$field = new $class($_ITEM->get_name().'[]['.$param['name'].']', $param);
		$label = $field->get_label();
		$field->set_label('');
		$li .= '<li data-type="'.$field->get_type().'"><label for="'.$field->get_name().'">'.$label.'</label><div class="wrapper">'.$field.'</div></li>';
	}
	
//	We store them in jscript vars, so that the addable.js plugin can retrieve them
	$html = '<li style="display:none;"><ol>'.$li.'</ol><button type="button" class="delete"></li>';
	$template['child'] = $html;
?>