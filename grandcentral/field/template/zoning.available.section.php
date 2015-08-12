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
//	Handled env
	$env = $_SESSION['pref']['handled_env'];
//	The field name
//	$name = $_POST['name'];
	$name = $env.'_page';
//	Refine values?
	$p['title'] = (isset($_POST['q'])) ? '%'.$_POST['q'].'%' : null;
	$p['order()'] = 'title ASC';

/********************************************************************************************/
//	Get and process from ajax
/********************************************************************************************/
//	Get the available values
	$sections = i('section', all, $env);
//	Refine
	if (isset($_POST['q']))
	{
		echo 'TODO refined with '.$_POST['q'];
	}
?>