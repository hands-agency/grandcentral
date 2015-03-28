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
//	Some tests
/********************************************************************************************/
//	Display entry ticket (minimum usage, right after booting)
	#echo '<div style="font-family:arial;padding:30px 10px;background:#FE6022;color:#fff;font-size:20px;text-align:center"><strong style="color:#FE6022;background:#fff;padding:10px;margin-right:10px">Entry ticket</strong> '.sentinel::stopwatch().'s ● '.database::query_count().' queries ● using '.sentinel::memoryusage().'</div>';exit;
	
/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	The current page
	$_PAGE = $_PARAM['page'];
//	Fetch the currently edited page
	$currentEditedItemUrl = SITE_URL;
	if (isset($_GET['item']) && isset($_GET['id']))
	{
	//	We want only the html pages with a URL
		$currentEditedItem = i($_GET['item'], $_GET['id'], $_SESSION['pref']['handled_env']);
		if (isset($currentEditedItem['url']) && $currentEditedItem['type']['content_type'] == 'html') $currentEditedItemUrl = $currentEditedItem['url'];
	}

//	The sections
	$sections = $_PAGE['section']->unfold();
	$sectionTrayWidth = ($sections->count * 100).'%';
	$sectionWidth = (100 / $sections->count).'%';
	
//	Update all structures
//	foreach (i('item', all, 'site') as $s) $s->save();

/********************************************************************************************/
//	General binding of scripts & css files
/********************************************************************************************/
//	jQuery
//	$_APP->bind_script('https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
//	$_APP->bind_script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js');
	$_APP->bind_script('master/js/jquery-1.10.2.min.js');
	$_APP->bind_script('master/js/jquery-ui-1.9.1.custom.min.js');

//	Reroot get in ajax
	$_APP->bind_code("script", "
	//	Some vars
		var _GET = ".json_encode($_GET).";
	//	Some consts
		var ITEM = $('meta[property=\"gc:item\"]').attr('content');
		var SITE_URL = '".SITE_URL."';
		var SITE_KEY = '".SITE_KEY."'; 
		var ADMIN_URL = '".ADMIN_URL."';
		var ENV = $('body').data('env');
		var CURRENTEDITED_URL = '".$currentEditedItemUrl."';
	//	Prevent pace on PushState
		window.paceOptions = {
			restartOnPushState: false
		};
	");
	
/********************************************************************************************/
//	First day at work ?
/********************************************************************************************/
/*
	$p = array('subject' => 'human', 'subjectid' => $_SESSION['user']['id']->get());
	if (count::get('logbook', $p, 'site') == 0) $_APP->bind_code("script", '$(document).ready(function () {openContext({app:"content",template:"master/welcome"})});');
	
/********************************************************************************************/
//	Local binding scripts & css files
/********************************************************************************************/
//	Script
	$_APP->bind_script('master/js/master.js');
//	css
	$_APP->bind_css('master/css/master.css');

/********************************************************************************************/
//	Apps
/********************************************************************************************/
	load('searchasyoutype', 'jquery.masonry', 'jquery.imagesloaded', 'jquery.hoverintent', 'jquery.sse', 'jquery.pace', 'featherfont');
	$_APP->bind_code("script", "$(document).ajaxStart(function() { Pace.restart(); });");
	
/********************************************************************************************/
//	Meta
/********************************************************************************************/
	$_APP->bind_snippet('meta', 'master/snippet/meta');
	
/********************************************************************************************/
//	Nav CC
/********************************************************************************************/
//	$_APP->bind_snippet('sitenav', 'master/snippet/sitenav');
	
/********************************************************************************************/
//	Nav CC
/********************************************************************************************/
//	$_APP->bind_snippet('nav', 'master/snippet/nav');
	
/********************************************************************************************/
//	Headers
/********************************************************************************************/
//Site
	$_APP->bind_snippet('headersite', 'master/snippet/headersite');
	
//	Even stream
	$_APP->bind_code('headeradmin', '<div id="eventstream"><ul class="mine"></ul><ul class="everybodyelses"></ul></div>');
	$_APP->bind_snippet('headeradmin', 'master/snippet/eventstream');
//	Green button
	$_APP->bind_snippet('headeradmin', 'master/snippet/greenbutton/greenbutton');
//	Header (here, i need the section var)
	$_APP->bind_snippet('headeradmin', 'master/snippet/headeradmin');

/********************************************************************************************/
//	Content
/********************************************************************************************/
//	Trashbin
	$_APP->bind_snippet('content', 'master/snippet/trashbin/trashbin');
	
//
/********************************************************************************************/
//	The title
/********************************************************************************************/
	switch (i('page', current)['key'])
	{	
	//	Edit
		case 'edit':
			$structure = i('item', $_GET['item'], $_SESSION['pref']['handled_env']);
		//	We have an item already
			if (isset($_GET['id']))
			{
				$item = i($_GET['item'], $_GET['id'], $_SESSION['pref']['handled_env']);
				$back = $item->listing();
			}
		//	New item
			else
			{
				$back = i($_GET['item'], null, $_SESSION['pref']['handled_env'])->listing();
			}
			break;
			
	//	List
		case 'list':
			$item = i('page', 'home');
			$back = $item['url'];
			break;
			
	//	App
		case 'app':
			$page = i('page', 'app');
			$back = $page['url'];
			break;
			
	//	Home
		case 'home':
			$item = i('page', 'home');
			$back = 'javascript:openSite();';
			break;
		
		default:
			$item = i('page', 'home');
			$back = $item['url'];
			break;
	}
	
/********************************************************************************************/
//	Footer
/********************************************************************************************/
	$_APP->bind_snippet('footer', 'master/snippet/footer');	
?>