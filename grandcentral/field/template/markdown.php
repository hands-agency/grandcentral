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
	$_APP->bind_css('css/wysiwyg.css');
	$_APP->bind_script('js/wysiwyg/wysihtml5-0.3.0.min.js');
	$_APP->bind_script('js/wysiwyg/advanced.js');
	$_APP->bind_script('js/wysiwyg.js');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
//	$values = $_FIELD->prepare_values();
//	$placeholder = $_FIELD->get_placeholder();
	
//	$value = $_APP->get_value();
//	$attrs = $_APP->get_attr();
?>