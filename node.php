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
//	The autoload takes care of starting the engine
/********************************************************************************************/
	require 'inc.autoload.php';
	
/********************************************************************************************/
//	Loading the sentinel
/********************************************************************************************/
	sentinel::getInstance();

/********************************************************************************************/
//	Loading the registry
/********************************************************************************************/
	registry::getInstance();

/********************************************************************************************/
//	Loading the master
/********************************************************************************************/
	// master::getInstance();
	
	$m = media('common/cluster_2.png');
	print'<pre>';print_r($m);print'</pre>';
	echo $m->thumbnail(24, 24);
?>