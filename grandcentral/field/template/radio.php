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
//	
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	$values = $_FIELD->prepare_values();
	// TODO : colgroup
	
	$li = '';
	$attrs = '';
	$l = '';
	print'<pre>';print_r($values);print'</pre>';
	foreach ($values as $key => $option)
	{
		print'<pre>';print_r($option['id']);print'</pre>';
		$checked = (in_array($option['id'], (array) $values)) ? ' checked="checked"' : '';
		$class = (!empty($checked)) ? $class = 'class="on"' : '';
	//	Other attributes
		foreach ($_FIELD->get_attrs() as $key => $value)
		{
		//	Change id and name
			if ($key == 'id')
			{
				$value .= $option['id'];
				$l = $value;
			}
			if ($key == 'name') $value .= '[]';
			$attrs .= ' '.$key.'="'.$value.'"';
		}
	//	descr
		$descr = (isset($option['descr']) && !empty($option['descr'])) ? '<span class="descr">'.htmlspecialchars($option['descr']).'</span>' : null;
	//	<li>
		$li .= '
		<li '.$class.'>
			<input type="radio" value="'.htmlspecialchars($option['id']).'"'.$attrs.$checked.'/>
			<label for="'.$l.'">
				<span class="title">'.htmlspecialchars($option['title']).'</span>
				'.$descr.'
			</label>
		</li>';
	}
	
	
	function fieldRadioOption($VALUE, $param)
	{
		$attrs = '';
		//	Is checked?
		$checked = (in_array($param['id'], (array)$VALUE)) ? ' checked="checked"' : '';
		$class = (!empty($checked)) ? $class = 'class="on"' : '';
		//	Other attributes
			foreach ($this->attrs as $key => $value)
			{
			//	Change id and name
				if ($key == 'id')
				{
					$value .= $param['id'];
					$l = $value;
				}
				if ($key == 'name') $value .= '[]';
				$attrs .= ' '.$key.'="'.$value.'"';
			}
		//	descr
			$descr = (isset($param['descr']) && !empty($param['descr'])) ? '<span class="descr">'.htmlspecialchars($param['descr']).'</span>' : null;
		//	<li>
			$li = '
			<li '.$class.'>
				<input type="radio" value="'.htmlspecialchars($param['id']).'"'.$attrs.$checked.'/>
				<label for="'.$l.'">
					<span class="title">'.htmlspecialchars($param['title']).'</span>
					'.$descr.'
				</label>
			</li>';
		return $li;
	}
?>