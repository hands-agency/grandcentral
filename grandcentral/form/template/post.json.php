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
		if ('id' == $key) $i[$key]->database_set($value);
	}
	// print'<pre>';print_r($i);print'</pre>';
	
//	We enroll the item in the workflow, which will chose how to save it	
	$workflow = i('workflow', null, $env);
	$workflow->enroll($i, $_WORKFLOW);
	$workflow->save();
	
//	Send back the original id or the workflow id
	$returnItem = ($workflow->is_inflow() === true) ? $workflow : $i;
	
//	Get the item in a array for return
	$daraArray = array();
	foreach ($returnItem as $key => $value) $daraArray[$key] = $value->get();

//	Build return array for json
	$return['meta'] = array(
		'item' => $returnItem->get_nickname(),
		'is_inflow' => $workflow->is_inflow(),
	);
	$return['data'] = $daraArray;
	
/********************************************************************************************/
//	Return json
/********************************************************************************************/
	echo json_encode($return);
?>