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
//	Construction de la liste des radios
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	$values = $_FIELD->prepare_values();
	// TODO : colgroup
	
	$li = '';
	$i = 0;
	foreach ($values as $key => $option)
	{
	//	checked
		$checked = ($option['id'] == $_FIELD->get_value()) ? ' checked="checked"' : null;
	//	descr
		$descr = (isset($option['descr']) && !empty($option['descr'])) ? '<span class="descr">'.htmlspecialchars($option['descr']).'</span>' : null;
	//	<li>
		$li .= '
		<li>
			<input type="radio" value="'.htmlspecialchars($option['id']).'" name="'.$_FIELD->get_name().'" id="ID'.$_FIELD->get_name().$i.'"'.$checked.'/>
			<label for="ID'.$_FIELD->get_name().$i.'">
				<span class="title">'.htmlspecialchars($option['title']).'</span>
				'.$descr.'
			</label>
		</li>';
		$i++;
	}
?>