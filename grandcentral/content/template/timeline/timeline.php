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
	$_APP->bind_script('timeline/js/timeline.js');
	$_APP->bind_css('timeline/css/timeline.css');

/********************************************************************************************/
//	Some vars
/********************************************************************************************/
//	Amount of items displayed before grouping
	$displayItems = 5;
//	Amount of thumbnails to be displayed (where available)
	$displayThumbnails = 3;
	
/********************************************************************************************/
//	Some dates
/********************************************************************************************/
//	Tomorrow
	$tomorrow = new DateTime('tomorrow');
	$tomorrow_dawn = $tomorrow->format('Y-m-d 06:00:00');

//	Today
	$now = new DateTime();
	$night = $now->format('Y-m-d 23:00:00');
	$dusk = $now->format('Y-m-d 22:00:00');
	$evening = $now->format('Y-m-d 19:00:00');
	$afternoon = $now->format('Y-m-d 14:00:00');
	$noon = $now->format('Y-m-d 12:00:00');
	$morning = $now->format('Y-m-d 08:00:00');
	$dawn = $now->format('Y-m-d 06:00:00');
	
//	Yesterday
	$yesterday = new DateTime('yesterday');
	$yesterday_night = $yesterday->format('Y-m-d 23:00:00');
	$yesterday_dusk = $yesterday->format('Y-m-d 22:00:00');
	$yesterday_evening = $yesterday->format('Y-m-d 19:00:00');
	$yesterday_afternoon = $yesterday->format('Y-m-d 14:00:00');
	$yesterday_noon = $yesterday->format('Y-m-d 12:00:00');
	$yesterday_morning = $yesterday->format('Y-m-d 08:00:00');
	$yesterday_dawn = $yesterday->format('Y-m-d 06:00:00');
	
/********************************************************************************************/
//	Periods
/********************************************************************************************/
	$periods = array(
	//	Today
		'night' => array(
			'updated' => array('> '.$night, '< '.$tomorrow_dawn),
		),
		'dusk' => array(
			'updated' => array('> '.$dusk, '< '.$night),
		),
		'evening' => array(
			'updated' => array('> '.$evening, '< '.$dusk),
		),
		'afternoon' => array(
			'updated' => array('> '.$afternoon, '< '.$evening),
		),
		'noon' => array(
			'updated' => array('> '.$noon, '< '.$afternoon),
		),
		'morning' => array(
			'updated' => array('> '.$morning, '< '.$noon),
		),
		'dawn' => array(
			'updated' => array('> '.$dawn, '< '.$morning),
		),
	//	Yesterday
		'yesterday_night' => array(
			'updated' => array('> '.$yesterday_night, '< '.$dawn),
		),
		'yesterday_dusk' => array(
			'updated' => array('> '.$yesterday_dusk, '< '.$yesterday_night),
		),
		'yesterday_evening' => array(
			'updated' => array('> '.$yesterday_evening, '< '.$yesterday_dusk),
		),
		'yesterday_afternoon' => array(
			'updated' => array('> '.$yesterday_afternoon, '< '.$yesterday_evening),
		),
		'yesterday_noon' => array(
			'updated' => array('> '.$yesterday_noon, '< '.$yesterday_afternoon),
		),
		'yesterday_morning' => array(
			'updated' => array('> '.$yesterday_morning, '< '.$yesterday_noon),
		),
		'yesterday_dawn' => array(
			'updated' => array('> '.$yesterday_dawn, '< '.$yesterday_morning),
		),
	);
//	Days of this week if we're not tuesday
	
//	Last week

	
/********************************************************************************************/
//	Get events of the logbook accordning to periods
/********************************************************************************************/
//	An array of cc events
	$events = array();
	
//	Fetch the data
	foreach ($periods as $period => $p)
	{
	//	Params
		$p['order()'] = 'updated DESC';
		
	//	Only for one item
		$only = array('item', 'itemid', 'subject', 'subjectid');
		foreach ($only as $only) if (isset($_GET[$only])) $p[$only] = $_GET[$only];

	//	Fetch the logbook
		$logbook = cc('logbook', $p, $_SESSION['pref']['handled_env']);

	//	Reorder by user and actions
		foreach ($logbook as $e)
		{
			$events[$period][$e['subjectid']->get()][$e['key']->get()][$e['item']->get()][$e['itemid']->get()] = $e;
		}
	}

/********************************************************************************************/
//	Event Source
/********************************************************************************************/
	$EventSource = cc('page', 'api-eventstream')['url']->args(array
	(
		'app' => 'content',
		'template' => 'timeline',
	));
?>