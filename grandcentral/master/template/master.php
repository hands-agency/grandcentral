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
//	Vars
/********************************************************************************************/
	$_PAGE = $_PARAM['page'];

/********************************************************************************************/
//	Test mail
/********************************************************************************************/
//	$mail = cc('mail', 1, 'admin');
//	$mail->send();

/********************************************************************************************/
//	General binding of scripts & css files
/********************************************************************************************/
//	jQuery
//	$_APP->bind_script('https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
//	$_APP->bind_script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js');
	$_APP->bind_script('js/jquery-1.8.2.min.js');
	$_APP->bind_script('js/jquery-ui-1.9.1.custom.min.js');
	
//	Reroot get in ajax
	$_APP->bind_code("script", "
	<script type='text/javascript' charset='utf-8'>
	//	Some vars
		var _GET = ".json_encode($_GET).";
	//	Some consts
		const ITEM = $('meta[property=\"cc:item\"]').attr('content');
		const ID = $('meta[property=\"cc:id\"]').attr('content');
		const SITE_URL = '".SITE_URL."';
		const ADMIN_URL = '".ADMIN_URL."';
		const ENV = $('body').data('env');
	</script>
	");
	
/********************************************************************************************/
//	Local binding scripts & css files
/********************************************************************************************/
//	Script
	$_APP->bind_script('js/master.js');
//	css
	$_APP->bind_css('css/master.css');
	
/********************************************************************************************/
//	Apps
/********************************************************************************************/
//	Progressive search
	$app = new app('searchasyoutype');
	$app->load();
//	Server-Side Events
	$app = new app('jquery.sse');
	$app->load();
	
	
/*
	$_APP->bind_app('jquery.sse');
	$_APP->bind_app('font-awesome');
	
	echo new html('popup', 'default', 'popup');
	echo new html('itemcards', 'default', 'itemcards');
	echo new html('jquery.autoresize', 'default', 'autoresize');
	echo new html('jquery.mentionsInput', 'default', 'mentions');
	
	$html = new html('notification', 'default', 'eventstream');
	$_APP->bind('header', $html);
*/
/*
	$app = new app('searchasyoutype');
	$app->load();
	$app = new app('jquery.sse');
	$app->load();
	$app = new app('font-awesome');
	$app->load();
*/

/********************************************************************************************/
//	Meta
/********************************************************************************************/
	$_APP->bind_snippet('meta', 'snippet/meta');
	
/********************************************************************************************/
//	Nav CC
/********************************************************************************************/
	$_APP->bind_snippet('nav', 'snippet/nav');
	
/********************************************************************************************/
//	Header
/********************************************************************************************/
//	Header
	$_APP->bind_snippet('header', 'snippet/header');
	$truc = '<div id="eventstream"><ul class="mine"></ul><ul class="everybodyelses"></ul></div>';
	$_APP->bind_code('header', $truc);
//	Even stream
	$_APP->bind_snippet('header', 'snippet/eventstream');	
	
/********************************************************************************************/
//	Tabs
/********************************************************************************************/
	$_APP->bind_snippet('tabs', 'snippet/tabs');
	
/********************************************************************************************/
//	Content
/********************************************************************************************/
	$_APP->bind_snippet('content', 'snippet/options');
	
/********************************************************************************************/
//	Context
/********************************************************************************************/
//	Green button
	$_APP->bind_snippet('context', 'snippet/greenbutton/greenbutton');
//	Preview
	$_APP->bind_snippet('context', 'snippet/preview');
//	Trashbin
	$_APP->bind_snippet('content', 'snippet/trashbin/trashbin');
	
/********************************************************************************************/
//	Footer
/********************************************************************************************/
	$_APP->bind_snippet('footer', 'snippet/footer');
	
?>