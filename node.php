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
//	The autoload takes care of starting the engine
/********************************************************************************************/
	require 'inc.autoload.php';
	
/********************************************************************************************/
//	Loading the sentinel
/********************************************************************************************/
	sentinel::getInstance();

/********************************************************************************************/
//	Loading the registry
/********************************************************************************************/
	registry::getInstance();
//	Store the events
	event::prepare();
	
	// $_POST['id'] = 1;
	// $cast = cc('cast', $_POST['id']);
	// print'<pre>';print_r($cast);print'</pre>';
	// $param = array(
	// 	'id' => 'test',
	// 	'class' => 'class',
	// 	'action' => 'test.routine.php',
	// 	'method' => 'get',
	// 	'enctype' => 'application/x-www-form-urlencoded',
	// 	'accept-charset' => 'utf-8'
	// );
	// $form = new form();
	// echo $form;
	// print '<pre>';print_r($form->get_attrs());print '</pre>';
	// exit;
	// $user = cc('human', 'sf@cafecentral.fr');
	// print'<pre>';print_r(form::get_declared_fields());print'</pre>';
	// print '<pre>';var_dump($user->is_valid_password('0gokrfo5'));print '</pre>';
	// print'<pre>';print_r($_POST);print'</pre>';
	// exit;
/********************************************************************************************/
//	Display
/********************************************************************************************/
	echo cc('page', current);

	// print'<pre>';print_r($fields);print'</pre>';
	// $id = $fields['id'];
	// $key = $fields['key'];
	// $title = $fields['title'];
	// $form = new form();
	// $form->set_field($id['type'], 'id', $id);
	// $form->set_field($key['type'], 'key', $key);
	// $form->set_field($title['type'], 'title', $title);
	// $form->set_field('hidden', 'test', null);
	// $form->set_fieldset();
	// $form->set_field($id['type'], 'type', $id);
	// $form->set_field('array', 'oui');
	// $form->set_field('button', null, array('type' => 'submit', 'value' => 'oui'));
	// // print'<pre>';print_r($form);print'</pre>';
	// print'<pre>';var_dump($form->is_valid());print'</pre>';
	
	// exit;
/********************************************************************************************/
//	Query debug
/********************************************************************************************/
/*	if (cc('page', current)->get_attr('key') != 'ajax')
	{
		foreach (database::$queries as $id => $query)
		{
			$color = ($query['base'] == 'site') ? '#DEDEDE' : '#FFF';
			print '<hr style="margin: 0"><div style="background:'.$color.';padding: 20px"><h1 style="margin: 0">'.($id + 1).'</h1>';
			print '<pre>base : '.$query['base'].' <br />query : '.$query['query'].' <br />count : '.count($query['data']).' <br />param : ';print_r($query['param']);print'</pre>';
			// $debug = $query['debug'][2];
			unset($trace);
			foreach ($query['debug'] as $debug)
			{
				if (!isset($debug['class'])) $debug['class'] = '';
				// if (!in_array($debug['class'], array('database')))
				// 			{
					if ($debug['function'] == 'include')
					{
						// print '<pre>';print_r($debug);print'</pre>';
						$debug['class'] = $debug['args'][0];
					}
					$trace[] = array(
						'from' => $debug['class'],
						'function' => $debug['function'],
						'line' => $debug['line']
					);
				
				// }
			}
			print '<pre><a href="http://" onclick="$(\'#backtrace'.$id.'\').toggle();return false;">Backtrace</a><div id="backtrace'.$id.'" style="display: none">';print_r($trace);print'</div></pre>';
			print '</div>';
		}
	}
*/
?>