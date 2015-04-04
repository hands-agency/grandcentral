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
//	The field name & idz
	$name = $_POST['param']['name'];
	$values = $_POST['param']['values'];
	$valuestype = $_POST['param']['valuestype'];
//	Refine values?
	$refine = (isset($_POST['q'])) ? $_POST['q'] : null;
	
/********************************************************************************************/
//	Get and process from ajax
/********************************************************************************************/
//	Create a blank field (tweak)
	$param = array(
		'values' => $values,
		'valuestype' => $valuestype,
	);
	$multipleselect = new fieldMultipleselect(null, $param);
	
//	Get the available values
	$available = $multipleselect->prepare_values($refine);
?>