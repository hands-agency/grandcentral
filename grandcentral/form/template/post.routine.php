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
//	Some vars
/********************************************************************************************/
	$_FORM = $_PARAM['form'];
	$_WORKFLOW = (isset($_PARAM['workflow'])) ? $_PARAM['workflow'] : null;

/********************************************************************************************/
//	Debug
/********************************************************************************************/
	// print'<pre>';print_r($_POST);print'</pre>';
	// print'<pre>';print_r($_FORM);print'</pre>';
	
/********************************************************************************************/
//	Insertion
/********************************************************************************************/
//	Forms for all sites (no _ in the name)
	if (!strstr($_FORM['key']->get(), '_'))
	{
		$table = $_FORM['key']->get();
		$env = 'site';
	}
//	Specific forms ([site]_[formkey])
	else
	{
		list($site, $table) = explode('_', $_FORM['key']);
		$env = 'admin' == $site ? 'admin' : 'site';
	}
	
	$id = (isset($_POST['id'])) ? $_POST['id'] : null;
	$i = i($table, $id, $env);
	
	foreach ($_POST as $key => $value)
	{
		$i[$key] = $value;
		if ('id' == $key)
		{
			$i[$key]->database_set($value);
		}
	}
	// print'<pre>';print_r($i);print'</pre>';
	
//	We enroll the item in the workflow, which will chose how to save it
	if ($env == 'site')
	{
		$workflow = i('workflow', null, $env);
		$workflow->grab($i, $_WORKFLOW);
		$workflow->save();
	}
	else $i->save();
	
//	Send back the id as a confirmation
	echo $i['id'];
?>