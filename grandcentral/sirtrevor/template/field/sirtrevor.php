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
	$_APP->bind_script('field/lib/js/underscore.js');
	$_APP->bind_script('field/lib/js/eventable.js');
	$_APP->bind_script('field/lib/js/sir-trevor.min.js');
	$_APP->bind_css('field/lib/css/sir-trevor.css');
	$_APP->bind_css('field/lib/css/sir-trevor-icons.css');
//	CSS & Scripts
	$_APP->bind_script('field/custom-blocks/break.js');
	$_APP->bind_script('field/custom-blocks/video.js');
	$_APP->bind_script('field/custom-blocks/ImageGc.js');
	$_APP->bind_script('field/custom-blocks/iframe.js');
	// $_APP->bind_script('field/custom-blocks/ImageCaption.js');
	$_APP->bind_css('field/custom-blocks/ImageGc.css');
	// $_APP->bind_script('field/custom-blocks/Code.js');
	// $_APP->bind_script('field/custom-blocks/gist.js');
	// $_APP->bind_script('field/custom-blocks/ordered-list.js');

	$_APP->bind_script('field/js/text-selection.js');
	$_APP->bind_script('field/js/sir-trevor-gc.js');
	$_APP->bind_css('field/css/sirtrevor.css');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
	$_FIELD = $_PARAM['field'];
	$value = $_FIELD->get_value();
	$attrs = $_FIELD->get_attrs();
?>
