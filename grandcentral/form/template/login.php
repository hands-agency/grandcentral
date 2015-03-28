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
//	Some vars
/********************************************************************************************/
	$_FORM = $_PARAM['form'];
	$profilepic = 'http://i.telegraph.co.uk/multimedia/archive/02467/newyork2_2467494b.jpg';

/********************************************************************************************/
//	Send the login to the site login target
/********************************************************************************************/
	$target = i('page', 'login.post', 'site');
	$_FORM->set_action($target['url']);
?> 