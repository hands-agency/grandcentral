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
//	We start from the form and the field
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
	
//	The form
	$form = i('form', $_POST['form'], $handled_env);
//	The field
	$field = $form['field'][$_POST['field']];
//	création du champ de test
	if (isset($_POST['value'])) $field['value'] = $_POST['value'];
	
	if (!empty($field['type']))
	{
		$class = 'field'.ucfirst($field['type']);
		$field = new $class($field['key'], $field);

/********************************************************************************************/
//	And now we validate
/********************************************************************************************/
		if ($field->is_valid()) $return = true;
		else $return = $field->get_error();
	}
	else
	{
		$return = '';
	}
//	Send back data in json
	// $return = array('required' => array('descr' => 'form : '.$class.' / field : '.$_POST['field'].' / value : '.$_POST['value'].''));
//	$return = 'true';
	echo json_encode($return, JSON_UNESCAPED_UNICODE);
?>