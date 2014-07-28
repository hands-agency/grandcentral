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
 * @copyright	Copyright © 2004-2013, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Handled env
	$env = $_SESSION['pref']['handled_env'];
//	The field name
//	$name = $_POST['name'];
	$name = $env.'_section';
//	Refine values?
	$p['title'] = (isset($_POST['q'])) ? '%'.$_POST['q'].'%' : null;
	$p['order()'] = 'title ASC';

/********************************************************************************************/
//	Get and process from ajax
/********************************************************************************************/
//	Get the available values
	$available = i('section', $p, $env);
//	Refine
	if (isset($_POST['q']))
	{
		echo 'TODO refined with '.$_POST['q'];
	}
?>