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
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
	
/********************************************************************************************/
//	Some Data
/********************************************************************************************/
//	The form
	$form = i('form', $_POST['form'], $handled_env);

//	The field
	$field = $form['field'][$_POST['field']];
	
/********************************************************************************************/
//	Let's get to work
/********************************************************************************************/
//	création du champ de test
	if (isset($_POST['value'])) $field['value'] = $_POST['value'];
	
//	If we have a file type
	if (!empty($field['type']))
	{
		$class = 'field'.ucfirst($field['type']);
		$field = new $class($field['key'], $field);

	//	And now we validate
		if ($field->is_valid())
		{
			$return['meta'] = array(
				'status' => 'success',
			);
		}
		else
		{	
			$return['meta'] = array(
				'status' => 'fail',
				'msg' => 'I found some errors in this field',
			);
			$return['data'] = array(
				'error' => $field->get_error(),
			);
		}
	}
//	No file type...
	else
	{
	//	Try the required attr of the field
		if (isset($_POST['required']))
		{
			if ($field['value'])
			{
				$return['meta'] = array(
					'status' => 'success',
				);
			}
			else
			{	
				$return['meta'] = array(
					'status' => 'fail',
					'msg' => 'Field is required',
				);
			}
		}
	//	Nothing? Validated but suspicious
		else
		{
			$return['meta'] = array(
				'status' => 'success',
				'msg' => 'I\'m letting this go, as i can\'t find a type for your field',
			);
		}
	}
	
//	Send back data in json
	// $return = array('required' => array('descr' => 'form : '.$class.' / field : '.$_POST['field'].' / value : '.$_POST['value'].''));
//	$return = 'true';
	echo json_encode($return, JSON_UNESCAPED_UNICODE);
?>