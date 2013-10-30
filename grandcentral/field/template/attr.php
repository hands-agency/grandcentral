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
	$_APP->bind_css('css/addable.css');
	$_APP->bind_css('css/attr.css');
	$_APP->bind_script('js/addable.js');
	$_APP->bind_script('js/attr.js');
	$_APP->bind_code('script', '<script type="text/javascript" charset="utf-8">$(\'li[data-type="attr"]\').addable();</script>');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	For easier access
	$_FIELD = $_PARAM['field'];
	
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
//	Get the list of available attr
	$available = registry::get_class('attr');
//	Get the properties for each attr
	foreach ($available as $attr) $fields[mb_substr(mb_strtolower($attr), 4)] = $attr::get_properties();
	// print'<pre>';print_r($fields);print'</pre>';
/********************************************************************************************/
//	The list of add buttons
/********************************************************************************************/
	foreach ($available as $field) $addbuttons .= '<li><button type="button" data-type="'.mb_substr(mb_strtolower($field), 4).'">'.mb_substr(mb_strtolower($field), 4).'</button></li>';

/********************************************************************************************/
//	Print the data from the Database
/********************************************************************************************/
	$values = $_FIELD->get_value();
	foreach ((array) $values as $key => $value)
	{
		$li = '';
		$hideRows = '';
		foreach ($fields[$value['type']] as $param)
		{
		//	Field
			$class = 'field'.ucfirst($param['type']);
			$field = new $class($_FIELD->get_name().'['.$key.']['.$param['name'].']', $param);
			if (isset($value[$param['name']])) $field->set_value($value[$param['name']]);
		//	LI
			$li .= '<li data-type="'.$field->get_type().'" data-key="'.$param['name'].'" '.$hideRows.'>'.$field.'</li>';
			if (empty($hideRows)) $hideRows = 'style="display:none;"';
		}
		
		$data .= '<li><ol>'.$li.'</ol><button type="button" class="delete"></button></li>';
	}
//	No data
	if ($values) $hideNodata = 'style="display:none;"';
	
/********************************************************************************************/
//	Now we can build the templates used when creating new fields
/********************************************************************************************/
//	It's a template, these fields MUST be disabled otherwise they get through the POST (appending will enable them, don't worry)
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
			$class = 'field'.ucfirst($param['type']);
			$field = new $class($_FIELD->get_name().'[]['.$param['name'].']', $param);
		//	Li
			$li .= '<li data-type="'.$field->get_type().'" data-key="'.$param['name'].'">'.$field.'</li>';
		}
	//	We store them in a <pre> tag, so that the addable.js plugin can retrieve them
		$html = '<li style="display:none;"><ol>'.$li.'</ol><button type="button" class="delete"></button></li>';
		$template[$key] = $html;
	}
?>