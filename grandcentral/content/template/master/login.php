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
//	General binding of scripts & css files
/********************************************************************************************/
//	jQuery
//	$_APP->bind_script('https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
//	$_APP->bind_script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js');
	$_APP->bind_script('master/js/jquery-1.10.2.min.js');
	$_APP->bind_script('master/js/jquery-ui-1.9.1.custom.min.js');

	// load('slick');
	
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
	// $_APP->bind_script('master/js/master.js');

/********************************************************************************************/
//	Local binding scripts & css files
/********************************************************************************************/
//	Script
	$_APP->bind_script('master/js/login.js');
//	css
	$_APP->bind_css('master/css/login.css');

/********************************************************************************************/
//	Meta
/********************************************************************************************/
//	$_APP->bind_template('meta', 'master/snippet/meta');
	
/********************************************************************************************/
//	Sections liées à la page
/********************************************************************************************/
	$_PARAM['page']->bind_section();
?>