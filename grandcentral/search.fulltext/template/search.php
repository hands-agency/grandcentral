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
 * @package        The package
 * @author        Michaël V. Dandrieux <@mvdandrieux>
 * @author        Sylvain Frigui <sf@hands.agency>
 * @copyright    Copyright © 2004-2012, Grand Central
 * @license        http://www.cafecentral.fr/fr/licences GNU Public License
 * @access        public
 * @link        http://www.cafecentral.fr/fr/wiki
 */
/********************************************************************************************/
//    Some binds scripts & css files
/********************************************************************************************/
	$search = new searchFulltext('full');
	$r = $search->query($_GET['q']);
	print'<pre>';print_r($r);print'</pre>';
	
	$search = new searchFulltext('site');
	$r = $search->query($_GET['q']);
	print'<pre>';print_r($r);print'</pre>';
?>