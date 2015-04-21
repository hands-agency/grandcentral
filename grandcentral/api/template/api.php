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
 * @author		Michaël V. Dandrieux <mvd@eranos.fr>
 * @copyright	Copyright ©2015 Hands
 * @license		http://grandcentral.fr/license MIT License
 * @access		public
 * @link		http://grandcentral.fr
 */
/********************************************************************************************/
//	Some security
/********************************************************************************************/
	if (!$_SESSION['user']->is_admin()) trigger_error('Sorry, admin only', E_USER_ERROR);

//	Debug
//	sentinel::debug(__FUNCTION__.' in '.__FILE__.' line '.__LINE__, $_PARAM['api']);
?>