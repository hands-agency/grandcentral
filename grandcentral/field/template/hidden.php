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
 * @copyright	Copyright © 2004-2012, Grand Central
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */

/********************************************************************************************/
//	Routine
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	
	if (!function_exists('crymeahidden'))
	{
		function crymeahidden($name, $value, $return = array())
		{
			if (!is_array($value))
			{
				$return[$name] = $value;
			}
			else
			{
				foreach ($value as $k => $v)
				{
					$return = crymeahidden($name.'['.$k.']', $v, $return);
				}
			}
			return $return;
		}
	}
	
	$hiddens = crymeahidden($_FIELD->get_name(), $_FIELD->get_value());
?>