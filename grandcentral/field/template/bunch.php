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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@hands.agency>
 * @copyright	Copyright © 2004-2015, Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
//	$_APP->bind_css('css/bunch.css');
	// $_APP->bind_script('js/bunch.js');

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
	$template = array();
//	An index to be caught by jQuery in the field name
	$index = '__index__';

/********************************************************************************************/
//	Callbacks
/********************************************************************************************/
//	On add
	$_APP->bind_code('script', '
		$(\'li[data-type="bunch"]\').addable(
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
		});
	');

/********************************************************************************************/
//	Set defaults
/********************************************************************************************/
//	List of available bunches
	$available = array('bunch');

	$items = i('item', all, $_SESSION['pref']['handled_env']);
	// $items = i($_POST['table'], all);
	// $s[''] = '...';
	$values = array();
	foreach ($items as $structure)
	{
		$values[$structure['key']->get()] = $structure['title']->get();
	}
	// print'<pre>';print_r($values);print'</pre>';
//	Default field attributes
	$params[] = array(
		'name' => 'item',
		'type' => 'select',
		'label' => 'Item',
		'required' => true,
		'valuestype' => 'array',
		'values' => $values
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
	$values = $_FIELD->get_value();
	$i = 0;
	foreach ((array) $values as $key => $value)
	{
		$li = '';
		foreach ($params as $param)
		{
		//	Field
			$class = 'field'.ucfirst($param['type']);
			$field = new $class($_FIELD->get_name().'['.$i.']['.$param['name'].']', $param);
			if (isset($value[$param['name']])) $field->set_value($value[$param['name']]);
		//	Li
			$li .= '<li data-type="'.$field->get_type().'">'.$field.'</li>';
		}
		$data .= '<li><ol>'.$li.'</ol><button type="button" class="delete"></button></li>';
		$i++;
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
		$field = new $class($_FIELD->get_name().'['.$index.']['.$param['name'].']', $param);
	//	Li
		$li .= '<li data-type="'.$field->get_type().'">'.$field.'</li>';
	}

//	We store them in jscript vars, so that the addable.js plugin can retrieve them
	$html = '<li style="display:none;"><ol>'.$li.'</ol><button type="button" class="delete"></li>';
	$template['bunch'] = $html;
?>
