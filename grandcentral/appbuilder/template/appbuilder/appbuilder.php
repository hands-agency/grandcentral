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
	
	$f['key'] = array(
		'key' => 'key',
		'label' => 'Key',
		'type' => 'text',
		'placeholder' => 'A very short unique key',
		'required' => true,
		'max' => 32,
	);
	
/*	$f['mumbo'] = array(
		'type' => 'fieldset',
		'title' => 'Some mumbo jumbo',
	);
*/
	$f['title'] = array(
		'key' => '[about][title]',
		'label' => 'App title',
		'type' => 'text',
		'placeholder' => 'Give your app a catchy name',
		'required' => true,
		'max' => 140,
	);
	$f['descr'] = array(
		'key' => '[about][descr]',
		'label' => 'Description',
		'type' => 'text',
		'placeholder' => 'A one phrase description that defines your app',
	);
	$f['cover'] = array(
		'key' => '[about][cover]',
		'label' => 'Cover',
		'type' => 'text', /* Cannot instantiate abstract class fieldUrl ??? */
		'placeholder' => 'The url of a cover image',
	);
	$f['intro'] = array(
		'key' => '[about][intro]',
		'label' => 'Introduction',
		'type' => 'textarea',
		'placeholder' => 'A longer text about your app',
	);
	
/*	$f['credits'] = array(
		'type' => 'fieldset',
		'title' => 'Some credits',
	);
*/
	$f['url'] = array(
		'key' => '[about][url]',
		'label' => 'URL',
		'type' => 'array',
		'placeholder' => 'Send back to a url',
	);
	$f['v'] = array(
		'key' => '[about][v]',
		'label' => 'Version',
		'type' => 'text',
		'placeholder' => 'Version',
		'value' => '1.0.0',
	);
	$f['license'] = array(
		'key' => '[about][license]',
		'label' => 'License',
		'type' => 'text',
		'placeholder' => 'License',
	);
	$f['author'] = array(
		'key' => '[about][author]',
		'label' => 'Author(s)',
		'type' => 'array',
		'placeholder' => 'Author',
		'value' => array('0' => $_SESSION['user']['title']),
	);
	
/*	$f['dependencies'] = array(
		'type' => 'fieldset',
		'title' => 'Requirements & Dependencies',
	);
*/
	$f['gc'] = array(
		'key' => '[requirements][gc]',
		'label' => 'Grand Central',
		'type' => 'text',
		'placeholder' => 'Grand Central version',
	);
	$f['php'] = array(
		'key' => '[requirements][php]',
		'label' => 'PHP',
		'type' => 'text',
		'placeholder' => 'PHP version',
		'value' => str_replace('_', '.', $_SERVER['PHP_VER']),
	);
	$f['mysql'] = array(
		'key' => '[requirements][mysql]',
		'label' => 'MySQL',
		'type' => 'text',
		'placeholder' => 'MySQL version',
	);
	$f['app'] = array(
		'key' => '[dependencies][app]',
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