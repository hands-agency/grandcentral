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
	// print '<pre>';print_r($_POST);print'</pre>';
	$value = json_decode(stripslashes($_POST['value']), true);
	// print '<pre>value';print_r($value);print'</pre>';
	$class = 'field_'.$_POST['type'];
	// print'<pre>';print_r($class);print'</pre>';
	$properties = $class::get_properties();
	// print '<pre>';print_r($properties);print'</pre>';
	
	$li = '';
	foreach ($properties as $key => $property)
	{
		unset($param);
		if (!is_array($property))
		{
			$param['type'] = $property;
		}
		else
		{
			$param = $property;
		}
		if (!isset($param['label']))
		{
			$param['label'] = $key;
		}
		if (isset($value[$key]))
		{
			$param['value'] = $value[$key];
		}
		if ($param['type'] == 'bool')
		{
			$param['labelbefore'] = true;
		}
		
		$class = 'field'.ucfirst($param['type']);
		$field = new $class($_POST['form'].'[param]['.$key.']', $param);
		$label = $field->get_label();
		$field->set_label('');
		$li .= '<li data-type="'.$field->get_type().'"><label for="'.$field->get_name().'">'.$label.'</label><div class="wrapper">'.$field.'</div></li>';
	}
	//print '<pre>';print_r($fields);print'</pre>';
?>