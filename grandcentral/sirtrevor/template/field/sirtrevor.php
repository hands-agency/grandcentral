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
 * @author		Michaël V. Dandrieux <@mvdandrieux>
 * @author		Sylvain Frigui <sf@cafecentral.fr>
 * @copyright	Copyright © 2004-2013, Grand Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some binds
/********************************************************************************************/
//	CSS & Scripts
	$_APP->bind_script('field/custom-blocks/break.js');
	$_APP->bind_script('field/custom-blocks/video.js');
	$_APP->bind_script('field/custom-blocks/ImageGc.js');
	// $_APP->bind_script('field/custom-blocks/ImageCaption.js');
	$_APP->bind_css('field/custom-blocks/ImageGc.css');
	
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