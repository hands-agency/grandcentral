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
//	Some vars
/********************************************************************************************/
//	Env
	$handled_env = $_SESSION['pref']['handled_env'];
	
//	Max Thumbnails and Titles to display
	$maxTitle = 4;
	$maxThumbnail = 3;
	
//	Initiate arrays
	$clusters = array();
	$bunches = array();
	$iconField = array();
	$authors = array();

//	Falling from the sky
	$limit = (isset($_POST['limit'])) ? $_POST['limit'] : trigger_error('You should have a limit', E_USER_WARNING);
	$handled_item = isset($_POST['item']) ? $_POST['item'] : null;
	$handled_id = isset($_POST['id']) ? $_POST['id'] : null;
	
/********************************************************************************************/
//	Some dates
/********************************************************************************************/
//	Tomorrow
	$tomorrow = new DateTime('tomorrow');
	$period[] = array('key' => 'tomorrow_dawn', 'date' => $tomorrow->format('Y-m-d 06:00:00'));

//	Today
	$now = new DateTime();
	$period[] = array('key' => 'night', 'date' => $now->format('Y-m-d 23:00:00'));
	$period[] = array('key' => 'dusk', 'date' => $now->format('Y-m-d 22:00:00'));
	$period[] = array('key' => 'evening', 'date' => $now->format('Y-m-d 19:00:00'));
	$period[] = array('key' => 'afternoon', 'date' => $now->format('Y-m-d 14:00:00'));
	$period[] = array('key' => 'noon', 'date' => $now->format('Y-m-d 12:00:00'));
	$period[] = array('key' => 'morning', 'date' => $now->format('Y-m-d 08:00:00'));
	$period[] = array('key' => 'dawn', 'date' => $now->format('Y-m-d 06:00:00'));
	
//	Yesterday
	$yesterday = new DateTime('yesterday');
	$period[] = array('key' => 'yesterday_night', 'date' => $yesterday->format('Y-m-d 23:00:00'));
	$period[] = array('key' => 'yesterday_dusk', 'date' => $yesterday->format('Y-m-d 22:00:00'));
	$period[] = array('key' => 'yesterday_evening', 'date' => $yesterday->format('Y-m-d 19:00:00'));
	$period[] = array('key' => 'yesterday_afternoon', 'date' => $yesterday->format('Y-m-d 14:00:00'));
	$period[] = array('key' => 'yesterday_noon', 'date' => $yesterday->format('Y-m-d 12:00:00'));
	$period[] = array('key' => 'yesterday_morning', 'date' => $yesterday->format('Y-m-d 08:00:00'));
	$period[] = array('key' => 'yesterday_dawn', 'date' => $yesterday->format('Y-m-d 06:00:00'));
	
/********************************************************************************************/
//	Some data
/********************************************************************************************/
	$items = i('item', all)->set_index('key');
	
/********************************************************************************************/
//	Some functions
/********************************************************************************************/
	function formatSeparator($date, $period)
	{
	//	Check where it is in the time lapses
		for ($i=0; $i < count($period); $i++)
		{
		//	Before the age of time
			if (!isset($period[$i+1]['date']))
			{
				$return = new DateTime($date);
				return $return->format('l d F Y');
			}
		//	Not far away
			else if ($date > $period[$i+1]['date'] && $date < $period[$i]['date'])
			{
				return cst('timeline_period_'.$period[$i]['key']);
			}
		}
	}

/********************************************************************************************/
//	Fetch data
/********************************************************************************************/
//	Possible refine
	$WHERE = null;
	if ($handled_item) $WHERE = 'item = "'.$handled_item.'"';
	if ($handled_id) $WHERE .= 'AND itemid = "'.$handled_id.'"';
	if ($WHERE) $WHERE = 'WHERE '.$WHERE;
//	Fetch the last events
	$db = database::connect($handled_env);
 	$q = 'SELECT `key`, item, itemid, subject, subjectid, created FROM logbook '.$WHERE.' ORDER BY created DESC LIMIT '.$limit;
	$logs = $db->query($q);
	
//	Build lists of id based on subject, time interval and item
	foreach ($logs['data'] as $log)
	{
	//	Make a hash
		$hash = $log['subject'].'_'.$log['subjectid'].'_'.$log['key'].'_'.$log['item'];

	//	Add some context info
		if (!isset($clusters[$hash]['key'])) $clusters[$hash]['key'] = $log['key'];
		if (!isset($clusters[$hash]['date'])) $clusters[$hash]['date'] = $log['created'];
		if (!isset($clusters[$hash]['item'])) $clusters[$hash]['item'] = $log['item'];
		if (!isset($clusters[$hash]['subject'])) $clusters[$hash]['subject'] = $log['subject'];
		if (!isset($clusters[$hash]['subjectid'])) $clusters[$hash]['subjectid'] = $log['subjectid'];
		
	//	Add the id to the list (once is enough)
		if (!isset($clusters[$hash]['id']) OR !in_array($log['itemid'], $clusters[$hash]['id'])) $clusters[$hash]['id'][] = $log['itemid'];
	}
	
	
//	Add Bunched to the Clusters
	foreach ($clusters as $hash => $cluster)
	{
	//	If this item still exists
		if (isset($items['item_'.$cluster['item']])) 
		{
		//	Add the bunch
			$clusters[$hash]['bunch'] = i($cluster['item'], array('id' => $cluster['id']), $handled_env);
		
		//	Store the author
			$nickname = $cluster['subject'].'_'.$cluster['subjectid'];
			if (!isset($authors[$nickname])) $authors[$nickname] = i($nickname, null, 'site');
		
		//	Find the first media attr
			if ($clusters[$hash]['bunch']->count > 0)
			{
				$item = $clusters[$hash]['bunch'][0];
				foreach ($item as $attr)
				{
					if(is_a($attr, 'attrMedia'))
					{
						$iconField[$item->get_table()] = $attr->get_key();
						break;
					}
				}
			}
		}
	}
?>