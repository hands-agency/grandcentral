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
//	Get the logbook
/********************************************************************************************/
	if (isset($_GET['delay']))
	{
		$date = new DateTime($_GET['since']);
		$date->sub(new DateInterval('PT'.$_GET['delay'].'M'));
		$since = $date->format('Y-m-d H:i:s');
	}
	else $since = $_GET['since'];

//	Fetch the logbook
	$p = array(
		'item' => $_GET['item'],
		'updated' => '> '.$since,
	);
	$logbooks = i('logbook', $p, $_SESSION['pref']['handled_env']);

	/**
	 * Constructs the SSE data format and flushes that data to the client.
	 *
	 * @param string $id Timestamp/id of this connection.
	 * @param string $msg Line of text that should be transmitted.
	 */
	function sendMsg($id, $msg)
	{
		echo "id: $id" . PHP_EOL;
		echo "data: $msg" . PHP_EOL;
		echo PHP_EOL;
		ob_flush();
		flush();
	}

/********************************************************************************************/
//	Write logbooks
/********************************************************************************************/
	$now = new DateTime();
	foreach ($logbooks as $logbook)
	{
	//	Fetch item
		$item = i((string)$logbook['item'].'_'.$logbook['itemid'], null, $_SESSION['pref']['handled_env']);
		
	//	Aging
		$date = new DateTime($logbook['updated']);
		$interval = $now->diff($date);
		$opacity = 1;
		if (isset($_GET['delay'])) $opacity = $opacity-(($interval->format('%i.%s'))/($_GET['delay']*2));
		
	//	Author
		$author = i((string)$logbook['subject'], (string)$logbook['subjectid'], 'site');
		$author['title'] = (empty($author['title'])) ? $author->get_nickname() : $author['title'];
		
	//	Event
		$event = cst('eventstream_'.$logbook['key'].'_'.$item['live']);
		
	//	Message
		$msg = '{"id": "'.$logbook['id'].'", "event": "'.$event.'", "opacity": "'.$opacity.'", "author": "'.$author['title'].'", "subject": "'.$logbook['subject'].'", "subjectid": "'.$logbook['subjectid'].'", "item": "'.$logbook['item'].'", "itemid": "'.$logbook['itemid'].'", "updated": "'.$logbook['updated'].'", "url": "'.$item['url'].'", "edit": "'.$item->edit().'", "editauthor": "'.$author->edit().'", "title": "'.$item['title']->cut(50).'", "timeSince": "'.$interval->format('%i').'mn ago"}';
		
	//	Send message
		sendMsg($logbook['id'], $msg);
	}
?>