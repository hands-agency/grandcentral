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
//	Test mail
/********************************************************************************************/
//	$mail = cc('mail', 1, 'admin');
//	$mail->send();

/********************************************************************************************/
//	Bind scripts & css files
/********************************************************************************************/
	$_VIEW->zone_filename('css', 'page.'.$_ITEM['key']);
	$_VIEW->zone_filename('script', 'page.'.$_ITEM['key']);

/********************************************************************************************/
//	General binding of scripts & css files
/********************************************************************************************/
//	jQuery
//	$_VIEW->bind('script', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
//	$_VIEW->bind('script', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js');
	$_VIEW->bind('script', '/js/jquery-1.8.2.min.js');
	$_VIEW->bind('script', '/js/jquery-ui-1.9.1.custom.min.js');
	
//	Reroot get in ajax
	$_VIEW->bind('script', 'var _GET = '.json_encode($_GET).';');
//	Constants
	$_VIEW->bind('script', "
		const ITEM = $('meta[property=\"cc:item\"]').attr('content');
		const ID = $('meta[property=\"cc:id\"]').attr('content');
		const SITE_URL = '".SITE_URL."';
		const ADMIN_URL = '".ADMIN_URL."';
		const ENV = $('body').data('env');
	");
	
/********************************************************************************************/
//	Local binding scripts & css files
/********************************************************************************************/
//	Script
	$_VIEW->bind('script', '/js/page.js');
//	css
	$_VIEW->bind('css', '/css/page.css');
	
/********************************************************************************************/
//	Apps
/********************************************************************************************/
	$_VIEW->bind_app('searchasyoutype');
	$_VIEW->bind_app('jquery.sse');
	$_VIEW->bind_app('font-awesome');
	
	echo new html('popup', 'default', 'popup');
	echo new html('itemcards', 'default', 'itemcards');
	echo new html('jquery.autoresize', 'default', 'autoresize');
	echo new html('jquery.mentionsInput', 'default', 'mentions');
	
	$html = new html('notification', 'default', 'eventstream');
	$_VIEW->bind('header', $html);
	
/********************************************************************************************/
//	Move structures around
/********************************************************************************************/
/*	$old = cc('structure', 'comment', 'admin');
	$new = cc('structure', 'comment', 'site');
	$new['attr'] = $old['attr'];
	$new['rel'] = $old['rel'];
//	$new->save();

/********************************************************************************************/
//	Meta
/********************************************************************************************/
	$_VIEW->bind_template('meta', '/inc/meta');
	
/********************************************************************************************/
//	Nav CC
/********************************************************************************************/
	$_VIEW->bind_template('navcc', '/inc/navcc');
	
/********************************************************************************************/
//	Header
/********************************************************************************************/
//	Header
	$_VIEW->bind_template('header', '/inc/header');
	$truc = '<div id="eventstream"><ul class="mine"></ul><ul class="everybodyelses"></ul></div>';
	$_VIEW->bind('header', $truc);
//	Green button
	$_VIEW->bind_template('header', '/inc/greenbutton/greenbutton');
	
/********************************************************************************************/
//	Tabs
/********************************************************************************************/
	$_VIEW->bind_template('tabs', '/inc/tabs');
	
/********************************************************************************************/
//	Content
/********************************************************************************************/
	$_VIEW->bind_template('content', '/inc/options');
//	Store the green button actions in the section
	$sections = $_ITEM->get_rel('section');
	foreach ($sections as $section)
	{
		$greenbuttonaction = $section->get_rel('greenbuttonaction');
		$section['greenbuttonaction'] = json_encode($greenbuttonaction);
	}
	
/********************************************************************************************/
//	Context
/********************************************************************************************/
//	Preview
	$_VIEW->bind_template('context', '/inc/preview');
//	Trashbin
	$_VIEW->bind_template('content', '/inc/trashbin/trashbin');
	
/********************************************************************************************/
//	Footer
/********************************************************************************************/
	$_VIEW->bind_template('footer', '/inc/footer');
?>