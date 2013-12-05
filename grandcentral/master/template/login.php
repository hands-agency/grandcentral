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
//	General binding of scripts & css files
/********************************************************************************************/
//	jQuery
//	$_APP->bind_file('script', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
//	$_APP->bind_file('script', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js');
	$_APP->bind_file('script', 'js/jquery-1.10.2.min.js');
	$_APP->bind_file('script', 'js/jquery-ui-1.9.1.custom.min.js');
	
//	Constants
	$_APP->bind_code('script', "
		const SITE_URL = '".SITE_URL."';
		const ADMIN_URL = '".ADMIN_URL."';
		const CURRENTEDITED_URL = '';
	");
	
/********************************************************************************************/
//	Local binding scripts & css files
/********************************************************************************************/
//	Script
	$_APP->bind_file('script', 'js/master.js');
//	css
	$_APP->bind_file('css', 'css/master.css');

/********************************************************************************************/
//	Local binding scripts & css files
/********************************************************************************************/
//	Script
	$_APP->bind_file('script', 'js/login.js');
//	css
	$_APP->bind_file('css', 'css/login.css');

/********************************************************************************************/
//	Meta
/********************************************************************************************/
//	$_APP->bind_template('meta', '/snippet/meta');
	
/********************************************************************************************/
//	Sections liées à la page
/********************************************************************************************/
	$_PARAM['page']->bind_section();
?>