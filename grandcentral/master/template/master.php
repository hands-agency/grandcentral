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
//	The current page
	$_PAGE = $_PARAM['page'];
//	Fetch the currently edited page
	$currentEditedItemUrl = SITE_URL;
	if (isset($_GET['item']) && isset($_GET['id']))
	{
		$currentEditedItem = cc($_GET['item'], $_GET['id'], 'site');
		if (isset($currentEditedItem['url'])) $currentEditedItemUrl = $currentEditedItem['url'];
	}

/********************************************************************************************/
//	General binding of scripts & css files
/********************************************************************************************/
//	jQuery
//	$_APP->bind_file('script', 'https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js');
//	$_APP->bind_file('script', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js');
	$_APP->bind_file('script', 'js/jquery-1.8.2.min.js');
	$_APP->bind_file('script', 'js/jquery-ui-1.9.1.custom.min.js');

//	Reroot get in ajax
	$_APP->bind_code("script", "
	//	Some vars
		var _GET = ".json_encode($_GET).";
	//	Some consts
		const ITEM = $('meta[property=\"cc:item\"]').attr('content');
		const ID = $('meta[property=\"cc:id\"]').attr('content');
		const SITE_URL = '".SITE_URL."';
		const SITE_KEY = '".SITE_KEY."';
		const ADMIN_URL = '".ADMIN_URL."';
		const ENV = $('body').data('env');
		const CURRENTEDITED_URL = '".$currentEditedItemUrl."';
		console.log(CURRENTEDITED_URL);
	");
	
/********************************************************************************************/
//	First day at work ?
/********************************************************************************************/
	$p = array('subject' => 'human', 'subjectid' => $_SESSION['user']['id']->get());
	if (!cc('logbook', $p)->count()) $_APP->bind_code("script", '$(document).ready(function () {openContext({app:"master",template:"welcome"})});');
	
/********************************************************************************************/
//	Local binding scripts & css files
/********************************************************************************************/
//	Script
	$_APP->bind_file('script', 'js/master.js');
//	css
	$_APP->bind_file('css', 'css/master.css');
	
/********************************************************************************************/
//	Apps
/********************************************************************************************/
	$apps = array('searchasyoutype', 'jquery.masonry', 'jquery.imagesloaded', 'jquery.hoverintent', 'jquery.sse', 'jquery.pace');
	foreach ($apps as $app)
	{
		$app = new app($app);
		$app->load();
	}
	
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
//	Even stream
	$_APP->bind_code('header', '<div id="eventstream"><ul class="mine"></ul><ul class="everybodyelses"></ul></div>');
	$_APP->bind_snippet('header', 'snippet/eventstream');	
//	Green button
	$_APP->bind_snippet('header', 'snippet/greenbutton/greenbutton');
	
/********************************************************************************************/
//	Tabs
/********************************************************************************************/
	$_APP->bind_snippet('tabs', 'snippet/tabs');
	
/********************************************************************************************/
//	Content
/********************************************************************************************/
//	Options
	$_APP->bind_snippet('content', 'snippet/options');
//	Trashbin
	$_APP->bind_snippet('content', 'snippet/trashbin/trashbin');
	
/********************************************************************************************/
//	Footer
/********************************************************************************************/
	$_APP->bind_snippet('footer', 'snippet/footer');	
?>