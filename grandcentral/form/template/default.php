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
	$_FORM = $_APP->param['form'];
	$asides = array();
	$asideFields = array('id', 'key',  'url', 'owner', 'created', 'updated', 'live', 'system', 'version', 'status');
	$mainFieldsets = '';
	$q = (isset($_POST['q'])) ? $_POST['q'] : null;

/********************************************************************************************/
//	Some binds
/********************************************************************************************/
	$_APP->bind_css('css/form.css');
	$_APP->bind_css('css/field.css');
	$_APP->bind_script('js/validate.plugin.js');
	$_APP->bind_script('js/form.js');
	$_APP->bind_script('js/item.js');
	$_APP->bind_code('script', '(function($) {$(\'section form\').validate();})(jQuery);');
?>
