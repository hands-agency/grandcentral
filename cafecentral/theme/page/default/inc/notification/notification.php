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
 * @copyright	Copyright © 2004-2012, Café Central
 * @license		http://www.cafecentral.fr/fr/licences GNU Public License
 * @access		public
 * @link		http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//	Bind
/********************************************************************************************/
	$_VIEW->bind('script', '/inc/notification/js/notification.js');
	$_VIEW->bind('css', '/inc/notification/css/notification.css');

/********************************************************************************************/
//	Bla bla bla
/********************************************************************************************/
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
//	Generate random number for demonstration
	$count = rand(0, 10);
//	Go
	echo 'data: ';
	for ($i=0; $i < $count; $i++) echo '<li><a href="en">Jean-Paul Sartre</a> a ajouté <a href="en">Un long titre pour...</a>.</li>';
?>