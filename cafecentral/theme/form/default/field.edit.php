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
//	Go
/********************************************************************************************/
//	récupération du formulaire à transformer
	$source = new item_form($_POST['form']);
	
//	création du tableau des champs
	$fields = array(
		array(
			'type' => 'hidden',
			'key' => 'form',
			'value' => $_POST['form'],
			'required' => true
		),
		array(
			'type' => 'hidden',
			'key' => 'key',
			'value' => $_POST['field'],
			'required' => true
		),
		array(
			'type' => 'fieldedit',
			'key' => 'field',
			'value' => $source['field'][$_POST['field']]
		),
	/*	array(
			'type' => 'button',
			'key' => 'submit',
			'value' => 'save',
			'label' => 'edit',
			'buttontype' => 'submit'
		)
		*/
	);

/********************************************************************************************/
//	Print the data from the Database
/********************************************************************************************/
	$hidden = '';
	$li = '';
	foreach ($fields as $field)
	{
	//	Field
		$class = 'field_'.$field['type'];
		$field = new $class(null, $field);
	//	Label
		if ($field->get_label()) $label = '<label for="'.$field->get_name().'">'.$field->get_label().'</label>';
		else $label = null;
		$field->set_label('');
	//	LI
		if ($field->get_type() != 'hidden') $li .= '<li data-type="'.$field->get_type().'">'.$label.'<div class="wrapper">'.$field.'</div></li>';
		else $hidden .= $field;
	}
?>