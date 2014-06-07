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
	$_APP->bind_file('css', 'css/pagetype.css');
	$_APP->bind_file('script', 'js/pagetype.js');
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	For easier access
	$_FIELD = $_PARAM['field'];
//	The stores values
	$value = $_FIELD->get_value();
	$possibleFields = array('key', 'http_status', 'content_type', 'master', 'template', 'url');
//	List of the apps
	$apps = registry::get(registry::app_index);
	
/********************************************************************************************/
//	Prepare values
/********************************************************************************************/
	foreach ($possibleFields as $field) if (!isset($value[$field])) $value[$field] = null;
	
/********************************************************************************************/
//	Build the key field
/********************************************************************************************/
//	Name
	$name = $_FIELD->get_name().'[key]';
//	Values
	$values = array(
		'content' => 'Content page',
		'header' => 'Header',
		'link' => 'Just a link',
	);
//	field
	$p = array(
		'label' => 'Page type',
		'values' => $values,
		'value' => $value['key'],
		'valuestype' => 'array'
	);
	$fieldKey = new fieldRadio($name, $p);
	
/********************************************************************************************/
//	Build the url field
/********************************************************************************************/
//	Name
	$name = $_FIELD->get_name().'[url]';
//	Field
	$p = array(
		'label' => 'Link URL',
		'placeholder' => 'The link URL',
		'value' => $value['url'],
	);
	$fieldUrl = new fieldText($name, $p);
	
/********************************************************************************************/
//	Build the http_status field
/********************************************************************************************/
//	Name
	$name = $_FIELD->get_name().'[http_status]';
//	Values
	$values = array(
		'200 OK' => '200 OK',
		'301 Moved Permanently' => '301 Moved Permanently',
		'302 Moved Temporarily' => '302 Moved Temporarily',
		'404 Not Found' => '404 Not Found',
	);
//	field
	$p = array(
		'label' => 'HTTP Status',
		'values' => $values,
		'value' => $value['http_status'],
		'valuestype' => 'array'
	);
	$fieldHttpStatus = new fieldSelect($name, $p);
	
/********************************************************************************************/
//	Build the content_type field
/********************************************************************************************/
//	Name
	$name = $_FIELD->get_name().'[content_type]';
//	Values
	$values = array(
		'html' => 'HTML',
		'xml' => 'XML',
		'json' => 'JSON',
		'eventstream' => 'Event Stream',
		'jpg' => 'Jpeg image',
		'routine' => 'Routine',
	);
//	field
	$p = array(
		'label' => 'Content Type',
		'values' => $values,
		'value' => $value['content_type'],
		'valuestype' => 'array'
	);
	$fieldContentType = new fieldSelect($name, $p);
	
/********************************************************************************************/
//	Build the app field
/********************************************************************************************/
//	Name
	$name = $_FIELD->get_name().'[master]';
//	Values
	foreach ($apps as $app)
	{
		$about = $app->get_ini('about');
		$values[$app->get_key()] = $about['title'];
	}
	natcasesort($values);
//	Field
	$p = array(
		'label' => 'Master template',
		'placeholder' => '...',
		'value' => $value['master'],
	);
	$fieldMaster = new fieldApp($name, $p);
?>