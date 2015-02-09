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
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('css/addable.css');
	$_APP->bind_css('css/array.css');
	$_APP->bind_script('js/addable.js');
	$_APP->bind_script('js/array.js');
	$_APP->bind_code('script', '$(\'li[data-type="array"]\').addable();');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	For easier access
	$_FIELD = $_PARAM['field'];

//	The data from the DB
	$data = '';
//	The add buttons
	$addbuttons = '';
//	The html templates for jQuery
	$template = '';
	
/********************************************************************************************/
//	Nasty hack : if multidimentional array, display a textarea
/********************************************************************************************/
	if (!function_exists('countdim')) {
		function countdim($array)
		{
		    if (is_array(reset($array))) return countdim(reset($array)) + 1;
		    else return 1;
		}
	}
	if (countdim((array)$_FIELD->get_value()) > 1) $hackToTextarea = true;
	else {

/********************************************************************************************/
//	Set defaults
/********************************************************************************************/
//	List of available rel
	$available = array('line');
	
//	Default field attributes for all fields
	$params[] = array(
		'type' => 'text',
		'placeholder' => 'Key',
		'max' => 32,
		'customdata' => array('associative' => 'array'),
	);
	$params[] = array(
		'type' => 'text',
		'placeholder' => 'Value',
	);
		
/********************************************************************************************/
//	The list of add buttons
/********************************************************************************************/
	foreach ($available as $field) $addbuttons .= '<li><button type="button" data-type="'.$field.'" data-feathericon="&#xe114">'.$field.'</button></li>';

/********************************************************************************************/
//	Print the data from the Database
/********************************************************************************************/
	$values = $_FIELD->get_value();
	foreach ((array) $values as $key => $value)
	{
		$li = '';
		foreach ($params as $param)
		{
		//	Field
			$class = 'field'.ucfirst($param['type']);
		//	Key and value fields are differents
			if (isset($param['customdata']['associative']))
			{
				$field = new $class(null, $param);
				$field->set_value($key);
			}
			else
			{
				$field = new $class($_FIELD->get_name().'['.$key.']', $param);
				$field->set_value($value);
			}
		//	Label
			$label = $field->get_label();
			$field->set_label('');
		//	Li
			$li .= '<li data-type="'.$field->get_type().'">'.$field.'</li>';
		}
		$data .= '<li><ol>'.$li.'</ol><button type="button" class="delete"></button></li>';
	}

/********************************************************************************************/
//	Now we can build the templates used when creating new fields
/********************************************************************************************/
//	It's a template, these fields MUST be disabled (appending will enable them)
 	for ($i=0; $i < count($params); $i++) $params[$i]['disabled'] = true;
	$li = '';
	foreach ($params as $param)
	{
	//	Field
		$class = 'field'.ucfirst($param['type']);	
	//	Key and value fields are differents
		if (isset($param['customdata']['associative'])) $field = new $class(null, $param);
		else $field = new $class($_FIELD->get_name().'[]', $param);
	//	Label
		$field->set_label('');
		$li .= '<li data-type="'.$field->get_type().'">'.$field.'</li>';
	}
	
//	We store them in jscript vars, so that the addable.js plugin can retrieve them
	$html = '<li style="display:none;"><ol>'.$li.'</ol><button type="button" class="delete"></li>';
	$template['line'] = $html;
	
	} /* end Nasty Hack */
?>