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
//    Creation de l'index
/********************************************************************************************/
	$full = new searchFulltext('full');
	$full->url = false;
	$full->notable = array('logbook');
	$full->save_index();
	
	$site = new searchFulltext('site');
	$full->url = true;
	$site->save_index();
?>