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
	$_VIEW->bind('css', '/css/array.css');
	$_VIEW->bind('script', '/js/addable.js');
	$_VIEW->bind('script', '/js/array.js');
	$_VIEW->bind('script', '$(\'li[data-type="array"]\').addable();');
	
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
//	Liste des champs d'un bunch
/********************************************************************************************/
/*	$param_key = array(
		'placeholder' => 'Key',
	);
	$param_value = array(
		'placeholder' => 'Value',
	);

/********************************************************************************************/
//	construction du template du champ
/********************************************************************************************/
/*	$fieldTpl = '<li data-type="array"><div class="wrapper"><span class="field"><input type="text" placeholder="'.$param_key['placeholder'].'" /></span></div> ⇢ <div class="wrapper"><span class="field"><input type="text" placeholder="'.$param_value['placeholder'].'" /></span></div><button type="button" class="delete"></button></li>';

	$_VIEW->bind('script', 'var field_array = \''.$fieldTpl.'\';');
/********************************************************************************************/
//	Chargement des valeurs par défaut
/********************************************************************************************/
/*	$values = $_ITEM->get_value();
	$fieldDefault = '';
	foreach ((array) $values as $key => $value)
	{
		if (!empty($value)) $fieldDefault .= '<li data-type="array"><div class="wrapper"><span class="field"><input value="'.$key.'" type="text" placeholder="'.$param_key['placeholder'].'" /></span></div> ⇢ <div class="wrapper"><span class="field"><input type="text" name="'.$_ITEM->get_name().'['.$key.']'.'" value="'.$value.'" placeholder="'.$param_value['placeholder'].'" /></span></div><button type="button" class="delete"></button></li>';
	}
	
	
/********************************************************************************************/
//	Set defaults
/********************************************************************************************/
//	List of available rel
	$available = array('array');
	
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
	foreach ($available as $field) $addbuttons .= '<li><button type="button" data-type="'.$field.'">'.$field.'</button></li>';

/********************************************************************************************/
//	Print the data from the Database
/********************************************************************************************/
	$values = $_ITEM->get_value();
	foreach ((array) $values as $key => $value)
	{
		$li = '';
		foreach ($params as $param)
		{
		//	Field
			$class = 'field_'.$param['type'];
		//	Key and value fields are differents
			if (isset($param['customdata']['associative']))
			{
				$field = new $class(null, $param);
				$field->set_value($key);
			}
			else
			{
				$field = new $class($_ITEM->get_name().'['.$key.']', $param);
				$field->set_value($value);
			}
		//	Label
			$label = $field->get_label();
			$field->set_label('');
		//	Li
			$li .= '<li data-type="'.$field->get_type().'"><div class="wrapper">'.$field.'</div></li>';
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
	//	Field
		$class = 'field_'.$param['type'];	
	//	Key and value fields are differents
		if (isset($param['customdata']['associative'])) $field = new $class(null, $param);
		else $field = new $class($_ITEM->get_name().'[]', $param);
	//	Label
		$field->set_label('');
		$li .= '<li data-type="'.$field->get_type().'"><div class="wrapper">'.$field.'</div></li>';
	}
	
//	We store them in jscript vars, so that the addable.js plugin can retrieve them
	$html = '<li style="display:none;"><ol>'.$li.'</ol><button type="button" class="delete"></li>';
	$template['array'] = $html;
?>