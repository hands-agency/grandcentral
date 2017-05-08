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
	$_APP->bind_file('css', 'css/addable.css');
	$_APP->bind_file('script', 'js/casting.js');
	$_APP->bind_file('css', 'css/casting.css');
	$_APP->bind_code('script', '$(\'li[data-type="casting"]\').addable();');

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
	$template = array();

/********************************************************************************************/
//	Set defaults
/********************************************************************************************/
	// List of available rel
	$available = array('casting');

	// Default field attributes for all fields
	$params[] = array(
		'type' => 'i18n',
		'field' => 'fieldText',
		'placeholder' => 'Fonction',
		'max' => 64,
		'customdata' => array('associative' => 'casting'),
		'name' => 'role'
	);

	//	liste des artistes
	$artists = array();
	foreach (i('artist', all, 'site') as $artist)
	{
		$artists[] = $artist['title']->get().' ['.$artist['id']->get().']';
	}
	$params[] = array(
		'type' => 'text',
		'placeholder' => 'Value',
		'datalist' => $artists,
		'name' => 'artist'
	);

/********************************************************************************************/
//	The list of add buttons
/********************************************************************************************/
	foreach ($available as $field) $addbuttons .= '<li><button type="button" data-type="'.$field.'" data-feathericon="&#xe114">'.$field.'</button></li>';

/********************************************************************************************/
//	Print the data from the Database
/********************************************************************************************/
	$values = $_FIELD->get_value();
	// print'<pre>';print_r($values);print'</pre>';
	foreach ((array) $values as $key => $value)
	{
		// print'<pre>'.$key.' : ';print_r($value);print'</pre>';
		$li = '';
		foreach ($params as $param)
		{
		//	Field
			$class = 'field'.ucfirst($param['type']);
		//	Key and value fields are differents
			$field = new $class($_FIELD->get_name().'['.$key.']['.$param['name'].']', $param);
			$field->set_value($value[$param['name']]);
		//	Label
			// $label = $field->get_label();
			$field->set_label($param['name']);
		//	Li
			$li .= '<li data-type="'.$field->get_type().'">'.$field.'</li>';
		}
		$data .= '<li><span class="handle" data-feathericon="&#xe026"></span><ol>'.$li.'</ol><button type="button" class="delete"></button></li>';
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
		$class = 'field'.ucfirst($param['type']);
	//	Key and value fields are differents
		// if (isset($param['customdata']['associative'])) $field = new $class($_FIELD->get_name().'[][role]', $param);
		$field = new $class($_FIELD->get_name().'[]['.$param['name'].']', $param);
	//	Label
		$field->set_label($param['name']);
		$field->set_disabled(true);
		$li .= '<li data-type="'.$field->get_type().'">'.$field.'</li>';
	}

//	We store them in jscript vars, so that the addable.js plugin can retrieve them
	$html = '<li style="display:none;"><span class="handle" data-feathericon="&#xe026"></span><ol>'.$li.'</ol><button type="button" class="delete"></li>';
	$template['casting'] = $html;
?>
