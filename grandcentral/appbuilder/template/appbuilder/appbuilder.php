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
	$_APP->bind_css('appbuilder/css/appbuilder.css');
	$_APP->bind_script('appbuilder/js/appbuilder.js');

/********************************************************************************************/
//	Get the form
/********************************************************************************************/
//	Fields
	
/*	$f['git'] = array(
		'key' => 'github',
		'label' => 'From GitHub repo',
		'type' => 'text',
		'placeholder' => 'Import from a GitHub repo',
	);
	*/
	
	$f['mumbo'] = array(
		'type' => 'fieldset',
		'title' => 'Some mumbo jumbo',
	);
	$f['key'] = array(
		'key' => 'key',
		'label' => 'Key',
		'type' => 'text',
		'placeholder' => 'A very short unique key',
	);
	$f['title'] = array(
		'key' => 'title',
		'label' => 'App title',
		'type' => 'text',
		'placeholder' => 'Give your app a catchy name',
	);
	$f['descr'] = array(
		'key' => 'descr',
		'label' => 'Description',
		'type' => 'text',
		'placeholder' => 'A one phrase description that defines your app',
	);
	$f['cover'] = array(
		'key' => 'cover',
		'label' => 'Cover',
		'type' => 'text', /* Cannot instantiate abstract class fieldUrl ??? */
		'placeholder' => 'The url of a cover image',
	);
	$f['intro'] = array(
		'key' => 'intro',
		'label' => 'Introduction',
		'type' => 'textarea',
		'placeholder' => 'A longer text about your app',
	);
	
	$f['credits'] = array(
		'type' => 'fieldset',
		'title' => 'Some credits',
	);
	$f['url'] = array(
		'key' => 'url',
		'label' => 'URL',
		'type' => 'array',
		'placeholder' => 'Send back to a url',
	);
	$f['v'] = array(
		'key' => 'v',
		'label' => 'Version',
		'type' => 'text',
		'placeholder' => 'Version',
	);
	$f['license'] = array(
		'key' => 'license',
		'label' => 'License',
		'type' => 'text',
		'placeholder' => 'License',
	);
	$f['author'] = array(
		'key' => 'author',
		'label' => 'Author(s)',
		'type' => 'array',
		'placeholder' => 'Author',
	);
	
	$f['dependencies'] = array(
		'type' => 'fieldset',
		'title' => 'Dependencies',
	);
	$f['gc'] = array(
		'key' => 'gc',
		'label' => 'Grand Central',
		'type' => 'text',
		'placeholder' => 'Grand Central version',
	);
	$f['php'] = array(
		'key' => 'php',
		'label' => 'PHP',
		'type' => 'text',
		'placeholder' => 'PHP version',
	);
	$f['mysql'] = array(
		'key' => 'mysql',
		'label' => 'MySQL',
		'type' => 'text',
		'placeholder' => 'MySQL version',
	);
	$f['app'] = array(
		'key' => 'app',
		'label' => 'Apps',
		'type' => 'array',
		'placeholder' => 'Apps',
	);
	
//	Build the form
	$form = i('form');
	$form['field'] = $f;
	$form['key'] = 'app';
	$form['template'] = 'default';
	$formAction = i('page', 'appbuilder.json', 'admin')['url'];
	$form->set_action($formAction);
?>