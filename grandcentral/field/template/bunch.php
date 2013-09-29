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
	$_VIEW->bind('css', '/css/bunch.css');
	$_VIEW->bind('script', '/js/bunch.js');
	
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
//	An index to be caught by jQuery in the field name
	$index = '__index__';
	
/********************************************************************************************/
//	Callbacks
/********************************************************************************************/
//	On add
	$_VIEW->bind('script', '$(\'li[data-type="bunch"]\').addable(
	{
	//	On add
		onAdd:function(field)
		{
			data = field.find("> .wrapper > .field > .data")
			li = data.find("li:last-child");
			count = data.children().length;
						
			li.find("input, select, textarea").each(function()
			{
				input = $(this);
				name = input.attr("name").replace("'.$index.'", count);
				input.attr("name", name);
			});
		
		}
	});');
	
/********************************************************************************************/
//	Set defaults
/********************************************************************************************/
//	List of available bunches
	$available = array('bunch');
	
//	Default field attributes
	$params[] = array(
		'name' => 'item',
		'type' => 'select',
		'label' => 'Item',
		'required' => true,
		'valuestype' => 'bunch',
		'values' => 'structure',
	);
	$params[] = array(
		'name' => 'property',
		'type' => 'array',
		'label' => 'Refine',
		'placeholder' => 'properties',
	);
		
/********************************************************************************************/
//	The list of add buttons
/********************************************************************************************/
	foreach ($available as $field) $addbuttons .= '<li><button type="button" data-type="'.$field.'">'.$field.'</button></li>';

/********************************************************************************************/
//	construction de la liste des relations reçues de la base
/********************************************************************************************/
	$values = $_ITEM->get_value();
	$i = 0;
	foreach ((array) $values as $key => $value)
	{
		$li = '';		
		foreach ($params as $param)
		{
		//	Field
			$class = 'field_'.$param['type'];
			$field = new $class($_ITEM->get_name().'['.$i.']['.$param['name'].']', $param);
			if (isset($value[$param['name']])) $field->set_value($value[$param['name']]);
		//	Label
			if ($field->get_label()) $label = '<label for="'.$field->get_name().'">'.$field->get_label().'</label>';
			else $label = null;
			$field->set_label('');
		//	Li
			$li .= '<li data-type="'.$field->get_type().'">'.$label.'<div class="wrapper">'.$field.'</div></li>';
		}
		$data .= '<li><ol>'.$li.'</ol><button type="button" class="delete"></button></li>';
		$i++;
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
		$field = new $class($_ITEM->get_name().'['.$index.']['.$param['name'].']', $param);
	//	Label
		if ($field->get_label()) $label = '<label for="'.$field->get_name().'">'.$field->get_label().'</label>';
		else $label = null;
		$field->set_label('');
	//	Li
		$li .= '<li data-type="'.$field->get_type().'">'.$label.'<div class="wrapper">'.$field.'</div></li>';
	}
	
//	We store them in jscript vars, so that the addable.js plugin can retrieve them
	$html = '<li style="display:none;"><ol>'.$li.'</ol><button type="button" class="delete"></li>';
	$template['bunch'] = $html;
?>
