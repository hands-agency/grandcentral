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
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some vars
/********************************************************************************************/	
	$li = '';
	$i = 0;
	$item = null;

/********************************************************************************************/
//	Build the options
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	$values = $_FIELD->prepare_values();
	// print'<pre>';print_r($values);print'</pre>';
	// TODO : colgroup

	if (is_array($values))
	{
		foreach ($values as $key => $option)
		{
			//	entête si plusieurs items
			if (isset($option['item']) && $option['item'] != $item)
			{
				$li .= '<li><h4>'.$option['item'].'</h4></li>';
				$option['item'] = $item;
			}
		//	checked
			$checked = (in_array($option['id'], (array) $_FIELD->get_value())) ? ' checked="checked"' : null;
		//	descr
			$descr = (isset($option['descr']) && !empty($option['descr'])) ? '<span class="descr">'.$option['descr'].'</span>' : null;
		//	<li>
			$li .= '
			<li>
				<input type="checkbox" value="'.$option['id'].'" name="'.$_FIELD->get_name().'[]" id="ID'.$_FIELD->get_name().$i.'"'.$checked.'/>
				<label for="ID'.$_FIELD->get_name().$i.'">
					<span class="title">'.$option['title'].'</span>
					'.$descr.'
				</label>
			</li>';
			$i++;
		}
	}
?>